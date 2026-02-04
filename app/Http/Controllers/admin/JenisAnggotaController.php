<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisAnggota;

class JenisAnggotaController extends Controller
{
    // Menampilkan daftar jenis anggota
    public function index()
    {
        $jenisAnggota = JenisAnggota::all();
        return view('admin.jenisanggota.index', compact('jenisAnggota'));
    }

    // Menampilkan form tambah jenis anggota
    public function create()
    {
        return view('admin.jenisanggota.create');
    }

    // Menyimpan data jenis anggota baru
    public function store(Request $request)
    {
        $request->validate([
            'kode_jenis_anggota' => 'required|unique:tbl_jenis_anggota,kode_jenis_anggota|max:2',
            'jenis_anggota' => 'required|max:15',
            'max_pinjam' => 'required|numeric',
            'keterangan' => 'nullable|max:50',
        ]);

        JenisAnggota::create($request->all());

        return redirect()->route('jenisanggota.index')
            ->with('success', 'Jenis anggota berhasil ditambahkan.');
    }

    // Menampilkan form edit jenis anggota
    public function edit($id)
    {
        $jenisAnggota = JenisAnggota::findOrFail($id);
        return view('admin.jenisanggota.edit', compact('jenisAnggota'));
    }

    // Mengupdate data jenis anggota
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_jenis_anggota' => 'required|max:2|unique:tbl_jenis_anggota,kode_jenis_anggota,' . $id . ',id_jenis_anggota',
            'jenis_anggota' => 'required|max:15',
            'max_pinjam' => 'required|numeric',
            'keterangan' => 'nullable|max:50',
        ]);

        $jenisAnggota = JenisAnggota::findOrFail($id);
        $jenisAnggota->update($request->all());

        return redirect()->route('jenisanggota.index')
            ->with('success', 'Jenis anggota berhasil diperbarui.');
    }

    // Menghapus jenis anggota
    public function destroy($id)
    {
        $jenisAnggota = JenisAnggota::findOrFail($id);
        $jenisAnggota->delete();

        return redirect()->route('jenisanggota.index')
            ->with('success', 'Jenis anggota berhasil dihapus.');
    }
}