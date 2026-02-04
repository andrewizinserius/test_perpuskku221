@extends('admin.layout')

@section('content')
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Daftar Format</h2>
        <a href="{{ route('formats.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus me-1"></i> Tambah Format
        </a>
    </div>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Kode Format</th>
                    <th>Format</th>
                    <th>Keterangan</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($formats as $format)
                <tr>
                    <td class="fw-semibold">{{ $format->kode_format }}</td>
                    <td>{{ $format->format }}</td>
                    <td>{{ $format->keterangan ?? '-' }}</td>
                    <td class="text-center">
                        <a href="{{ route('formats.edit', $format->id_format) }}" class="btn btn-warning btn-sm me-1" title="Edit Format">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('formats.destroy', $format->id_format) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus format ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus Format">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">Belum ada data format.</td>
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
