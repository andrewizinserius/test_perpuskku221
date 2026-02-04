<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penerbit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenerbitController extends Controller
{
    public function index()
    {
        $penerbit = Penerbit::all();
        return view('admin.penerbit.index', compact('penerbit'));
    }

    public function show($id)
    {
        $penerbit = Penerbit::findOrFail($id);
        return view('admin.penerbit.show', compact('penerbit'));
    }

    public function create()
    {
        // Ambil kode terakhir
        $last = DB::table('tbl_penerbit')->orderBy('id_penerbit', 'desc')->first();

        if ($last) {
            $lastNumber = (int) substr($last->kode_penerbit, 2);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $kodeBaru = 'PN' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        return view('admin.penerbit.create', compact('kodeBaru'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_penerbit'   => 'required|string|max:50|unique:tbl_penerbit,nama_penerbit',
            'alamat_penerbit' => 'required|string|max:150',
            'no_telp'         => 'required|string|max:15',
            'email'           => 'required|email|max:30|unique:tbl_penerbit,email',
            'fax'             => 'nullable|string|max:15',
            'website'         => 'nullable|string|max:50',
            'kontak'          => 'nullable|string|max:50',
        ]);

        // Generate kode otomatis (DOUBLE SAFETY)
        $last = DB::table('tbl_penerbit')->orderBy('id_penerbit', 'desc')->first();

        if ($last) {
            $lastNumber = (int) substr($last->kode_penerbit, 2);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $validated['kode_penerbit'] = 'PN' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        Penerbit::create($validated);

        return redirect()->route('penerbit.index')->with('success', 'Penerbit berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $penerbit = Penerbit::findOrFail($id);
        return view('admin.penerbit.edit', compact('penerbit'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_penerbit'   => 'required|string|max:50|unique:tbl_penerbit,nama_penerbit,' . $id . ',id_penerbit',
            'alamat_penerbit' => 'required|string|max:150',
            'no_telp'         => 'required|string|max:15',
            'email'           => 'required|email|max:30|unique:tbl_penerbit,email,' . $id . ',id_penerbit',
            'fax'             => 'nullable|string|max:15',
            'website'         => 'nullable|string|max:50',
            'kontak'          => 'nullable|string|max:50',
        ]);

        $penerbit = Penerbit::findOrFail($id);
        $penerbit->update($validated);

        return redirect()->route('penerbit.index')->with('success', 'Penerbit berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $penerbit = Penerbit::findOrFail($id);
        $penerbit->delete();

        return redirect()->route('penerbit.index')->with('success', 'Penerbit berhasil dihapus.');
    }
}
