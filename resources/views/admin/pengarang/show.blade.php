@extends('admin.layout')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Detail Pengarang</h1>
    </div>

    <div class="card p-4">
        <table class="table-auto w-full">
            <tr>
                <th class="text-left px-4 py-2">Kode Pengarang</th>
                <td class="px-4 py-2">{{ $pengarang->kode_pengarang }}</td>
            </tr>
            <tr>
                <th class="text-left px-4 py-2">Gelar Depan</th>
                <td class="px-4 py-2">{{ $pengarang->gelar_depan ?? '-' }}</td>
            </tr>
            <tr>
                <th class="text-left px-4 py-2">Nama Pengarang</th>
                <td class="px-4 py-2">{{ $pengarang->nama_pengarang }}</td>
            </tr>
            <tr>
                <th class="text-left px-4 py-2">Jenis Kelamin</th>
                <td class="px-4 py-2">{{ $pengarang->kelamin }}</td>
            </tr>
            <tr>
                <th class="text-left px-4 py-2">Gelar Belakang</th>
                <td class="px-4 py-2">{{ $pengarang->gelar_belakang ?? '-' }}</td>
            </tr>
            <tr>
                <th class="text-left px-4 py-2">No Telepon</th>
                <td class="px-4 py-2">{{ $pengarang->no_telp }}</td>
            </tr>
            <tr>
                <th class="text-left px-4 py-2">Email</th>
                <td class="px-4 py-2">{{ $pengarang->email }}</td>
            </tr>
            <tr>
                <th class="text-left px-4 py-2">Website</th>
                <td class="px-4 py-2">{{ $pengarang->website ?? '-' }}</td>
            </tr>
            <tr>
                <th class="text-left px-4 py-2">Biografi</th>
                <td class="px-4 py-2">{{ $pengarang->biografi }}</td>
            </tr>
            <tr>
                <th class="text-left px-4 py-2">Keterangan</th>
                <td class="px-4 py-2">{{ $pengarang->keterangan }}</td>
            </tr>
        </table>

        <div class="mt-4">
            <a href="{{ route('pengarang.index') }}" class="btn btn-secondary me-2">Kembali</a>
            <a href="{{ route('pengarang.edit', $pengarang->id_pengarang) }}" class="btn btn-primary">Edit</a>
        </div>
    </div>
</div>
@endsection