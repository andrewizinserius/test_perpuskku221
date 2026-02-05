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
    public function index()
    {
        $pustakas = Pustaka::all();
        return view('admin.pustaka.index', compact('pustakas'));
    }

    public function create()
    {
        return view('admin.pustaka.create', [
            'ddcs' => Ddc::all(),
            'formats' => Format::all(),
            'penerbits' => Penerbit::all(),
            'pengarangs' => Pengarang::all(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kode_pustaka' => 'required|numeric|unique:tbl_pustaka,kode_pustaka',
            'id_ddc' => 'required',
            'id_format' => 'required',
            'id_penerbit' => 'required',
            'id_pengarang' => 'required',
            'judul_pustaka' => 'required|string|max:100',
            'isbn' => 'nullable|string|max:20',
            'tahun_terbit' => 'nullable|string|max:5',
            'keyword' => 'required|string',
            'keterangan_fisik' => 'required|string',
            'keterangan_tambahan' => 'required|string',
            'abstraksi' => 'required|string',
            'gambar' => 'nullable|image|max:2048',
            'harga_buku' => 'required|numeric',
            'kondisi_buku' => 'required|string|max:15',
            'fp' => 'required',
            'denda_terlambat' => 'required|numeric',
            'denda_hilang' => 'required|numeric',
            'jml_book' => 'required|integer|min:0',
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('pustaka', 'public');
        }

        // PENTING
        $data['jml_pinjam'] = 0;

        Pustaka::create($data);

        return redirect()->route('pustaka.index')->with('success', 'Pustaka berhasil ditambahkan');
    }

    public function edit($id)
    {
        return view('admin.pustaka.edit', [
            'pustaka' => Pustaka::findOrFail($id),
            'ddcs' => Ddc::all(),
            'formats' => Format::all(),
            'penerbits' => Penerbit::all(),
            'pengarangs' => Pengarang::all(),
        ]);
    }

    public function update(Request $request, $id)
    {
        $pustaka = Pustaka::findOrFail($id);

        $data = $request->validate([
            'kode_pustaka' => 'required|numeric',
            'id_ddc' => 'required',
            'id_format' => 'required',
            'id_penerbit' => 'required',
            'id_pengarang' => 'required',
            'judul_pustaka' => 'required|string|max:100',
            'isbn' => 'nullable|string|max:20',
            'tahun_terbit' => 'nullable|string|max:5',
            'keyword' => 'required|string',
            'keterangan_fisik' => 'required|string',
            'keterangan_tambahan' => 'required|string',
            'abstraksi' => 'required|string',
            'gambar' => 'nullable|image|max:2048',
            'harga_buku' => 'required|numeric',
            'kondisi_buku' => 'required|string|max:15',
            'fp' => 'required',
            'denda_terlambat' => 'required|numeric',
            'denda_hilang' => 'required|numeric',
            'jml_book' => 'required|integer|min:0',
        ]);

        if ($request->hasFile('gambar')) {
            if ($pustaka->gambar) {
                Storage::delete('public/' . $pustaka->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('pustaka', 'public');
        }

        $pustaka->update($data);

        return redirect()->route('pustaka.index')->with('success', 'Pustaka berhasil diperbarui');
    }
    public function show($id)
{
    $pustaka = Pustaka::findOrFail($id);
    return view('admin.pustaka.show', compact('pustaka'));
}


    public function destroy($id)
    {
        $pustaka = Pustaka::findOrFail($id);
        if ($pustaka->gambar) {
            Storage::delete('public/' . $pustaka->gambar);
        }
        $pustaka->delete();

        return redirect()->route('pustaka.index')->with('success', 'Pustaka dihapus');
    }
}
