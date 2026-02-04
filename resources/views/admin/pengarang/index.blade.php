@extends('admin.layout')

@section('content')
<div class="container-fluid mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Daftar Pengarang</h2>
        <a href="{{ route('pengarang.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus me-1"></i> Tambah Pengarang
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
                    <th>Kode Pengarang</th>
                    <th>Nama Pengarang</th>
                    <th>kelamin</th>
                    <th>Email</th>
                    <th>No Telp</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengarangs as $pengarang)
                    <tr>
                        <td class="fw-semibold">{{ $pengarang->kode_pengarang }}</td>
                        <td>{{ $pengarang->nama_pengarang }}</td>
                        <td>
    {{ $pengarang->kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
</td>

                        <td>{{ $pengarang->email ?? '-' }}</td>
                        <td>{{ $pengarang->no_telp ?? '-' }}</td>
                        <td class="text-center">
                            <a href="{{ route('pengarang.show', $pengarang->id_pengarang) }}" 
                               class="btn btn-info btn-sm me-1" title="Detail Pengarang">
                                <i class="fas fa-info-circle"></i>
                            </a>
                            <a href="{{ route('pengarang.edit', $pengarang->id_pengarang) }}" 
                               class="btn btn-warning btn-sm me-1" title="Edit Pengarang">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('pengarang.destroy', $pengarang->id_pengarang) }}" 
                                  method="POST" class="d-inline" 
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengarang ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus Pengarang">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada data pengarang.</td>
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
