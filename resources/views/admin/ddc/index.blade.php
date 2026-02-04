@extends('admin.layout')

@section('content')
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Data DDC</h2>
        <a href="{{ route('ddc.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus me-1"></i> Tambah DDC
        </a>
    </div>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Kode DDC</th>
                    <th>DDC</th>
                    <th>Rak</th>
                    <th>Keterangan</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ddcs as $ddc)
                <tr>
                    <td class="fw-semibold">{{ $ddc->kode_ddc }}</td>
                    <td>{{ $ddc->ddc }}</td>
                    <td>
                        <span class="badge text-white" style="background: linear-gradient(135deg,#6366f1,#8b5cf6)">
                            {{ $ddc->rak->rak }}
                        </span>
                    </td>
                    <td>{{ $ddc->keterangan ?? '-' }}</td>
                    <td class="text-center">
                        <a href="{{ route('ddc.edit', $ddc->id_ddc) }}" class="btn btn-warning btn-sm me-1" title="Edit DDC">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('ddc.destroy', $ddc->id_ddc) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus DDC">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Belum ada data DDC.</td>
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

    .badge {
        padding: 0.45em 0.8em;
        font-size: 0.85rem;
        border-radius: 12px;
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
