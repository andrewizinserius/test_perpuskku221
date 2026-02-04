<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Format;  // Pastikan model sudah ada
use Illuminate\Http\Request;

class FormatsController extends Controller
{
    public function index()
    {
        $formats = Format::all();
        return view('admin.format.index', compact('formats'));
    }

    public function create()
    {
        return view('admin.format.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_format' => 'required|unique:tbl_format,kode_format|max:10',
            'format' => 'required|max:25',
            'keterangan' => 'nullable|max:50',
        ]);

        Format::create($request->all());

        return redirect()->route('formats.index')->with('success', 'Format berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $format = Format::findOrFail($id);
        return view('admin.format.edit', compact('format'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_format' => 'required|unique:tbl_format,kode_format,' . $id . ',id_format|max:10',
            'format' => 'required|max:25',
            'keterangan' => 'nullable|max:50',
        ]);

        $format = Format::findOrFail($id);
        $format->update($request->all());

        return redirect()->route('formats.index')->with('success', 'Format berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $format = Format::findOrFail($id);
        $format->delete();

        return redirect()->route('formats.index')->with('success', 'Format berhasil dihapus.');
    }
}
