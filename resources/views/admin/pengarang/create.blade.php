@extends('admin.layout')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-semibold mb-4">Tambah Pengarang</h1>

    <form action="{{ route('pengarang.store') }}" method="POST">
        @csrf

        <!-- Kode Pengarang -->
        <div class="form-group mb-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">Kode Pengarang</label>
            <input type="text" class="form-control w-full" value="{{ $kodeBaru }}" readonly>
        </div>

        <!-- Gelar Depan -->
        <div class="form-group mb-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">Gelar Depan</label>
            <input type="text" name="gelar_depan" class="form-control w-full" placeholder="Contoh: Dr.">
        </div>

        <!-- Nama Pengarang -->
        <div class="form-group mb-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Pengarang</label>
            <input type="text" name="nama_pengarang" class="form-control w-full" required>
        </div>

        <!-- Kelamin -->
<div class="form-group mb-2">
    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
    <select name="kelamin" class="form-control w-full" required>
        <option value="">-- Pilih --</option>
        <option value="L">Laki-laki</option>
        <option value="P">Perempuan</option>
    </select>
</div>


        <!-- Gelar Belakang -->
        <div class="form-group mb-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">Gelar Belakang</label>
            <input type="text" name="gelar_belakang" class="form-control w-full" placeholder="Contoh: M.Sc.">
        </div>

        <!-- No Telepon -->
        <div class="form-group mb-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">No Telepon</label>
            <input type="text" name="no_telp" class="form-control w-full" required>
        </div>

        <!-- Email -->
        <div class="form-group mb-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
            <input type="email" name="email" class="form-control w-full" required>
        </div>

        <!-- Website -->
        <div class="form-group mb-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">Website</label>
            <input type="url" name="website" class="form-control w-full">
        </div>

        <!-- Biografi -->
        <div class="form-group mb-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">Biografi</label>
            <textarea name="biografi" class="form-control w-full" rows="5" required></textarea>
        </div>

        <!-- Keterangan -->
        <div class="form-group mb-2">
            <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
            <input type="text" name="keterangan" class="form-control w-full">
        </div>

        <div class="form-group">
            <a href="{{ route('pengarang.index') }}" class="btn btn-secondary me-2">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>
@endsection
