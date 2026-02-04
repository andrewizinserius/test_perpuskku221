@extends('admin.layout')

@section('content')
<div class="container">
    <h1>Edit Anggota</h1>
    <form action="{{ route('anggota.update', $anggota->id_anggota) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-4">
            <!-- Kode Anggota -->
            <div class="row mb-3">
                <div class="col">
                    <label for="kode_anggota" class="form-label">Kode Anggota</label>
                    <input type="text" class="form-control" id="kode_anggota" name="kode_anggota"
                        value="{{ old('kode_anggota', $anggota->kode_anggota) }}" required readonly>
                    @error('kode_anggota')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col">
                    <label for="nama_anggota" class="form-label">Nama Anggota</label>
                    <input type="text" class="form-control" id="nama_anggota" name="nama_anggota"
                        value="{{ old('nama_anggota', $anggota->nama_anggota) }}" required>
                    @error('nama_anggota')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Jenis Anggota -->
            <div class="row mb-3">
                <div class="col">
                    <label for="id_jenis_anggota" class="form-label">Jenis Anggota</label>
                    <select class="form-control" id="id_jenis_anggota" name="id_jenis_anggota" required>
                        @foreach ($jenisAnggota as $jenis)
                            <option value="{{ $jenis->id_jenis_anggota }}" {{ old('id_jenis_anggota', $anggota->id_jenis_anggota) == $jenis->id_jenis_anggota ? 'selected' : '' }}>
                                {{ $jenis->jenis_anggota }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_jenis_anggota')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col">
                    <label for="tempat" class="form-label">Tempat Lahir</label>
                    <input type="text" class="form-control" id="tempat" name="tempat"
                        value="{{ old('tempat', $anggota->tempat) }}" required>
                    @error('tempat')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Tanggal Lahir -->
            <div class="row mb-3">
                <div class="col">
                    <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir"
                        value="{{ old('tgl_lahir', $anggota->tgl_lahir) }}" required>
                    @error('tgl_lahir')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat"
                        value="{{ old('alamat', $anggota->alamat) }}" required>
                    @error('alamat')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- No Telepon -->
            <div class="row mb-3">
                <div class="col">
                    <label for="no_telp" class="form-label">No Telepon</label>
                    <input type="text" class="form-control" id="no_telp" name="no_telp"
                        value="{{ old('no_telp', $anggota->no_telp) }}" required>
                    @error('no_telp')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="{{ old('email', $anggota->email) }}" required>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Tanggal Daftar -->
            <div class="row mb-3">
                <div class="col">
                    <label for="tgl_daftar" class="form-label">Tanggal Daftar</label>
                    <input type="date" class="form-control" id="tgl_daftar" name="tgl_daftar"
                        value="{{ old('tgl_daftar', $anggota->tgl_daftar) }}" required>
                    @error('tgl_daftar')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col">
                    <label for="masa_aktif" class="form-label">Masa Aktif</label>
                    <input type="date" class="form-control" id="masa_aktif" name="masa_aktif"
                        value="{{ old('masa_aktif', $anggota->masa_aktif) }}" required>
                    @error('masa_aktif')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Status Akun -->
            <div class="row mb-3">
                <div class="col">
                    <label for="fa" class="form-label">Status Akun</label>
                    <select class="form-control" id="fa" name="fa" required>
                        <option value="Y" {{ old('fa', $anggota->fa) == 'Y' ? 'selected' : '' }}>Aktif</option>
                        <option value="T" {{ old('fa', $anggota->fa) == 'T' ? 'selected' : '' }}>Non-Aktif</option>
                    </select>
                    @error('fa')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <input type="text" class="form-control" id="keterangan" name="keterangan"
                        value="{{ old('keterangan', $anggota->keterangan) }}" required>
                    @error('keterangan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Foto -->
            <div class="row mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input type="file" class="form-control" id="foto" name="foto">
                @error('foto')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Username -->
            <div class="row mb-3">
                <div class="col">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username"
                        value="{{ old('username', $anggota->username) }}" required>
                    @error('username')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col">
                    <label for="password" class="form-label">Password (Kosongkan jika tidak ingin mengubah)</label>
                    <input type="password" class="form-control" id="password" name="password">
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('anggota.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection