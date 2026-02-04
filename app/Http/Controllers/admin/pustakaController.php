<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ddc;
use App\Models\Format;
use App\Models\Pustaka;
use App\Models\Penerbit;
use App\Models\Pengarang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PustakaController extends Controller
{
    // Tampilkan semua pustaka
    public function index()
    {
        $pustakas = Pustaka::all();
        return view('admin.pustaka.index', compact('pustakas'));
    }

    // Tampilkan form untuk menambahkan pustaka baru
    public function create()
    {
        $ddcs = Ddc::all();
        $formats = Format::all();
        $penerbits = Penerbit::all();
        $pengarangs = Pengarang::all();

        return view('admin.pustaka.create', compact('ddcs', 'formats', 'penerbits', 'pengarangs'));
    }
    // Simpan pustaka baru ke database
    public function store(Request $request)
    {
        // dd($request->all());

        $validatedData = $request->validate([
            'kode_pustaka' => 'required|numeric|unique:tbl_pustaka,kode_pustaka',
            'id_ddc' => 'required',
            'id_format' => 'required',
            'id_penerbit' => 'required',
            'id_pengarang' => 'required',
            'judul_pustaka' => 'required|string|max:100',
            'isbn' => 'nullable|string|max:20',
            'gambar' => 'nullable|image|max:2048',
            'tahun_terbit' => 'nullable|string|max:5',
            'keyword' => 'required',
            'keterangan_fisik' => 'required',
            'keterangan_tambahan' => 'required',
            'abstraksi' => 'required',
            'harga_buku' => 'nullable|numeric',
            'kondisi_buku' => 'nullable|string|max:15',
            'fp' => 'required',
            'jml_pinjam' => 'required',
            'denda_terlambat' => 'required',
            'denda_hilang' => 'required',
        ]);

        // dd($validatedData);

        // Upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $validatedData['gambar'] = $request->file('gambar')->store('pustaka', 'public');
        }

        Pustaka::create($validatedData);

        return redirect()->route('pustaka.index')->with('success', 'Pustaka berhasil ditambahkan.');
    }

    // Tampilkan detail pustaka
    public function show($id_pustaka)
    {
        $pustaka = Pustaka::findOrFail($id_pustaka);
        return view('admin.pustaka.show', compact('pustaka'));
    }

    // Tampilkan form untuk mengedit pustaka
    public function edit($id_pustaka)
    {
        $pustaka = Pustaka::findOrFail($id_pustaka);
        $ddcs = Ddc::all();
        $formats = Format::all();
        $penerbits = Penerbit::all();
        $pengarangs = Pengarang::all();

        return view('admin.pustaka.edit', compact('pustaka', 'ddcs', 'formats', 'penerbits', 'pengarangs'));
    }

    // Update data pustaka di database
    public function update(Request $request, $id_pustaka)
    {
        $pustaka = Pustaka::findOrFail($id_pustaka);

        $validatedData = $request->validate([
            'kode_pustaka' => 'required|numeric',
            'id_ddc' => 'required',
            'id_format' => 'required',
            'id_penerbit' => 'required',
            'id_pengarang' => 'required',
            'judul_pustaka' => 'required|string|max:100',
            'isbn' => 'nullable|string|max:20',
            'gambar' => 'nullable|image|max:2048',
            'tahun_terbit' => 'nullable|string|max:5',
            'keyword' => 'required',
            'keterangan_fisik' => 'required',
            'keterangan_tambahan' => 'required',
            'abstraksi' => 'required',
            'harga_buku' => 'nullable|numeric',
            'kondisi_buku' => 'nullable|string|max:15',
            'fp' => 'required',
            'jml_pinjam' => 'required',
            'denda_terlambat' => 'required',
            'denda_hilang' => 'required',
        ]);

        // Upload gambar jika ada
        if ($request->hasFile('gambar')) {
            $validatedData['gambar'] = $request->file('gambar')->store('pustaka', 'public');
        }

        $pustaka->update($validatedData);

        return redirect()->route('pustaka.index')->with('success', 'Pustaka berhasil diperbarui.');
    }

    // Hapus pustaka dari database
    public function destroy($id_pustaka)
    {
        $pustaka = Pustaka::findOrFail($id_pustaka);

        // Hapus gambar jika ada
        if ($pustaka->gambar) {
            Storage::delete('public/' . $pustaka->gambar);
        }

        $pustaka->delete();

        return redirect()->route('pustaka.index')->with('success', 'Pustaka berhasil dihapus.');
    }
}