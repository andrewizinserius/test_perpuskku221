<?php

namespace App\Http\Controllers;

use App\Models\Pustaka;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ReservasiController extends Controller
{
    public function create(Request $request, $id)
    {
        $buku = Pustaka::where('id_pustaka', $id)->first();
        // dd(1);
        return view('user.buku.formReservasi', compact('buku'));
    }

    public function reservasi(Request $request, $id)
    {
        $request->validate([
            'tgl_pinjam' => 'required|date|after_or_equal:today',
            'keterangan' => 'required|max:50',
        ]);

        $tgl_kembali = now()->parse($request->tgl_pinjam)->addDays(7)->format('Y-m-d');

        $pustaka = Pustaka::findOrFail($id);
        $id_anggota = Auth::id();

        // Cek apakah anggota memiliki transaksi aktif
        $transaksiAktif = Transaksi::where('id_anggota', $id_anggota)
            ->where('fp', '0')
            ->exists();

        if ($transaksiAktif) {
            return redirect()->back()->with('error', 'Anda masih memiliki buku yang belum dikembalikan.');
        }

        // Simpan transaksi baru
        Transaksi::create([
            'id_pustaka' => $id,
            'id_anggota' => $id_anggota,
            'tgl_pinjam' => $request->tgl_pinjam,
            'tgl_kembali' => $tgl_kembali,
            'fp' => '0',
            'keterangan' => $request->keterangan,
            'denda_terlambat' => 0,
            'denda_hilang' => 0,
        ]);

        return redirect()->route('buku.transaksi')->with('success', 'Reservasi buku berhasil.');
    }


    public function store(Request $request)
    {
        $request->validate([
            'id_anggota' => 'required',
            'id_pustaka' => 'required',
            // 'tgl_pinjam' => 'required|date',
            // 'tgl_kembali' => 'required|date|after_or_equagl:tgl_pinjam|before_or_equal:' . now()->addDays(7)->toDateString(),
            'keterangan' => 'required|max:50',
        ], [
            'tgl_kembali.after_or_equal' => 'Tanggal kembali tidak boleh lebih kecil dari tanggal pinjam.',
            'tgl_kembali.before_or_equal' => 'Tanggal kembali tidak boleh lebih dari 7 hari setelah tanggal pinjam.',
        ]);

        // Menyimpan data transaksi
        $transaksi = new Transaksi();
        $transaksi->id_pustaka = $request->input('id_pustaka');
        $transaksi->id_anggota = $request->input('id_anggota');
        $transaksi->tgl_pinjam = $request->input('tgl_pinjam');
        $transaksi->tgl_kembali = $request->input('tgl_kembali');
        $transaksi->keterangan = $request->input('keterangan');
        // $transaksi->status = 'pending';
        $transaksi->save();

        return redirect()->route('user.buku.index');
    }

    public function transaksi()
    {
        $id_anggota = Auth::id(); // ID anggota yang sedang login

        // Ambil transaksi terkait anggota yang login
        $transaksi = Transaksi::where('id_anggota', $id_anggota)->get();

        foreach ($transaksi as $trans) {
            // Hitung jumlah hari keterlambatan
            if ($trans->tgl_pengembalian && $trans->tgl_pengembalian > $trans->tgl_kembali) {
                $tgl_kembali = new \DateTime($trans->tgl_kembali);
                $tgl_pengembalian = new \DateTime($trans->tgl_pengembalian);

                // Hitung selisih hari keterlambatan
                $daysLate = $tgl_kembali->diff($tgl_pengembalian)->days;

                // Set status denda
                if ($daysLate <= 5) {
                    $trans->status_denda = 'Denda Keterlambatan';
                    $trans->jumlah_denda = $daysLate * $trans->pustaka->denda_terlambat;
                } else {
                    $trans->status_denda = 'Denda Kehilangan';
                    $trans->jumlah_denda = $trans->pustaka->denda_hilang;
                }
            } else {
                $trans->status_denda = 'Pengembalian Sesuai';
                $trans->jumlah_denda = 0;
            }
        }

        return view('user.buku.transaksi', compact('transaksi'));
    }

}