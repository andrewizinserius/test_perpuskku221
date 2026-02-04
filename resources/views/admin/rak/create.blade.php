@extends('admin.layout')

@section('content')
<div class="container mt-5">
    <h1>Tambah Rak</h1>

    <form action="{{ route('rak.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="rak" class="form-label">Nama Rak</label>
            <input type="text" name="rak" class="form-control" id="rak" placeholder="Masukkan nama rak" required>
        </div>

        <div class="form-group mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea name="keterangan" class="form-control" id="keterangan" rows="3" placeholder="Masukkan keterangan"
                required></textarea>
        </div>

        <div class="d-flex justify-content-start">
            <a href="{{ route('rak.index') }}" class="btn btn-secondary me-2">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>
@endsection