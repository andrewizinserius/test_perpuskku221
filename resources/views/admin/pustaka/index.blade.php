@extends('admin.layout')

@section('content')
<div class="container-fluid mt-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Daftar Pustaka</h2>
        <a href="{{ route('pustaka.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus me-1"></i> Tambah Pustaka
        </a>
    </div>

    <!-- Alert sukses -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Table -->
    <div class="table-responsive shadow-sm rounded">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Kode Pustaka</th>
                    <th>Judul</th>
                    <th>Tahun Terbit</th>
                    <th>Jumlah Buku</th> <!-- kolom baru -->
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pustakas as $pustaka)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="fw-semibold">{{ $pustaka->kode_pustaka }}</td>
                        <td>{{ $pustaka->judul_pustaka }}</td>
                        <td>{{ $pustaka->tahun_terbit }}</td>
                        <td>{{ $pustaka->jml_book }}</td> <!-- isi jumlah buku -->
                        <td class="text-center">
                            <a href="{{ route('pustaka.show', $pustaka->id_pustaka) }}" 
                               class="btn btn-info btn-sm me-1" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('pustaka.edit', $pustaka->id_pustaka) }}" 
                               class="btn btn-warning btn-sm me-1" title="Edit Pustaka">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('pustaka.destroy', $pustaka->id_pustaka) }}" method="POST" 
                                  class="d-inline" 
                                  onsubmit="return confirm('Yakin ingin menghapus pustaka ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus Pustaka">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada data pustaka.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

<style>
    /* Table modern */
    .table thead th {
        letter-spacing: 0.5px;
        font-weight: 600;
    }

    .table tbody td {
        vertical-align: middle;
    }

    .table-hover tbody tr:hover {
        background: rgba(99,102,241,.1);
        transition: 0.3s;
    }

    .btn-sm i {
        pointer-events: none;
    }

    @media (max-width: 768px) {
        .table-responsive {
            overflow-x: auto;
        }

        .d-flex.justify-content-between {
            flex-direction: column;
            gap: 10px;
        }
    }
</style>
@endsection
