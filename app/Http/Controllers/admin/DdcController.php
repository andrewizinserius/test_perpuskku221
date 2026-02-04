<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DDC;
use App\Models\Rak;
use Illuminate\Http\Request;

class DdcController extends Controller
{
    // Menampilkan daftar DDC
    public function index()
    {
        $ddcs = Ddc::with('rak')->get(); // Mengambil data DDC beserta relasi rak
        return view('admin.ddc.index', compact('ddcs'));
    }

    // Menampilkan form untuk membuat DDC baru
    public function create()
    {
        $raks = Rak::all(); // Mengambil semua data rak
        return view('admin.ddc.create', compact('raks'));
    }

    // Menyimpan DDC baru
    public function store(Request $request)
    {
        $request->validate([
            'id_rak' => 'required|exists:tbl_rak,id_rak',
            'kode_ddc' => 'required|unique:tbl_ddc,kode_ddc|max:10',
            'ddc' => 'required|max:100',
            'keterangan' => 'nullable|max:100',
        ]);

        Ddc::create([
            'id_rak' => $request->id_rak,
            'kode_ddc' => $request->kode_ddc,
            'ddc' => $request->ddc,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('ddc.index')->with('success', 'Data DDC berhasil ditambahkan.');
    }


    // Menampilkan form untuk mengedit DDC
    public function edit($id)
    {
        $ddc = Ddc::findOrFail($id); // Menemukan DDC berdasarkan ID
        $raks = Rak::all(); // Mengambil semua data rak
        return view('admin.ddc.edit', compact('ddc', 'raks'));
    }

    // Mengupdate DDC yang ada
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_rak' => 'required|exists:tbl_rak,id_rak',
            'kode_ddc' => 'required|unique:tbl_ddc,kode_ddc,' . $id . ',id_ddc|max:10',  // Perbaiki kolom yang digunakan
            'ddc' => 'required|max:100',
            'keterangan' => 'nullable|max:100',
        ]);

        $ddc = Ddc::findOrFail($id);
        $ddc->update([
            'id_rak' => $request->id_rak,
            'kode_ddc' => $request->kode_ddc,
            'ddc' => $request->ddc,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('ddc.index')->with('success', 'Data DDC berhasil diperbarui.');
    }


    // Menampilkan detail DDC
    public function show($id)
    {
        $ddc = Ddc::findOrFail($id);
        return view('admin.ddc.show', compact('ddc'));
    }

    // Menghapus DDC
    public function destroy($id)
    {
        $ddc = Ddc::findOrFail($id);
        $ddc->delete();
        return redirect()->route('ddc.index')->with('success', 'DDC deleted successfully.');
    }
}