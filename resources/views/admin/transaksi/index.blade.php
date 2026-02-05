@extends('admin.layout')

@section('content')
<div class="container-fluid mt-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Daftar Transaksi</h2>
        <a href="{{ route('transaksi.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus me-1"></i> Tambah Transaksi
        </a>
    </div>

    <!-- Alert sukses -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Alert error -->
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Summary Denda -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h6 class="card-title">Denda Belum Dibayar</h6>
                    <h3 class="card-text">
                        Rp {{ number_format($transaksis->where('denda_dibayar', false)->where('total_denda', '>', 0)->sum('total_denda'), 0, ',', '.') }}
                    </h3>
                    <small class="opacity-75">{{ $transaksis->where('denda_dibayar', false)->where('total_denda', '>', 0)->count() }} transaksi</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h6 class="card-title">Total Denda Telat</h6>
                    <h3 class="card-text">
                        Rp {{ number_format($transaksis->sum('denda_telat'), 0, ',', '.') }}
                    </h3>
                    <small class="opacity-75">{{ $transaksis->where('denda_telat', '>', 0)->count() }} transaksi telat</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h6 class="card-title">Total Denda Hilang</h6>
                    <h3 class="card-text">
                        Rp {{ number_format($transaksis->sum('denda_hilang'), 0, ',', '.') }}
                    </h3>
                    <small class="opacity-75">{{ $transaksis->where('denda_hilang', '>', 0)->count() }} buku hilang</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h6 class="card-title">Denda Sudah Dibayar</h6>
                    <h3 class="card-text">
                        Rp {{ number_format($transaksis->where('denda_dibayar', true)->sum('total_denda'), 0, ',', '.') }}
                    </h3>
                    <small class="opacity-75">{{ $transaksis->where('denda_dibayar', true)->count() }} transaksi</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Status -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <h6 class="mb-3">Filter Status:</h6>
                    <div class="btn-group" role="group">
                        <a href="{{ request()->fullUrlWithQuery(['status' => 'all']) }}" 
                           class="btn btn-outline-primary {{ request('status') == 'all' || !request('status') ? 'active' : '' }}">
                            Semua ({{ $transaksis->count() }})
                        </a>
                        <a href="{{ request()->fullUrlWithQuery(['status' => 'dipinjam']) }}" 
                           class="btn btn-outline-warning {{ request('status') == 'dipinjam' ? 'active' : '' }}">
                            Dipinjam ({{ $transaksis->where('fp', 0)->count() }})
                        </a>
                        <a href="{{ request()->fullUrlWithQuery(['status' => 'selesai']) }}" 
                           class="btn btn-outline-success {{ request('status') == 'selesai' ? 'active' : '' }}">
                            Selesai ({{ $transaksis->where('fp', 1)->count() }})
                        </a>
                        <a href="{{ request()->fullUrlWithQuery(['status' => 'hilang']) }}" 
                           class="btn btn-outline-danger {{ request('status') == 'hilang' ? 'active' : '' }}">
                            Hilang ({{ $transaksis->where('fp', 2)->count() }})
                        </a>
                        <a href="{{ request()->fullUrlWithQuery(['status' => 'denda']) }}" 
                           class="btn btn-outline-dark {{ request('status') == 'denda' ? 'active' : '' }}">
                            Ada Denda ({{ $transaksis->where('total_denda', '>', 0)->where('denda_dibayar', false)->count() }})
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-striped table-hover align-middle" id="transaksiTable">
            <thead class="table-dark">
                <tr>
                    <th class="text-center">ID</th>
                    <th>Buku</th>
                    <th>Anggota</th>
                    <th class="text-center">Tgl Pinjam</th>
                    <th class="text-center">Tgl Kembali</th>
                    <th class="text-center">Tgl Pengembalian</th>
                    <th class="text-center">Hari Terlambat</th>
                    <th class="text-center">Denda Telat</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Total Denda</th>
                    <th class="text-center">Status Bayar</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transaksis as $transaksi)
                    @php
                        // HITUNG DENDA TELAT LANGSUNG DI INDEX
                        $dendaTelat = 0;
                        $hariTerlambat = 0;
                        $totalHari = 0;
                        
                        // Hanya hitung jika status selesai (fp=1) dan ada tanggal pengembalian
                        if ($transaksi->fp == 1 && $transaksi->tgl_pengembalian) {
                            $tglPinjam = \Carbon\Carbon::parse($transaksi->tgl_pinjam);
                            $tglKembali = \Carbon\Carbon::parse($transaksi->tgl_kembali);
                            $tglPengembalian = \Carbon\Carbon::parse($transaksi->tgl_pengembalian);
                            
                            // Hitung total hari sejak pinjam
                            $totalHari = $tglPengembalian->diffInDays($tglPinjam);
                            
                            // Cek apakah melewati batas 3 hari
                            if ($totalHari > 3) {
                                $hariTerlambat = $totalHari - 3;
                            }
                            
                            // Juga cek jika terlambat dari tanggal harus kembali
                            if ($tglPengembalian->greaterThan($tglKembali)) {
                                $telatDariKembali = $tglPengembalian->diffInDays($tglKembali);
                                // Ambil yang lebih besar antara telat dari batas 3 hari atau dari tanggal kembali
                                $hariTerlambat = max($hariTerlambat, $telatDariKembali);
                            }
                            
                            // Hitung denda telat
                            $dendaTelat = $hariTerlambat * 6000;
                            
                            // Jika denda telat di database belum ada atau berbeda, update tampilan
                            if ($transaksi->denda_telat != $dendaTelat && $transaksi->fp == 1) {
                                // Tampilkan yang dihitung sekarang, tapi beri tanda
                                $dendaTelat = $dendaTelat;
                            } else {
                                $dendaTelat = $transaksi->denda_telat;
                            }
                        } else {
                            // Gunakan nilai dari database
                            $dendaTelat = $transaksi->denda_telat;
                        }
                        
                        // Total denda = denda telat + denda hilang
                        $totalDenda = $dendaTelat + $transaksi->denda_hilang;
                    @endphp
                    
                    <tr>
                        <td class="text-center fw-semibold">{{ $transaksi->id_transaksi }}</td>
                        <td>{{ $transaksi->pustaka->judul_pustaka }}</td>
                        <td>{{ $transaksi->anggota->nama_anggota }}</td>
                        <td class="text-center">{{ $transaksi->tgl_pinjam }}</td>
                        <td class="text-center">{{ $transaksi->tgl_kembali }}</td>
                        <td class="text-center">{{ $transaksi->tgl_pengembalian ?? '-' }}</td>
                        <td class="text-center">
                            @if($hariTerlambat > 0)
                                <div class="d-flex flex-column align-items-center">
                                    <span class="badge bg-danger mb-1">{{ $hariTerlambat }} hari</span>
                                    <small class="text-muted">
                                        @if($totalHari > 3)
                                            ({{ $totalHari }}h total)
                                        @endif
                                    </small>
                                </div>
                            @elseif($transaksi->tgl_pengembalian && $transaksi->fp == 1)
                                <span class="badge bg-success">Tepat waktu</span>
                            @else
                                <span class="badge bg-secondary">-</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($dendaTelat > 0)
                                <span class="badge bg-warning">
                                    Rp {{ number_format($dendaTelat, 0, ',', '.') }}
                                </span>
                                <small class="d-block text-muted">
                                    ({{ $hariTerlambat }} × 6.000)
                                </small>
                            @else
                                <span class="badge bg-secondary">-</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($transaksi->fp == 0)
                                <span class="badge bg-warning">
                                    <i class="fas fa-clock me-1"></i> Dipinjam
                                </span>
                            @elseif($transaksi->fp == 1)
                                <span class="badge bg-success">
                                    <i class="fas fa-check me-1"></i> Selesai
                                </span>
                            @elseif($transaksi->fp == 2)
                                <span class="badge bg-danger">
                                    <i class="fas fa-exclamation-triangle me-1"></i> Hilang
                                </span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($totalDenda > 0)
                                <span class="badge {{ $transaksi->denda_dibayar ? 'bg-info' : 'bg-danger' }}">
                                    <i class="fas {{ $transaksi->denda_dibayar ? 'fa-check' : 'fa-exclamation' }} me-1"></i>
                                    Rp {{ number_format($totalDenda, 0, ',', '.') }}
                                </span>
                                <div class="small text-muted">
                                    @if($dendaTelat > 0)
                                        <div>Telat: Rp {{ number_format($dendaTelat, 0, ',', '.') }}</div>
                                    @endif
                                    @if($transaksi->denda_hilang > 0)
                                        <div>Hilang: Rp {{ number_format($transaksi->denda_hilang, 0, ',', '.') }}</div>
                                    @endif
                                </div>
                            @else
                                <span class="badge bg-secondary">
                                    <i class="fas fa-check-circle me-1"></i> Tidak Ada
                                </span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($totalDenda > 0)
                                @if($transaksi->denda_dibayar)
                                    <span class="badge bg-success">
                                        <i class="fas fa-check-circle me-1"></i> Lunas
                                    </span>
                                @else
                                    <span class="badge bg-warning">
                                        <i class="fas fa-clock me-1"></i> Belum Bayar
                                    </span>
                                    <button type="button" class="btn btn-sm btn-outline-success mt-1" 
                                            onclick="bayarDenda('{{ $transaksi->id_transaksi }}', '{{ number_format($totalDenda, 0, ',', '.') }}')">
                                        <i class="fas fa-credit-card"></i> Bayar
                                    </button>
                                @endif
                            @else
                                <span class="badge bg-secondary">-</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <!-- Tombol Detail Denda -->
                            <a href="{{ route('transaksi.showDenda', $transaksi->id_transaksi) }}" 
                               class="btn btn-info btn-sm me-1 mb-1" title="Detail Denda">
                                <i class="fas fa-money-bill-wave"></i>
                            </a>

                            <!-- Tombol Edit -->
                            <a href="{{ route('transaksi.edit', $transaksi->id_transaksi) }}" 
                               class="btn btn-warning btn-sm me-1 mb-1" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>

                            <!-- Tombol Bayar Denda (jika ada denda belum dibayar) -->
                            @if($totalDenda > 0 && !$transaksi->denda_dibayar)
                                <form action="{{ route('transaksi.payDenda', $transaksi->id_transaksi) }}" 
                                      method="POST" class="d-inline mb-1"
                                      onsubmit="return confirm('Konfirmasi pembayaran denda Rp {{ number_format($totalDenda, 0, ',', '.') }}?');">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm me-1" title="Bayar Denda">
                                        <i class="fas fa-credit-card"></i>
                                    </button>
                                </form>
                            @endif

                            <!-- Tombol Hapus -->
                            <form action="{{ route('transaksi.destroy', $transaksi->id_transaksi) }}" 
                                  method="POST" class="d-inline mb-1"
                                  onsubmit="return confirm('Yakin ingin menghapus transaksi ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm me-1 mb-1" title="Hapus">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>

                            <!-- Tombol Kembalikan Buku -->
                            @if($transaksi->fp == 0)
                                <form action="{{ route('transaksi.returnBook', $transaksi->id_transaksi) }}" 
                                      method="POST" class="d-inline mb-1"
                                      onsubmit="return confirm('Yakin ingin mengembalikan buku ini? Denda akan dihitung otomatis jika terlambat.');">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm me-1" title="Kembalikan">
                                        <i class="fas fa-undo"></i>
                                    </button>
                                </form>
                                
                                <!-- Tombol Tandai Hilang -->
                                <form action="{{ route('transaksi.markAsLost', $transaksi->id_transaksi) }}" 
                                      method="POST" class="d-inline mb-1"
                                      onsubmit="return confirm('Yakin ingin menandai buku ini sebagai HILANG? Denda Rp 100.000 akan dikenakan.');">
                                    @csrf
                                    <button type="submit" class="btn btn-dark btn-sm mb-1" title="Tandai Hilang">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </button>
                                </form>
                            @else
                                <!-- Tombol sudah dikembalikan, disable -->
                                <button class="btn btn-secondary btn-sm me-1 mb-1" disabled title="Sudah Dikembalikan">
                                    <i class="fas fa-undo"></i>
                                </button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="12" class="text-center text-muted">Belum ada data transaksi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
        <!-- Pagination -->
        @if($transaksis->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $transaksis->links() }}
            </div>
        @endif
        
        <!-- Info Denda Per Hari -->
        <div class="card mt-4">
            <div class="card-header bg-light">
                <h6 class="mb-0">
                    <i class="fas fa-info-circle me-2"></i>Informasi Denda
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-2"><strong>Batas Peminjaman:</strong> 3 hari</p>
                        <p class="mb-2"><strong>Denda Keterlambatan:</strong> Rp 6.000 per hari setelah 3 hari</p>
                        <p class="mb-0"><small class="text-muted">Dikenakan jika buku tidak dikembalikan dalam 3 hari sejak pinjam</small></p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-2"><strong>Denda Kehilangan:</strong> Rp 100.000 per buku</p>
                        <p class="mb-0"><small class="text-muted">Dikenakan jika buku ditandai hilang</small></p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <p class="mb-1"><strong>Cara Perhitungan Denda:</strong></p>
                        <ol class="mb-0">
                            <li>Jika dikembalikan dalam 3 hari: <strong>Tidak ada denda</strong></li>
                            <li>Jika dikembalikan setelah 3 hari: <strong>(total hari - 3) × Rp 6.000</strong></li>
                            <li>Jika terlambat dari tanggal harus kembali: <strong>hari terlambat × Rp 6.000</strong></li>
                            <li>Dihitung <strong>mana yang lebih besar</strong> antara kedua aturan di atas</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.table thead th { 
    font-weight: 600; 
    letter-spacing: 0.5px; 
    vertical-align: middle;
    white-space: nowrap;
}
.table-hover tbody tr:hover { 
    background: rgba(99, 102, 241, .05); 
    transition: 0.3s; 
}
.btn-sm i { 
    pointer-events: none; 
}
.badge {
    font-size: 0.85em;
}
.btn-group .btn.active {
    background-color: #0d6efd;
    color: white;
    border-color: #0d6efd;
}
.small.text-muted {
    font-size: 0.75rem;
}
#transaksiTable th:nth-child(7),
#transaksiTable th:nth-child(8) {
    background-color: #ffc10720;
}
#transaksiTable td:nth-child(7),
#transaksiTable td:nth-child(8) {
    background-color: #fff9e6;
}
@media (max-width: 768px) {
    .table-responsive { 
        overflow-x: auto; 
    }
    .d-flex.justify-content-between { 
        flex-direction: column; 
        gap: 10px; 
    }
    .card-body h3 {
        font-size: 1.2rem;
    }
    .btn-group {
        flex-wrap: wrap;
    }
    .btn-group .btn {
        margin-bottom: 5px;
    }
    td {
        font-size: 0.9rem;
    }
}
</style>

<script>
// Fungsi untuk membayar denda
function bayarDenda(id, jumlah) {
    if (confirm(`Konfirmasi pembayaran denda Rp ${jumlah}?`)) {
        fetch(`/transaksi/${id}/pay-denda`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Denda berhasil dibayar!');
                location.reload();
            } else {
                alert('Gagal membayar denda: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat membayar denda');
        });
    }
}

// Hitung denda otomatis untuk semua transaksi selesai
function hitungSemuaDenda() {
    if (confirm('Hitung ulang denda untuk semua transaksi selesai?')) {
        fetch('/transaksi/hitung-semua-denda', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(`Berhasil menghitung ulang ${data.count} transaksi`);
                location.reload();
            } else {
                alert('Gagal menghitung ulang denda');
            }
        });
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Filter status dengan JavaScript
    const filterBtns = document.querySelectorAll('.btn-group .btn');
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            if (this.href === '#') {
                e.preventDefault();
            }
        });
    });
    
    // Tambahkan tooltip untuk hari terlambat
    const hariTelatCells = document.querySelectorAll('td:nth-child(7)');
    hariTelatCells.forEach(cell => {
        const badge = cell.querySelector('.badge');
        if (badge && badge.classList.contains('bg-danger')) {
            cell.title = 'Hari keterlambatan dihitung otomatis';
        }
    });
    
    // Tambahkan tombol hitung semua denda di header jika diperlukan
    const header = document.querySelector('.d-flex.justify-content-between');
    if (header && {{ $transaksis->where('fp', 1)->count() }} > 0) {
        const hitungBtn = document.createElement('button');
        hitungBtn.className = 'btn btn-outline-warning shadow-sm me-2';
        hitungBtn.innerHTML = '<i class="fas fa-calculator me-1"></i> Hitung Semua Denda';
        hitungBtn.onclick = hitungSemuaDenda;
        header.querySelector('h2').insertAdjacentElement('afterend', hitungBtn);
    }
});
</script>
@endsection