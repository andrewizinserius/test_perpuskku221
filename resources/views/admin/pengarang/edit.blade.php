@extends('admin.layout')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-semibold mb-4">Edit Pengarang</h1>

    <form action="{{ route('pengarang.update', $pengarang->id_pengarang) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-2">   
            <label for="kode_pengarang" class="block text-sm font-medium text-gray-700 mb-2">Kode Pengarang</label>
            <input type="text" name="kode_pengarang" id="kode_pengarang" class="form-control w-full" placeholder="PG123"
                value="{{ old('kode_pengarang', $pengarang->kode_pengarang) }}" required>
            <small class="text-muted">Kode harus diawali dengan "PG" diikuti angka.</small>
        </div>

        <div class="form-group mb-2">
            <label for="gelar_depan" class="block text-sm font-medium text-gray-700 mb-2">Gelar Depan</label>
            <input type="text" name="gelar_depan" id="gelar_depan" class="form-control w-full"
                value="{{ old('gelar_depan', $pengarang->gelar_depan) }}">
        </div>

        

        <div class="form-group mb-2">
            <label for="nama_pengarang" class="block text-sm font-medium text-gray-700 mb-2">Nama Pengarang</label>
            <input type="text" name="nama_pengarang" id="nama_pengarang" class="form-control w-full"
                value="{{ old('nama_pengarang', $pengarang->nama_pengarang) }}" required>
        </div>

        <div class="form-group mb-2">
    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
    <select name="kelamin" class="form-control w-full" required>
        <option value="L" {{ $pengarang->kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
        <option value="P" {{ $pengarang->kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
    </select>
</div>


        <div class="form-group mb-2">
            <label for="gelar_belakang" class="block text-sm font-medium text-gray-700 mb-2">Gelar Belakang</label>
            <input type="text" name="gelar_belakang" id="gelar_belakang" class="form-control w-full"
                value="{{ old('gelar_belakang', $pengarang->gelar_belakang) }}">
        </div>

        <div class="form-group mb-2">
            <label for="no_telp" class="block text-sm font-medium text-gray-700 mb-2">No Telp</label>
            <input type="text" name="no_telp" id="no_telp" class="form-control w-full"
                value="{{ old('no_telp', $pengarang->no_telp) }}" required>
        </div>

        <div class="form-group mb-2">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
            <input type="email" name="email" id="email" class="form-control w-full"
                value="{{ old('email', $pengarang->email) }}" required>
        </div>

        <div class="form-group mb-2">
            <label for="website" class="block text-sm font-medium text-gray-700 mb-2">Website</label>
            <input type="url" name="website" id="website" class="form-control w-full"
                value="{{ old('website', $pengarang->website) }}">
        </div>

        <div class="form-group mb-2">
            <label for="biografi" class="block text-sm font-medium text-gray-700 mb-2">Biografi</label>
            <textarea name="biografi" id="biografi" class="form-control w-full" rows="5"
                required>{{ old('biografi', $pengarang->biografi) }}</textarea>
        </div>

        <div class="form-group mb-3">
            <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
            <input type="text" name="keterangan" id="keterangan" class="form-control w-full"
                value="{{ old('keterangan', $pengarang->keterangan) }}">
        </div>

        <a href="{{ route('pengarang.index') }}" class="btn btn-secondary me-2">Kembali</a>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection