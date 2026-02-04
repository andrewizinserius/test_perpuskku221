<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\JenisAnggota;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = Anggota::with('jenisAnggota')->get();
        return view('admin.anggota.index', compact('anggota'));
    }

    public function create()
    {
        $jenisAnggota = JenisAnggota::all(); // Mengambil semua jenis anggota

        // Mengambil kode anggota terakhir
        $lastAnggota = Anggota::orderBy('id_anggota', 'desc')->first();
        $lastKodeAnggota = $lastAnggota ? $lastAnggota->kode_anggota : '000'; // Jika tidak ada data, mulai dengan 000

        // Menambahkan 1 pada kode terakhir, dan memformat dengan 3 digit
        $nextKodeAnggota = str_pad((intval($lastKodeAnggota) + 1), 3, '0', STR_PAD_LEFT);

        return view('admin.anggota.create', compact('jenisAnggota', 'nextKodeAnggota'));
    }


    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'kode_anggota' => 'required|unique:tbl_anggota,kode_anggota',
            'nama_anggota' => 'required',
            'id_jenis_anggota' => 'required|exists:tbl_jenis_anggota,id_jenis_anggota',
            'tempat' => 'required',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required',
            'no_telp' => 'required',
            'email' => 'required|email',
            'tgl_daftar' => 'required|date',
            'masa_aktif' => 'required|date',
            'fa' => 'required',
            'keterangan' => 'required',
            'username' => 'required|unique:tbl_anggota,username',
            'password' => 'required|min:8',
        ]);

        // Enkripsi password
        $validated['password'] = bcrypt($request->password);

        // Menyimpan anggota baru
        Anggota::create($validated);

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function show($id)
    {
        $anggota = Anggota::findOrFail($id);

        // Pastikan kolom tanggal dikonversi menjadi objek Carbon
        $anggota->tgl_lahir = Carbon::parse($anggota->tgl_lahir);
        $anggota->tgl_daftar = Carbon::parse($anggota->tgl_daftar);
        $anggota->masa_aktif = Carbon::parse($anggota->masa_aktif);

        return view('admin.anggota.show', compact('anggota'));
    }

    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);
        $jenisAnggota = JenisAnggota::all();
        return view('admin.anggota.edit', compact('anggota', 'jenisAnggota'));
    }

    public function update(Request $request, $id)
    {
        $anggota = Anggota::findOrFail($id); // Mencari anggota berdasarkan id_anggota

        $validated = $request->validate([
            'kode_anggota' => 'required|unique:tbl_anggota,kode_anggota,' . $anggota->id_anggota . ',id_anggota',
            'nama_anggota' => 'required',
            'id_jenis_anggota' => 'required',
            'username' => 'required|unique:tbl_anggota,username,' . $anggota->id_anggota . ',id_anggota',
            'password' => 'nullable|min:8',  // Membuat password sebagai nullable
            'fa' => 'required',
            'keterangan' => 'nullable|string|max:255' // Validasi tambahan untuk keterangan
        ]);

        // Jika password tidak kosong, enkripsi dan set password
        if ($request->filled('password')) {
            $validated['password'] = bcrypt($request->password); // Enkripsi password jika diubah
        } else {
            // Jika password tidak diubah, jangan tambahkan kolom password ke query update
            unset($validated['password']);
        }

        // Update data anggota
        $anggota->update($validated);

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);
        $anggota->delete();

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil dihapus.');
    }
}