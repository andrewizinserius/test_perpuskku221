<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pengarang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PengarangController extends Controller
{
    public function index()
    {
        $pengarangs = Pengarang::all();
        return view('admin.pengarang.index', compact('pengarangs'));
    }

    public function show($id)
    {
        $pengarang = Pengarang::findOrFail($id);
        return view('admin.pengarang.show', compact('pengarang'));
    }

    public function create()
    {
        // Generate kode otomatis PGxxx
        $last = DB::table('tbl_pengarang')->orderBy('id_pengarang', 'desc')->first();

        if ($last) {
            $lastNumber = (int) substr($last->kode_pengarang, 2);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $kodeBaru = 'PG' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        return view('admin.pengarang.create', compact('kodeBaru'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
    'gelar_depan'     => 'nullable|string|max:10',
    'nama_pengarang'  => 'required|string|max:50|unique:tbl_pengarang,nama_pengarang',
    'kelamin'         => 'required|in:L,P',
    'gelar_belakang'  => 'nullable|string|max:10',
    'no_telp'         => 'required|string|max:15',
    'email'           => 'required|email|max:30|unique:tbl_pengarang,email',
    'website'         => 'nullable|url|max:50',
    'biografi'        => 'required|string',
    'keterangan'      => 'nullable|string|max:50',
]);


        // Generate ulang (double safety)
        $last = DB::table('tbl_pengarang')->orderBy('id_pengarang', 'desc')->first();

        if ($last) {
            $lastNumber = (int) substr($last->kode_pengarang, 2);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $validated['kode_pengarang'] = 'PG' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        Pengarang::create($validated);

        return redirect()->route('pengarang.index')->with('success', 'Pengarang berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pengarang = Pengarang::findOrFail($id);
        return view('admin.pengarang.edit', compact('pengarang'));
    }

    public function update(Request $request, $id)
    {
        $pengarang = Pengarang::findOrFail($id);
$validated = $request->validate([
    'gelar_depan'     => 'nullable|string|max:10',
    'nama_pengarang'  => 'required|string|max:50|unique:tbl_pengarang,nama_pengarang,' . $id . ',id_pengarang',
    'kelamin'         => 'required|in:L,P',
    'gelar_belakang'  => 'nullable|string|max:10',
    'no_telp'         => 'required|string|max:15',
    'email'           => 'required|email|max:30|unique:tbl_pengarang,email,' . $id . ',id_pengarang',
    'website'         => 'nullable|url|max:50',
    'biografi'        => 'required|string',
    'keterangan'      => 'nullable|string|max:50',
]);


        // KODE TIDAK BOLEH DIUBAH
        unset($validated['kode_pengarang']);

        $pengarang->update($validated);

        return redirect()->route('pengarang.index')->with('success', 'Pengarang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pengarang = Pengarang::findOrFail($id);
        $pengarang->delete();

        return redirect()->route('pengarang.index')->with('success', 'Pengarang berhasil dihapus.');
    }
}
