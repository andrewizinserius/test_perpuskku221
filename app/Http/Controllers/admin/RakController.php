<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rak;
use Illuminate\Http\Request;

class RakController extends Controller
{
    public function index()
    {
        $raks = Rak::all();
        return view('admin.rak.index', compact('raks'));
    }

    public function create()
    {
        return view('admin.rak.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'rak' => 'required|unique:tbl_rak,rak|max:25',
            'keterangan' => 'required|max:50',
        ]);

        // Ambil kode rak terakhir
        $lastRak = Rak::orderBy('id_rak', 'desc')->first();

        // Tentukan kode rak berikutnya
        $nextCode = 'RAK-001'; // Default jika belum ada rak
        if ($lastRak) {
            $lastCodeNumber = (int) str_replace('RAK-', '', $lastRak->kode_rak);
            $nextCode = 'RAK-' . str_pad($lastCodeNumber + 1, 3, '0', STR_PAD_LEFT);
        }

        // Simpan rak baru
        Rak::create([
            'kode_rak' => $nextCode,
            'rak' => $request->rak,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('rak.index')->with('success', 'Rak berhasil ditambahkan.');
    }



    public function edit($id)
    {
        $rak = Rak::findOrFail($id);
        return view('admin.rak.edit', compact('rak'));
    }

    public function update(Request $request, $id)
    {
        $rak = Rak::findOrFail($id); // Cari rak berdasarkan ID

        // Validasi input tanpa memperbarui kode_rak
        $request->validate([
            'rak' => 'required|max:25|unique:tbl_rak,rak,' . $id . ',id_rak',
            'keterangan' => 'required|max:50',
        ]);

        // Hanya perbarui field yang dibutuhkan
        $rak->update([
            'rak' => $request->rak,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('rak.index')->with('success', 'Rak berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $rak = Rak::findOrFail($id);
        $rak->delete();

        return redirect()->route('rak.index')->with('success', 'Rak berhasil dihapus.');
    }
}