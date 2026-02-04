@extends('user.layout')

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- Gambar Buku -->
        <div class="col-md-4">
            <img src="{{ $buku->gambar ? asset('storage/' . $buku->gambar) : 'https://via.placeholder.com/150x200?text=No+Image' }}"
                class="img-fluid rounded shadow" alt="{{ $buku->judul_pustaka }}"
                style="max-width: 100%; max-height: 500px; object-fit: contain;">
        </div>

        <!-- Detail Buku -->
        <div class="col-md-8">
            <h1>{{ $buku->judul_pustaka }}</h1>
            <p><strong>ISBN:</strong> {{ $buku->isbn }}</p>
            <p><strong>Pengarang:</strong> {{ $buku->pengarang->nama_pengarang }}</p>
            <p><strong>Penerbit:</strong> {{ $buku->penerbit->nama_penerbit }}</p>
            <p><strong>Tahun Terbit:</strong> {{ $buku->tahun_terbit }}</p>
            <p><strong>Kategori DDC:</strong> {{ $buku->ddc->ddc }}</p>
            <p><strong>Jumlah Buku:</strong> {{ $buku->jml_pinjam }}</p>
            <p><strong>Kondisi Buku:</strong> {{ $buku->kondisi_buku }}</p>
            <p><strong>Harga Buku:</strong> Rp {{ number_format($buku->harga_buku, 0, ',', '.') }}</p>
            <p>{{ $buku->abstraksi }}</p>

            <!-- Tombol Kembali dan Reservasi -->
            <div class="d-flex align-items-center mt-4">
                <a href="{{ route('user.buku.index') }}" class="btn btn-secondary me-2">Kembali</a>
                <form action="{{ route('buku.formReservasi', ['id' => $buku->id_pustaka]) }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_pustaka" value="{{ $buku->id_pustaka }}">
                    <button type="submit" class="btn btn-primary">Reservasi Buku</button>
                </form>
            </div>

            @if (session('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection