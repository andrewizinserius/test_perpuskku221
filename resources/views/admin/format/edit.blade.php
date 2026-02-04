@extends('admin.layout')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Format</h1>
    <form action="{{ route('formats.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="kode_format" class="form-label">Kode Format</label>
            <input type="text" class="form-control @error('kode_format') is-invalid @enderror" id="kode_format"
                name="kode_format" value="{{ old('kode_format') }}" required>
            @error('kode_format')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="format" class="form-label">Format</label>
            <input type="text" class="form-control @error('format') is-invalid @enderror" id="format" name="format"
                value="{{ old('format') }}" required>
            @error('format')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan"
                name="keterangan" value="{{ old('keterangan') }}">
            @error('keterangan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <a href="{{ route('formats.index') }}" class="btn btn-secondary me-2">Kembali</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection