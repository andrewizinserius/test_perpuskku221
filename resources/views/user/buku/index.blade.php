@extends('user.layout')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4 fw-bold">Daftar Buku</h1>

    <!-- Cek apakah ada buku yang tersedia -->
    @if ($buku->isEmpty())
        <p class="text-center text-danger">Tidak ada buku yang tersedia untuk dipinjam.</p>
    @else
        <div class="row g-4">
            @foreach ($buku as $item)
                <div class="col-md-3 col-sm-6">
                    <a href="{{ route('buku.detail', ['id' => $item->id_pustaka]) }}"
                        class="card-custom h-100 text-decoration-none">
                        <div class="card h-100 shadow-sm border-0 position-relative card-hover">
                            <!-- Gambar Buku -->
                            <div class="image-wrapper" style="height: 250px; overflow: hidden;">
                                <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : 'https://via.placeholder.com/150x200?text=No+Image' }}"
                                    class="card-img-top" alt="{{ $item->judul_pustaka }}"
                                    style="width: 100%; height: 100%; object-fit: contain;">
                            </div>
                            <!-- Judul Buku -->
                            <div class="card-body text-center">
                                <h5 class="card-title text-truncate text-primary" title="{{ $item->judul_pustaka }}">
                                    {{ $item->judul_pustaka }}
                                </h5>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

{{-- <style>
    /* Hover Effect */
    .card-hover {
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .card-hover:hover {
        background-color: #f8f9fa;
        /* Warna latar sedikit lebih terang */
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
        /* Tambahkan sedikit bayangan */
    }

    .card-hover img {
        transition: opacity 0.3s ease;
    }

    .card-hover:hover img {
        opacity: 0.9;
        /* Sedikit penggelapan gambar */
    }

    /* Pastikan judul tetap biru selama hover */
    .card-hover h5.card-title {
        color: #0d6efd !important;
        /* Tetapkan warna biru Bootstrap */
        transition: color 0.3s ease;
    }

    .card-hover:hover h5.card-title {
        color: #0d6efd !important;
        /* Tetap biru saat hover */
    }
</style> --}}