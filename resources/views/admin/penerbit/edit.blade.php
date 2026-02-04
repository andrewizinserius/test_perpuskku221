@extends('admin.layout')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Edit Penerbit</h1>
    </div>

    <div class="card p-4">
        <form action="{{ route('penerbit.update', $penerbit->id_penerbit) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="kode_penerbit" class="form-label">Kode Penerbit</label>
                <input type="text" name="kode_penerbit" id="kode_penerbit" class="form-control"
                    value="{{ old('kode_penerbit', $penerbit->kode_penerbit) }}" placeholder="PN123">
                <small class="text-muted">Kode harus diawali dengan "PN" diikuti angka.</small>
                @error('kode_penerbit')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="nama_penerbit" class="form-label">Nama Penerbit</label>
                <input type="text" name="nama_penerbit" id="nama_penerbit" class="form-control"
                    value="{{ old('nama_penerbit', $penerbit->nama_penerbit) }}" placeholder="Nama Penerbit">
                @error('nama_penerbit')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="alamat_penerbit" class="form-label">Alamat Penerbit</label>
                <textarea name="alamat_penerbit" id="alamat_penerbit" class="form-control"
                    placeholder="Alamat lengkap">{{ old('alamat_penerbit', $penerbit->alamat_penerbit) }}</textarea>
                @error('alamat_penerbit')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="no_telp" class="form-label">No. Telepon</label>
                <input type="text" name="no_telp" id="no_telp" class="form-control"
                    value="{{ old('no_telp', $penerbit->no_telp) }}" placeholder="08XXXXXXXXXX">
                @error('no_telp')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control"
                    value="{{ old('email', $penerbit->email) }}" placeholder="email@example.com">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="fax" class="form-label">Fax</label>
                <input type="text" name="fax" id="fax" class="form-control" value="{{ old('fax', $penerbit->fax) }}"
                    placeholder="Fax Number">
                @error('fax')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="website" class="form-label">Website</label>
                <input type="url" name="website" id="website" class="form-control"
                    value="{{ old('website', $penerbit->website) }}" placeholder="https://example.com">
                @error('website')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="kontak" class="form-label">Kontak Person</label>
                <input type="text" name="kontak" id="kontak" class="form-control"
                    value="{{ old('kontak', $penerbit->kontak) }}" placeholder="Nama Kontak">
                @error('kontak')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <a href="{{ route('penerbit.index') }}" class="btn btn-secondary me-2">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
</div>
@endsection