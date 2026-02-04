@extends('admin.layout')

@section('content')
<div class="container-fluid mt-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Daftar Rak</h2>
        <a href="{{ route('rak.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus me-1"></i> Tambah Rak
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
                    <th>Kode Rak</th>
                    <th>Rak</th>
                    <th>Keterangan</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($raks as $rak)
                    <tr>
                        <td class="fw-semibold">{{ $rak->kode_rak }}</td>
                        <td>{{ $rak->rak }}</td>
                        <td>{{ $rak->keterangan }}</td>
                        <td class="text-center">
                            <a href="{{ route('rak.edit', $rak->id_rak) }}" 
                               class="btn btn-warning btn-sm me-1" title="Edit Rak">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('rak.destroy', $rak->id_rak) }}" method="POST" 
                                  class="d-inline" 
                                  onsubmit="return confirm('Yakin ingin menghapus rak ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus Rak">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">Belum ada data rak.</td>
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
