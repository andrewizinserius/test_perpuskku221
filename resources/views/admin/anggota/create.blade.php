@extends('admin.layout')

@section('content')
<div class="container">
    <h1>Tambah Anggota Baru</h1>

    <form action="{{ route('anggota.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-2 gap-4 d">
            <!-- Kode Anggota -->
            <div class="row mb-3">
                <div class="col">
                    <label for="kode_anggota" class="form-label">Kode Anggota</label>
                    <input type="text" name="kode_anggota" id="kode_anggota" class="form-control w-100"
                        value="{{ old('kode_anggota', $nextKodeAnggota) }}" readonly required>
                </div>
                <div class="col">
                    <label for="nama_anggota" class="form-label">Nama Anggota</label>
                    <input type="text" name="nama_anggota" id="nama_anggota" class="form-control w-100" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="id_jenis_anggota" class="form-label">Jenis Anggota</label>
                    <select name="id_jenis_anggota" id="id_jenis_anggota" class="form-select" required>
                        @foreach($jenisAnggota as $jenis)
                            <option value="{{ $jenis->id_jenis_anggota }}">{{ $jenis->jenis_anggota }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label for="tempat" class="form-label">Tempat Lahir</label>
                    <input type="text" name="tempat" id="tempat" class="form-control" required>
                </div>
            </div>
            <!-- Tanggal Lahir -->
            <div class="row mb-3">
                <div class="col">
                    <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" required>
                </div>
                <div class="col">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" name="alamat" id="alamat" class="form-control" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="no_telp" class="form-label">No Telepon</label>
                    <input type="text" name="no_telp" id="no_telp" class="form-control" required>
                </div>
                <div class="col">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
            </div>
            <div class=" row mb-3">
                <div class="col">
                    <label for="tgl_daftar" class="form-label">Tanggal Daftar</label>
                    <input type="date" name="tgl_daftar" id="tgl_daftar" class="form-control" required>
                </div>
                <div class="col">
                    <label for="masa_aktif" class="form-label">Masa Aktif</label>
                    <input type="date" name="masa_aktif" id="masa_aktif" class="form-control" required>
                </div>
            </div>

            <!-- Status Akun (Aktif/Non-Aktif) -->
            <div class="row mb-3">
                <div class="col">
                    <label for="fa" class="form-label">Status Akun (Aktif/Non-Aktif)</label>
                    <select name="fa" id="fa" class="form-select" required>
                        <option value="Y">Aktif</option>
                        <option value="T">Non-Aktif</option>
                    </select>
                </div>
                <div class="col">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <input type="text" name="keterangan" id="keterangan" class="form-control" required>
                </div>
            </div>
            <!-- Foto -->
            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input type="file" name="foto" id="foto" class="form-control">
            </div>

            <!-- Username -->
            <div class="row mb-3">
                <div class="col">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" id="username" class="form-control" required>
                </div>
                <div class="col">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
            </div>
        </div>

        <a href="{{ route('anggota.index') }}" class="btn btn-secondary me-2">Kembali</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection