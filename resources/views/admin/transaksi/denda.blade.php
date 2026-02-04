@extends('admin.layout')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-money-bill-wave me-2"></i>
                        Detail Denda - Transaksi #{{ $transaksi->id_transaksi }}
                    </h4>
                </div>
                <div class="card-body">
                    <!-- Informasi Transaksi -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6>Informasi Buku</h6>
                            <p class="mb-1"><strong>Judul:</strong> {{ $transaksi->pustaka->judul_pustaka }}</p>
                            <p class="mb-1"><strong>Kode:</strong> {{ $transaksi->pustaka->id_pustaka }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6>Informasi Anggota</h6>
                            <p class="mb-1"><strong>Nama:</strong> {{ $transaksi->anggota->nama_anggota }}</p>
                            <p class="mb-1"><strong>NIM/NIS:</strong> {{ $transaksi->anggota->nim_anggota ?? '-' }}</p>
                        </div>
                    </div>

                    <!-- Timeline Pengembalian -->
                    <div class="row mb-4">
                        <div class="col-md-4 text-center">
                            <div class="card border-primary">
                                <div class="card-body">
                                    <h6>Tanggal Pinjam</h6>
                                    <h5 class="text-primary">{{ $transaksi->tgl_pinjam }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="card border-info">
                                <div class="card-body">
                                    <h6>Tanggal Harus Kembali</h6>
                                    <h5 class="text-info">{{ $transaksi->tgl_kembali }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="card border-{{ $transaksi->tgl_pengembalian ? 'success' : 'warning' }}">
                                <div class="card-body">
                                    <h6>Tanggal Dikembalikan</h6>
                                    <h5 class="{{ $transaksi->tgl_pengembalian ? 'text-success' : 'text-warning' }}">
                                        {{ $transaksi->tgl_pengembalian ?? 'Belum Dikembalikan' }}
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Denda -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Rincian Denda</h5>
                        </div>
                        <div class="card-body">
                            @if($transaksi->fp == 2)
                                <!-- Denda Buku Hilang -->
                                <div class="alert alert-danger">
                                    <h6><i class="fas fa-exclamation-triangle me-2"></i>BUKU HILANG</h6>
                                    <p class="mb-2">Buku ditandai hilang pada: {{ $transaksi->tgl_pengembalian }}</p>
                                    <div class="d-flex justify-content-between">
                                        <span>Denda Buku Hilang:</span>
                                        <strong>Rp {{ number_format($dendaHilang, 0, ',', '.') }}</strong>
                                    </div>
                                </div>
                            @elseif($hariTerlambat > 0)
                                <!-- Denda Keterlambatan -->
                                <div class="alert alert-warning">
                                    <h6><i class="fas fa-clock me-2"></i>KETERLAMBATAN</h6>
                                    <p class="mb-2">Terlambat mengembalikan: <strong>{{ $hariTerlambat }} hari</strong></p>
                                    <div class="d-flex justify-content-between">
                                        <span>Denda per hari (Rp 6.000):</span>
                                        <strong>Rp {{ number_format($hariTerlambat * 6000, 0, ',', '.') }}</strong>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2">
                                        <span>Denda Telat:</span>
                                        <strong>Rp {{ number_format($dendaTelat, 0, ',', '.') }}</strong>
                                    </div>
                                </div>
                            @elseif($transaksi->fp == 1 && $transaksi->tgl_pengembalian)
                                <!-- Tepat waktu -->
                                <div class="alert alert-success">
                                    <h6><i class="fas fa-check-circle me-2"></i>DIKEMBALIKAN TEPAT WAKTU</h6>
                                    <p class="mb-0">Buku dikembalikan sesuai tanggal jatuh tempo.</p>
                                </div>
                            @else
                                <!-- Belum dikembalikan -->
                                <div class="alert alert-info">
                                    <h6><i class="fas fa-info-circle me-2"></i>BELUM DIKEMBALIKAN</h6>
                                    <p class="mb-0">Buku masih dalam masa peminjaman.</p>
                                </div>
                            @endif

                            <!-- Total Denda -->
                            <div class="total-denda mt-3 pt-3 border-top">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Total Denda:</h5>
                                    <h3 class="mb-0 text-{{ $totalDenda > 0 ? 'danger' : 'success' }}">
                                        Rp {{ number_format($totalDenda, 0, ',', '.') }}
                                    </h3>
                                </div>
                            </div>

                            <!-- Status Pembayaran -->
                            <div class="status-pembayaran mt-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>Status Pembayaran:</span>
                                    @if($transaksi->denda_dibayar)
                                        <span class="badge bg-success">
                                            <i class="fas fa-check-circle me-1"></i>
                                            LUNAS
                                            @if($transaksi->tgl_bayar_denda)
                                                ({{ $transaksi->tgl_bayar_denda }})
                                            @endif
                                        </span>
                                    @elseif($totalDenda > 0)
                                        <span class="badge bg-danger">
                                            <i class="fas fa-exclamation-circle me-1"></i>
                                            BELUM DIBAYAR
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">
                                            TIDAK ADA DENDA
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
                        </a>
                        
                        @if($totalDenda > 0 && !$transaksi->denda_dibayar)
                            <form action="{{ route('transaksi.payDenda', $transaksi->id_transaksi) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success" 
                                        onclick="return confirm('Konfirmasi pembayaran denda Rp {{ number_format($totalDenda, 0, ',', '.') }}?')">
                                    <i class="fas fa-credit-card me-2"></i>Bayar Denda
                                </button>
                            </form>
                        @endif
                        
                        <a href="{{ route('transaksi.edit', $transaksi->id_transaksi) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>Edit Transaksi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection