@extends('admin.layout')

@section('content')
<div class="container">
    <h1>Edit Jenis Anggota</h1>
    <form action="{{ route('jenisanggota.update', $jenisAnggota->id_jenis_anggota) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="kode_jenis_anggota" class="form-label">Kode Jenis Anggota</label>
            <input type="text" name="kode_jenis_anggota" class="form-control" id="kode_jenis_anggota"
                value="{{ $jenisAnggota->kode_jenis_anggota }}" required>
        </div>
        <div class="mb-3">
            <label for="jenis_anggota" class="form-label">Jenis Anggota</label>
            <input type="text" name="jenis_anggota" class="form-control" id="jenis_anggota"
                value="{{ $jenisAnggota->jenis_anggota }}" required>
        </div>
        <div class="mb-3">
            <label for="max_pinjam" class="form-label">Maksimal Pinjam</label>
            <input type="number" name="max_pinjam" class="form-control" id="max_pinjam"
                value="{{ $jenisAnggota->max_pinjam }}" required>
        </div>
        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea name="keterangan" class="form-control" id="keterangan">{{ $jenisAnggota->keterangan }}</textarea>
        </div>
        <a href="{{ route('jenisanggota.index') }}" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection