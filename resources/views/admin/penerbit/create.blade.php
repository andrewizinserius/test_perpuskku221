@extends('admin.layout')

@section('content')
<div class="container">
    <h1>Tambah Penerbit</h1>

    <form action="{{ route('penerbit.store') }}" method="POST">
        @csrf

        <div class="form-group mb-2">
            <label>Kode Penerbit</label>
            <input type="text" class="form-control" value="{{ $kodeBaru }}" readonly>
        </div>

        <div class="form-group mb-2">
            <label>Nama Penerbit</label>
            <input type="text" name="nama_penerbit" class="form-control" required>
        </div>

        <div class="form-group mb-2">
            <label>Alamat</label>
            <input type="text" name="alamat_penerbit" class="form-control" required>
        </div>

        <div class="form-group mb-2">
            <label>No Telp</label>
            <div class="input-group">
                <span class="input-group-text">+62</span>
                <input type="text" name="no_telp" class="form-control" placeholder="8123456789" required>
            </div>
        </div>

        <div class="form-group mb-2">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group mb-2">
            <label>Fax</label>
            <input type="text" name="fax" class="form-control">
        </div>

        <div class="form-group mb-2">
            <label>Website</label>
            <input type="text" name="website" class="form-control">
        </div>

        <div class="form-group mb-2">
            <label>Kontak</label>
            <input type="text" name="kontak" class="form-control">
        </div>

        <a href="{{ route('penerbit.index') }}" class="btn btn-secondary mt-3 me-2">Kembali</a>
        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
    </form>
</div>
@endsection
