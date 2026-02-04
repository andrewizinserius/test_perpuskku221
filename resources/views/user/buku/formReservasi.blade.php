@extends('user.layout')

@section('content')
<div class="container py-5" style="max-width:800px">

    <h3 class="mb-4 fw-bold text-center">Form Reservasi Buku</h3>

    {{-- Info Buku --}}
    @if(isset($buku))
    <div class="card mb-4 shadow-sm">
        <div class="card-body d-flex gap-3">
            <img src="{{ $buku->gambar ? asset('storage/'.$buku->gambar) : 'https://via.placeholder.com/150' }}"
                 width="120" class="rounded">

            <div>
                <h5>{{ $buku->judul_pustaka }}</h5>
                <p class="mb-1">
                    Pengarang: {{ $buku->pengarang->nama_pengarang ?? '-' }}
                </p>
                <span class="badge bg-success">
                    Stok: {{ $buku->jml_book }}
                </span>
            </div>
        </div>
    </div>
    @endif

    {{-- Form --}}
    @if(isset($buku))
    <form action="{{ route('buku.storeReservasi', $buku->id_pustaka) }}" method="POST">
        @csrf
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Tanggal Pinjam</label>
                <input type="date" name="tgl_pinjam" class="form-control"
                       value="{{ date('Y-m-d') }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Tanggal Kembali</label>
                <input type="date" name="tgl_kembali" class="form-control"
                       value="{{ date('Y-m-d', strtotime('+7 days')) }}" readonly>
                <small class="text-muted">Tanggal kembali otomatis 7 hari setelah pinjam</small>
            </div>
        </div>

        <div class="mb-3">
            <label>Keterangan (Opsional)</label>
            <textarea name="keterangan" class="form-control" placeholder="Contoh: Untuk tugas kuliah"></textarea>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('user.index') }}" class="btn btn-secondary w-50">
                Kembali
            </a>
            <button class="btn btn-primary w-50">
                Ajukan Reservasi
            </button>
        </div>
    </form>
    @else
    <div class="alert alert-danger">
        Buku tidak ditemukan!
    </div>
    @endif

</div>
@endsection