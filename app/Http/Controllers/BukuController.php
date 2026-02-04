<?php

namespace App\Http\Controllers;

use App\Models\Pustaka;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BukuController extends Controller
{
    // Menampilkan detail buku
    public function show($id)
    {
        $buku = Pustaka::with(['ddc', 'format', 'penerbit', 'pengarang'])->findOrFail($id);
        return view('user.buku.detail', compact('buku'));
    }

    // Melakukan reservasi buku
    public function reservasi(Request $request)
    {
        $request->validate([
            'id_pustaka' => 'required|exists:tbl_pustaka,id_pustaka',
        ]);

        $id_anggota = Auth::id(); // Mengambil ID anggota yang sedang login

        // Buat transaksi baru
        Transaksi::create([
            'id_pustaka' => $request->id_pustaka,
            'id_anggota' => $id_anggota,
            'tgl_pinjam' => now(),
            'tgl_kembali' => now()->addDays(7), // Atur tanggal kembali 7 hari dari sekarang
            'fp' => '0', // Flag pinjam
            'keterangan' => 'Reservasi buku',
        ]);

        return redirect()->back()->with('success', 'Reservasi buku berhasil dilakukan.');
    }
}
