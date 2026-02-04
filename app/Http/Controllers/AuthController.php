<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\TblAnggota;
use App\Models\JenisAnggota;
use App\Models\Anggota;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = TblAnggota::where('username', $credentials['username'])->first();

        if ($user) {
            if ($user->fa === 'T') {
                return back()->withErrors(['error' => 'Akun Anda belum aktif. Silakan hubungi admin untuk mengaktifkan akun.']);
            }

            if (Hash::check($credentials['password'], $user->password)) {
                Auth::login($user);

                if ($user->id_jenis_anggota == 3) {
                    return redirect()->route('admin.dashboard');
                } else {
                    return redirect()->route('user.index');
                }
            }
        }

        return back()->withErrors(['error' => 'Username atau password salah.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route(('welcome'));
    }

    public function showRegisterForm()
    {
        $jenisAnggota = JenisAnggota::all(); // Mengambil semua jenis anggota
        return view('auth.register', compact('jenisAnggota')); // Menampilkan jenis anggota di form register
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'id_jenis_anggota' => 'required|exists:tbl_jenis_anggota,id_jenis_anggota',
            'nama_anggota' => 'required|unique:tbl_anggota|max:100',
            'tempat' => 'required|max:20',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required|max:50',
            'no_telp' => 'required|max:15',
            'email' => 'required|email|max:30|unique:tbl_anggota',
            'foto' => 'nullable|image|max:2048',
            'username' => 'required|unique:tbl_anggota|max:50',
            'password' => 'required|confirmed|min:6|max:60',
        ]);

        // Handle foto upload jika ada
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('anggota_photos', 'public');
        }

        // Ambil kode anggota terakhir untuk membuat kode anggota baru
        $lastAnggota = Anggota::latest('id_anggota')->first();
        $lastKodeAnggota = $lastAnggota->kode_anggota;
        $kodeAnggota = $lastKodeAnggota + 1;
        // Membuat anggota baru dengan kode anggota otomatis
        Anggota::create([
            'kode_anggota' => $kodeAnggota, // Kode anggota otomatis
            'id_jenis_anggota' => $validated['id_jenis_anggota'],
            'nama_anggota' => $validated['nama_anggota'],
            'tempat' => $validated['tempat'],
            'tgl_lahir' => $validated['tgl_lahir'],
            'alamat' => $validated['alamat'],
            'no_telp' => $validated['no_telp'],
            'email' => $validated['email'],
            'tgl_daftar' => now(),
            'masa_aktif' => now()->addYear(), // Masa aktif 1 tahun
            'fa' => 'T', // Status default tidak aktif
            'foto' => $fotoPath ?? '',
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan tunggu persetujuan admin.');
    }

}