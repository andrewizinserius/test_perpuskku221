<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // Menampilkan foto profil pengguna
    public function showProfile()
    {
        // Mengambil foto profil pengguna yang sedang login
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    // Mengubah foto profil pengguna
    public function updateProfilePhoto(Request $request)
    {
        // Validasi file foto
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Maksimal 2MB
        ]);

        // Hapus foto lama jika ada
        if ($request->hasFile('foto')) {
            $user = Auth::user();

            // Cek apakah foto lama ada di direktori dan hapus
            if ($user->foto && Storage::exists('public/anggota_photos/' . $user->foto)) {
                Storage::delete('public/anggota_photos/' . $user->foto);
            }

            // Menyimpan foto baru
            $foto = $request->file('foto');
            $fotoName = time() . '.' . $foto->getClientOriginalExtension(); // Menyimpan dengan nama unik
            $foto->storeAs('public/anggota_photos', $fotoName);

            // Memperbarui foto pengguna di database
            $user->foto = $fotoName;
            $user->save();
        }

        // Kembali ke halaman profil dengan pesan sukses
        return redirect()->route('profile')->with('success', 'Foto profil berhasil diperbarui');
    }
}