@extends('admin.layout')

@section('content')
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Daftar Anggota</h2>
        <a href="{{ route('anggota.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus me-1"></i> Tambah Anggota
        </a>
    </div>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Kode Anggota</th>
                    <th>Nama Anggota</th>
                    <th>Jenis Anggota</th>
                    <th>Status Akun</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($anggota as $item)
                <tr>
                    <td class="fw-semibold">{{ $item->kode_anggota }}</td>
                    <td>{{ $item->nama_anggota }}</td>
                    <td>{{ $item->jenisAnggota->jenis_anggota }}</td>
                    <td>
                        @if($item->fa == 'Y')
                            <span class="badge text-white" style="background: linear-gradient(135deg,#22c55e,#166534)">Aktif</span>
                        @else
                            <span class="badge text-white" style="background: linear-gradient(135deg,#ef4444,#b91c1c)">Non-Aktif</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('anggota.show', $item->id_anggota) }}" class="btn btn-info btn-sm me-1" title="Lihat Detail">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('anggota.edit', $item->id_anggota) }}" class="btn btn-warning btn-sm me-1" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('anggota.destroy', $item->id_anggota) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus anggota ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Belum ada anggota.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
    /* Tabel responsif & modern */
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
