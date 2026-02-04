@extends('admin.layout')

@section('content')
<div class="container">
    <h1>Tambah Jenis Anggota</h1>
    <form action="{{ route('jenisanggota.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="kode_jenis_anggota" class="form-label">Kode Jenis Anggota</label>
            <input type="text" name="kode_jenis_anggota" class="form-control" id="kode_jenis_anggota" required>
        </div>
        <div class="mb-3">
            <label for="jenis_anggota" class="form-label">Jenis Anggota</label>
            <input type="text" name="jenis_anggota" class="form-control" id="jenis_anggota" required>
        </div>
        <div class="mb-3">
            <label for="max_pinjam" class="form-label">Maksimal Pinjam</label>
            <input type="number" name="max_pinjam" class="form-control" id="max_pinjam" required>
        </div>
        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea name="keterangan" class="form-control" id="keterangan"></textarea>
        </div>
        <a href="{{ route('jenisanggota.index') }}" class="btn btn-secondary me-2">Kembali</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection