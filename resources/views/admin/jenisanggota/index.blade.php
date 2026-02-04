@extends('admin.layout')

@section('content')
<div class="container-fluid mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Daftar Jenis Anggota</h2>
        <a href="{{ route('jenisanggota.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus me-1"></i> Tambah Jenis Anggota
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
                    <th>Kode</th>
                    <th>Jenis Anggota</th>
                    <th>Maksimal Pinjam</th>
                    <th>Keterangan</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jenisAnggota as $item)
                    <tr>
                        <td class="fw-semibold">{{ $item->kode_jenis_anggota }}</td>
                        <td>{{ $item->jenis_anggota }}</td>
                        <td>{{ $item->max_pinjam }}</td>
                        <td>{{ $item->keterangan ?? '-' }}</td>
                        <td class="text-center">
                            <a href="{{ route('jenisanggota.edit', $item->id_jenis_anggota) }}" 
                               class="btn btn-warning btn-sm me-1" title="Edit Jenis Anggota">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('jenisanggota.destroy', $item->id_jenis_anggota) }}" 
                                  method="POST" class="d-inline" 
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus jenis anggota ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus Jenis Anggota">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada data jenis anggota.</td>
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
