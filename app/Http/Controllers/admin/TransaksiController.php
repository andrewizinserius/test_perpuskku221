<?php

namespace App\Http\Controllers\Admin;

use App\Models\Anggota;
use App\Models\Pustaka;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    // Konstanta denda
    private $DENDA_PER_HARI = 6000; // Rp 6.000 per hari
    private $DENDA_HILANG = 100000; // Rp 100.000 untuk buku hilang
    private $BATAS_HARI_PINJAM = 3; // Batas 3 hari sejak peminjaman

    // Menampilkan daftar transaksi
    public function index()
    {
        $transaksis = Transaksi::with('pustaka', 'anggota')
            ->orderBy('id_transaksi', 'asc')
            ->get();
        
        // Hitung denda untuk setiap transaksi
        foreach ($transaksis as $transaksi) {
            $this->updateDendaTransaksi($transaksi);
        }
        
        return view('admin.transaksi.index', compact('transaksis'));
    }

    // Helper: Hitung hari terlambat termasuk batas 3 hari
    private function hitungHariTerlambat($transaksi)
    {
        if (!$transaksi->tgl_pengembalian || $transaksi->fp != 1) {
            return 0;
        }

        $tglPinjam = Carbon::parse($transaksi->tgl_pinjam);
        $tglPengembalian = Carbon::parse($transaksi->tgl_pengembalian);
        $tglKembali = Carbon::parse($transaksi->tgl_kembali);
        
        $hariTerlambat = 0;

        // Cek apakah sudah melewati batas 3 hari sejak pinjam
        $hariSejakPinjam = $tglPengembalian->diffInDays($tglPinjam);
        if ($hariSejakPinjam > $this->BATAS_HARI_PINJAM) {
            $hariTelatTambahan = $hariSejakPinjam - $this->BATAS_HARI_PINJAM;
            $hariTerlambat = $hariTelatTambahan;
        }

        // Cek terlambat dari tanggal harus kembali
        if ($tglPengembalian->greaterThan($tglKembali)) {
            $telatDariKembali = $tglPengembalian->diffInDays($tglKembali);
            // Ambil yang lebih besar antara telat dari batas 3 hari atau dari tanggal kembali
            $hariTerlambat = max($hariTerlambat, $telatDariKembali);
        }

        return $hariTerlambat;
    }

    // Menampilkan form untuk menambah transaksi baru
    public function create()
    {
        $pustakas = Pustaka::where('jml_book', '>', 0)->get();
        $anggotas = Anggota::all();

        return view('admin.transaksi.create', compact('pustakas', 'anggotas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pustaka' => 'required|exists:tbl_pustaka,id_pustaka',
            'id_anggota' => 'required|exists:tbl_anggota,id_anggota',
            'fp' => 'required|in:0,1',
            'keterangan' => 'nullable|string|max:50',
        ]);

        $pustaka = Pustaka::findOrFail($request->id_pustaka);

        if ($pustaka->jml_book < 1) {
            return back()->withErrors(['id_pustaka' => 'Buku ini tidak tersedia saat ini.'])->withInput();
        }

        $tgl_pinjam = now()->format('Y-m-d');
        $tgl_kembali = now()->addDays(7)->format('Y-m-d');

        // ✅ FIX: Gunakan DB::statement untuk insert dengan ID otomatis
        // Carilah ID terakhir yang digunakan
        $lastId = DB::table('tbl_transaksi')->max('id_transaksi') ?? 0;
        
        // Cari ID terkecil yang tersedia (gap filling)
        $nextId = $this->findAvailableId();
        
        // Insert dengan ID manual untuk mengisi gap
        DB::table('tbl_transaksi')->insert([
            'id_transaksi' => $nextId,
            'id_pustaka' => $request->id_pustaka,
            'id_anggota' => $request->id_anggota,
            'tgl_pinjam' => $tgl_pinjam,
            'tgl_kembali' => $tgl_kembali,
            'tgl_pengembalian' => ($request->fp == 1) ? now() : null,
            'fp' => $request->fp,
            'keterangan' => $request->keterangan,
            'denda_telat' => 0,
            'denda_hilang' => 0,
            'total_denda' => 0,
            'denda_dibayar' => false,
        ]);

        // Kurangi stok buku
        $pustaka->decrement('jml_book');

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit transaksi
    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $pustakas = Pustaka::all();
        $anggotas = Anggota::all();
        
        // Update denda sebelum edit
        $this->updateDendaTransaksi($transaksi);
        
        return view('admin.transaksi.edit', compact('transaksi', 'pustakas', 'anggotas'));
    }

    // Memperbarui transaksi
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_pustaka' => 'required|exists:tbl_pustaka,id_pustaka',
            'id_anggota' => 'required|exists:tbl_anggota,id_anggota',
            'tgl_pinjam' => 'required|date',
            'tgl_kembali' => 'required|date|after_or_equal:tgl_pinjam',
            'tgl_pengembalian' => 'nullable|date|after_or_equal:tgl_pinjam',
            'fp' => 'required|in:0,1,2',
            'keterangan' => 'nullable|string|max:50',
        ]);

        DB::beginTransaction();

        try {
            $transaksi = Transaksi::with('pustaka')->lockForUpdate()->findOrFail($id);
            $oldPustaka = Pustaka::lockForUpdate()->findOrFail($transaksi->id_pustaka);
            $newPustaka = Pustaka::lockForUpdate()->findOrFail($request->id_pustaka);

            // Logika status perubahan
            $oldStatus = $transaksi->fp;
            $newStatus = $request->fp;

            // Jika buku diubah
            if ($request->id_pustaka != $transaksi->id_pustaka) {
                // Kembalikan stok buku lama berdasarkan status lama
                if ($oldStatus == 0) { // Belum selesai
                    $oldPustaka->increment('jml_book');
                } elseif ($oldStatus == 2) { // Hilang, tidak perlu kembalikan
                    // Do nothing
                }

                // Kurangi stok buku baru hanya jika status baru bukan "Hilang"
                if ($newStatus != 2) {
                    if ($newPustaka->jml_book < 1) {
                        return back()->withErrors(['id_pustaka' => 'Buku baru tidak tersedia.'])->withInput();
                    }
                    $newPustaka->decrement('jml_book');
                }
            } else {
                // Buku tidak diubah, hanya status yang berubah
                // Handle perubahan status untuk buku yang sama
                if ($oldStatus == 0 && $newStatus == 1) {
                    // Dari "Dipinjam" ke "Selesai" - kembalikan stok
                    $oldPustaka->increment('jml_book');
                } elseif ($oldStatus == 0 && $newStatus == 2) {
                    // Dari "Dipinjam" ke "Hilang" - stok tidak dikembalikan
                    // Do nothing
                } elseif ($oldStatus == 1 && $newStatus == 0) {
                    // Dari "Selesai" ke "Dipinjam" - kurangi stok lagi
                    if ($oldPustaka->jml_book < 1) {
                        return back()->withErrors(['id_pustaka' => 'Buku tidak tersedia untuk dipinjam lagi.'])->withInput();
                    }
                    $oldPustaka->decrement('jml_book');
                } elseif ($oldStatus == 2 && $newStatus == 0) {
                    // Dari "Hilang" ke "Dipinjam" - kurangi stok
                    if ($oldPustaka->jml_book < 1) {
                        return back()->withErrors(['id_pustaka' => 'Buku tidak tersedia untuk dipinjam lagi.'])->withInput();
                    }
                    $oldPustaka->decrement('jml_book');
                } elseif ($oldStatus == 2 && $newStatus == 1) {
                    // Dari "Hilang" ke "Selesai" - tambah stok (buku ditemukan)
                    $oldPustaka->increment('jml_book');
                }
            }

            // Update denda berdasarkan perubahan status
            $dendaData = $this->hitungDendaUntukUpdate($transaksi, $newStatus, $request->tgl_pengembalian);

            // Update transaksi
            $transaksi->update([
                'id_pustaka' => $request->id_pustaka,
                'id_anggota' => $request->id_anggota,
                'tgl_pinjam' => $request->tgl_pinjam,
                'tgl_kembali' => $request->tgl_kembali,
                'tgl_pengembalian' => $request->tgl_pengembalian,
                'fp' => $request->fp,
                'keterangan' => $request->keterangan,
                'denda_telat' => $dendaData['denda_telat'],
                'denda_hilang' => $dendaData['denda_hilang'],
                'total_denda' => $dendaData['total_denda'],
                // Reset status pembayaran jika denda berubah
                'denda_dibayar' => ($dendaData['total_denda'] == 0) ? true : $transaksi->denda_dibayar,
            ]);

            DB::commit();

            return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat memperbarui transaksi: ' . $e->getMessage());
        }
    }

    // Menghapus transaksi dengan mengisi gap ID
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $transaksi = Transaksi::with('pustaka')->lockForUpdate()->findOrFail($id);

            // Kembalikan stok buku hanya jika status bukan "Hilang"
            if ($transaksi->fp == 0) { // Belum selesai
                $pustaka = Pustaka::lockForUpdate()->findOrFail($transaksi->id_pustaka);
                $pustaka->increment('jml_book');
            }

            // Simpan ID yang dihapus untuk gap filling
            $deletedId = $transaksi->id_transaksi;
            
            // Hapus transaksi
            $transaksi->delete();

            DB::commit();

            return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat menghapus transaksi.');
        }
    }

    // Mengembalikan buku dengan perhitungan denda
    public function returnBook($id)
    {
        DB::beginTransaction();

        try {
            $transaksi = Transaksi::with('pustaka')->lockForUpdate()->findOrFail($id);

            // Pastikan buku belum dikembalikan
            if ($transaksi->fp != 0) {
                DB::rollBack();
                return back()->withErrors(['error' => 'Buku ini sudah diproses sebelumnya.']);
            }

            // Hitung denda telat dengan metode baru yang memperhitungkan batas 3 hari
            $tglPengembalian = now();
            $hariTerlambat = $this->hitungHariTerlambatUntukPengembalian($transaksi, $tglPengembalian);
            $dendaTelat = $hariTerlambat * $this->DENDA_PER_HARI;

            // Update transaksi dengan denda
            $transaksi->update([
                'tgl_pengembalian' => $tglPengembalian,
                'fp' => 1, // Selesai
                'denda_telat' => $dendaTelat,
                'denda_hilang' => 0,
                'total_denda' => $dendaTelat,
                'denda_dibayar' => ($dendaTelat == 0) ? true : false,
            ]);

            // Tambahkan jumlah buku pustaka kembali
            $pustaka = Pustaka::lockForUpdate()->findOrFail($transaksi->id_pustaka);
            $pustaka->increment('jml_book');

            DB::commit();

            $message = 'Buku berhasil dikembalikan.';
            if ($dendaTelat > 0) {
                $message .= " Terlambat $hariTerlambat hari. Denda: Rp " . number_format($dendaTelat, 0, ',', '.');
            }

            return redirect()->route('transaksi.index')->with('success', $message);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat mengembalikan buku: ' . $e->getMessage());
        }
    }

    // Helper: Hitung hari terlambat untuk pengembalian real-time
    private function hitungHariTerlambatUntukPengembalian($transaksi, $tglPengembalian)
    {
        if (!$transaksi->tgl_pengembalian) {
            return 0;
        }

        $tglPinjam = Carbon::parse($transaksi->tgl_pinjam);
        $tglPengembalian = Carbon::parse($tglPengembalian);
        $tglKembali = Carbon::parse($transaksi->tgl_kembali);
        
        $hariTerlambat = 0;

        // Cek apakah sudah melewati batas 3 hari sejak pinjam
        $hariSejakPinjam = $tglPengembalian->diffInDays($tglPinjam);
        if ($hariSejakPinjam > $this->BATAS_HARI_PINJAM) {
            $hariTelatTambahan = $hariSejakPinjam - $this->BATAS_HARI_PINJAM;
            $hariTerlambat = $hariTelatTambahan;
        }

        // Cek terlambat dari tanggal harus kembali
        if ($tglPengembalian->greaterThan($tglKembali)) {
            $telatDariKembali = $tglPengembalian->diffInDays($tglKembali);
            // Ambil yang lebih besar antara telat dari batas 3 hari atau dari tanggal kembali
            $hariTerlambat = max($hariTerlambat, $telatDariKembali);
        }

        return $hariTerlambat;
    }

    // Menandai buku hilang dengan denda
    public function markAsLost($id)
    {
        DB::beginTransaction();

        try {
            $transaksi = Transaksi::with('pustaka')->lockForUpdate()->findOrFail($id);

            // Pastikan buku belum dikembalikan atau hilang
            if ($transaksi->fp == 1) {
                DB::rollBack();
                return back()->with('error', 'Buku ini sudah dikembalikan.');
            }

            if ($transaksi->fp == 2) {
                DB::rollBack();
                return back()->with('error', 'Buku ini sudah ditandai hilang.');
            }

            // Update status transaksi menjadi hilang dengan denda
            $transaksi->update([
                'tgl_pengembalian' => now(),
                'fp' => 2, // Hilang
                'denda_telat' => 0,
                'denda_hilang' => $this->DENDA_HILANG,
                'total_denda' => $this->DENDA_HILANG,
                'denda_dibayar' => false,
                'keterangan' => $transaksi->keterangan ? $transaksi->keterangan . ' (Buku Hilang)' : 'Buku Hilang'
            ]);

            // Catatan: Stok buku TIDAK dikembalikan ketika buku hilang

            DB::commit();

            return redirect()->route('transaksi.index')->with('success', 
                'Buku berhasil ditandai sebagai hilang. Denda: Rp ' . number_format($this->DENDA_HILANG, 0, ',', '.'));

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat menandai buku hilang.');
        }
    }

    // Bayar denda
    public function payDenda($id)
    {
        DB::beginTransaction();

        try {
            $transaksi = Transaksi::lockForUpdate()->findOrFail($id);

            // Pastikan ada denda yang belum dibayar
            if ($transaksi->total_denda == 0) {
                DB::rollBack();
                return back()->with('error', 'Tidak ada denda yang harus dibayar.');
            }

            if ($transaksi->denda_dibayar) {
                DB::rollBack();
                return back()->with('error', 'Denda sudah dibayar sebelumnya.');
            }

            // Update status pembayaran denda
            $transaksi->update([
                'denda_dibayar' => true,
                'tgl_bayar_denda' => now(),
            ]);

            DB::commit();

            return redirect()->route('transaksi.index')->with('success', 
                'Denda sebesar Rp ' . number_format($transaksi->total_denda, 0, ',', '.') . ' berhasil dibayar.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat membayar denda.');
        }
    }

    // Tampilkan detail denda
    public function showDenda($id)
    {
        $transaksi = Transaksi::with(['pustaka', 'anggota'])->findOrFail($id);
        
        // Update denda terlebih dahulu
        $this->updateDendaTransaksi($transaksi);
        
        // Refresh data transaksi
        $transaksi->refresh();
        
        // Hitung hari terlambat dengan metode baru
        $hariTerlambat = $this->hitungHariTerlambat($transaksi);
        $dendaTelat = $hariTerlambat * $this->DENDA_PER_HARI;
        $dendaHilang = $transaksi->denda_hilang;
        $totalDenda = $transaksi->total_denda;
        
        return view('admin.transaksi.denda', compact(
            'transaksi', 
            'hariTerlambat', 
            'dendaTelat', 
            'dendaHilang', 
            'totalDenda'
        ));
    }

    // Helper: Update denda untuk transaksi
    private function updateDendaTransaksi($transaksi)
    {
        // Hanya update jika status selesai dan belum dibayar
        if ($transaksi->fp == 1 && !$transaksi->denda_dibayar) {
            $hariTerlambat = $this->hitungHariTerlambat($transaksi);
            $dendaTelat = $hariTerlambat * $this->DENDA_PER_HARI;
            
            // Pastikan denda telat tidak negatif
            $dendaTelat = max(0, $dendaTelat);
            
            // Jika ada perubahan denda, update
            if ($dendaTelat != $transaksi->denda_telat) {
                $transaksi->update([
                    'denda_telat' => $dendaTelat,
                    'total_denda' => $dendaTelat + $transaksi->denda_hilang,
                ]);
            }
        }
    }

    // Helper: Hitung denda untuk update
    private function hitungDendaUntukUpdate($transaksi, $newStatus, $tglPengembalian)
    {
        $dendaTelat = 0;
        $dendaHilang = 0;
        
        if ($newStatus == 1) { // Selesai
            if ($tglPengembalian) {
                $tglPinjam = Carbon::parse($transaksi->tgl_pinjam);
                $tglKembali = Carbon::parse($transaksi->tgl_kembali);
                $tglPengembalian = Carbon::parse($tglPengembalian);
                
                $hariTerlambat = 0;
                
                // Cek apakah sudah melewati batas 3 hari sejak pinjam
                $hariSejakPinjam = $tglPengembalian->diffInDays($tglPinjam);
                if ($hariSejakPinjam > $this->BATAS_HARI_PINJAM) {
                    $hariTelatTambahan = $hariSejakPinjam - $this->BATAS_HARI_PINJAM;
                    $hariTerlambat = $hariTelatTambahan;
                }

                // Cek terlambat dari tanggal harus kembali
                if ($tglPengembalian->greaterThan($tglKembali)) {
                    $telatDariKembali = $tglPengembalian->diffInDays($tglKembali);
                    // Ambil yang lebih besar antara telat dari batas 3 hari atau dari tanggal kembali
                    $hariTerlambat = max($hariTerlambat, $telatDariKembali);
                }
                
                $dendaTelat = $hariTerlambat * $this->DENDA_PER_HARI;
            }
        } elseif ($newStatus == 2) { // Hilang
            $dendaHilang = $this->DENDA_HILANG;
        }
        
        // Pastikan tidak negatif
        $dendaTelat = max(0, $dendaTelat);
        
        return [
            'denda_telat' => $dendaTelat,
            'denda_hilang' => $dendaHilang,
            'total_denda' => $dendaTelat + $dendaHilang,
        ];
    }

    // ✅ FIX: Fungsi untuk mencari ID yang tersedia (gap filling)
    private function findAvailableId()
    {
        // Ambil semua ID yang ada
        $existingIds = DB::table('tbl_transaksi')
            ->orderBy('id_transaksi', 'asc')
            ->pluck('id_transaksi')
            ->toArray();
        
        // Jika tabel kosong, mulai dari 1
        if (empty($existingIds)) {
            return 1;
        }
        
        // Cari gap (lubang) dalam urutan ID
        $expectedId = 1;
        
        foreach ($existingIds as $existingId) {
            if ($existingId > $expectedId) {
                // Ada gap, gunakan ID ini
                return $expectedId;
            }
            $expectedId = $existingId + 1;
        }
        
        // Tidak ada gap, gunakan ID berikutnya
        return $expectedId;
    }

    // ✅ FIX: Fungsi untuk reset auto increment (opsional, bisa dipanggil manual)
    public function resetAutoIncrement()
    {
        // Cari ID maksimum
        $maxId = DB::table('tbl_transaksi')->max('id_transaksi') ?? 0;
        
        // Set auto increment ke nilai berikutnya
        DB::statement("ALTER TABLE tbl_transaksi AUTO_INCREMENT = " . ($maxId + 1));
        
        return redirect()->route('transaksi.index')
            ->with('success', 'Auto increment berhasil direset ke ' . ($maxId + 1));
    }

    // ✅ FIX: Fungsi untuk compact ID (merapikan urutan ID)
    public function compactIds()
    {
        DB::beginTransaction();

        try {
            // Ambil semua transaksi diurutkan
            $transaksis = DB::table('tbl_transaksi')
                ->orderBy('id_transaksi', 'asc')
                ->get();
            
            $newId = 1;
            
            // Update setiap transaksi dengan ID baru
            foreach ($transaksis as $transaksi) {
                if ($transaksi->id_transaksi != $newId) {
                    // Update ID
                    DB::table('tbl_transaksi')
                        ->where('id_transaksi', $transaksi->id_transaksi)
                        ->update(['id_transaksi' => $newId]);
                }
                $newId++;
            }
            
            // Reset auto increment
            $maxId = DB::table('tbl_transaksi')->max('id_transaksi') ?? 0;
            DB::statement("ALTER TABLE tbl_transaksi AUTO_INCREMENT = " . ($maxId + 1));
            
            DB::commit();
            
            return redirect()->route('transaksi.index')
                ->with('success', 'ID transaksi berhasil dirapikan. ID maksimum sekarang: ' . $maxId);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat merapikan ID transaksi.');
        }
    }
}