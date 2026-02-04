@extends('admin.layout')

@section('content')
<div class="container-fluid mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Daftar Penerbit</h2>
        <a href="{{ route('penerbit.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus me-1"></i> Tambah Penerbit
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Kode Penerbit</th>
                    <th>Nama Penerbit</th>
                    <th>Email</th>
                    <th>No Telp</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($penerbit as $item)
                    <tr>
                        <td class="fw-semibold">{{ $item->kode_penerbit }}</td>
                        <td>{{ $item->nama_penerbit }}</td>
                        <td>{{ $item->email ?? '-' }}</td>
                        <td>{{ $item->no_telp ?? '-' }}</td>
                        <td class="text-center">
                            <a href="{{ route('penerbit.show', $item->id_penerbit) }}" 
                               class="btn btn-info btn-sm me-1" title="Detail Penerbit">
                                <i class="fas fa-info-circle"></i>
                            </a>
                            <a href="{{ route('penerbit.edit', $item->id_penerbit) }}" 
                               class="btn btn-warning btn-sm me-1" title="Edit Penerbit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('penerbit.destroy', $item->id_penerbit) }}" 
                                  method="POST" class="d-inline" 
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus penerbit ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus Penerbit">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada data penerbit.</td>
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
