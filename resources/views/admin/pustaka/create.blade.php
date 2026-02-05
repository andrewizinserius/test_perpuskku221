@extends('admin.layout')

@section('content')
<div class="mb-4">
    <a href="{{ route('pustaka.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">
        Kembali ke Daftar Pustaka
    </a>
</div>

<form action="{{ route('pustaka.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<div class="mb-4">
    <label>Kode Pustaka</label>
    <input type="number" name="kode_pustaka" class="w-full p-2 border rounded" required>
</div>

<div class="mb-4">
    <label>DDC</label>
    <select name="id_ddc" class="w-full p-2 border rounded" required>
        <option value="">Pilih DDC</option>
        @foreach($ddcs as $ddc)
            <option value="{{ $ddc->id_ddc }}">{{ $ddc->kode_ddc }} - {{ $ddc->ddc }}</option>
        @endforeach
    </select>
</div>

<div class="mb-4">
    <label>Format</label>
    <select name="id_format" class="w-full p-2 border rounded" required>
        <option value="">Pilih Format</option>
        @foreach($formats as $format)
            <option value="{{ $format->id_format }}">{{ $format->format }}</option>
        @endforeach
    </select>
</div>

<div class="mb-4">
    <label>Penerbit</label>
    <select name="id_penerbit" class="w-full p-2 border rounded" required>
        <option value="">Pilih Penerbit</option>
        @foreach($penerbits as $penerbit)
            <option value="{{ $penerbit->id_penerbit }}">{{ $penerbit->nama_penerbit }}</option>
        @endforeach
    </select>
</div>

<div class="mb-4">
    <label>Pengarang</label>
    <select name="id_pengarang" class="w-full p-2 border rounded" required>
        <option value="">Pilih Pengarang</option>
        @foreach($pengarangs as $pengarang)
            <option value="{{ $pengarang->id_pengarang }}">{{ $pengarang->nama_pengarang }}</option>
        @endforeach
    </select>
</div>

<div class="mb-4">
    <label>Judul Pustaka</label>
    <input type="text" name="judul_pustaka" class="w-full p-2 border rounded" required>
</div>

<div class="mb-4">
    <label>ISBN</label>
    <input type="text" name="isbn" class="w-full p-2 border rounded">
</div>

<div class="mb-4">
    <label>Tahun Terbit</label>
    <input type="text" name="tahun_terbit" class="w-full p-2 border rounded">
</div>

<div class="mb-4">
    <label>Keyword</label>
    <input type="text" name="keyword" class="w-full p-2 border rounded">
</div>

<div class="mb-4">
    <label>Keterangan Fisik</label>
    <input type="text" name="keterangan_fisik" class="w-full p-2 border rounded">
</div>

<div class="mb-4">
    <label>Keterangan Tambahan</label>
    <input type="text" name="keterangan_tambahan" class="w-full p-2 border rounded">
</div>

<div class="mb-4">
    <label>Abstraksi</label>
    <textarea name="abstraksi" class="w-full p-2 border rounded"></textarea>
</div>

<div class="mb-4">
    <label>Gambar</label>
    <input type="file" name="gambar" class="w-full p-2 border rounded">
</div>

<div class="mb-4">
    <label>Harga Buku</label>
    <input type="number" name="harga_buku" class="w-full p-2 border rounded" required>
</div>

<div class="mb-4">
    <label>Kondisi Buku</label>
    <input type="text" name="kondisi_buku" class="w-full p-2 border rounded" required>
</div>

<div class="mb-4">
    <label>Flag</label>
    <select name="fp" class="w-full p-2 border rounded">
        <option value="0">N</option>
        <option value="1">Y</option>
    </select>
</div>

<div class="mb-4">
    <label>Denda Terlambat</label>
    <input type="number" name="denda_terlambat" class="w-full p-2 border rounded">
</div>

<div class="mb-4">
    <label>Denda Hilang</label>
    <input type="number" name="denda_hilang" class="w-full p-2 border rounded">
</div>

<div class="mb-4">
    <label>Jumlah Buku</label>
    <input type="number" name="jml_book" class="w-full p-2 border rounded" required>
</div>

<div class="mb-4">
    <button type="submit" class="btn btn-primary">Simpan Pustaka</button>
    <a href="{{ route('pustaka.index') }}" class="btn btn-secondary">Kembali</a>
</div>

</form>
@endsection
