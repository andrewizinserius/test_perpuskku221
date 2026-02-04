@extends('admin.layout')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Detail Penerbit</h1>
    </div>

    <div class="card p-4">
        <table class="table-auto w-full">
            <tr>
                <th class="text-left px-4 py-2">Kode Penerbit</th>
                <td class="px-4 py-2">{{ $penerbit->kode_penerbit }}</td>
            </tr>
            <tr>
                <th class="text-left px-4 py-2">Nama Penerbit</th>
                <td class="px-4 py-2">{{ $penerbit->nama_penerbit }}</td>
            </tr>
            <tr>
                <th class="text-left px-4 py-2">Alamat Penerbit</th>
                <td class="px-4 py-2">{{ $penerbit->alamat_penerbit }}</td>
            </tr>
            <tr>
                <th class="text-left px-4 py-2">No. Telepon</th>
                <td class="px-4 py-2">{{ $penerbit->no_telp }}</td>
            </tr>
            <tr>
                <th class="text-left px-4 py-2">Email</th>
                <td class="px-4 py-2">{{ $penerbit->email }}</td>
            </tr>
            <tr>
                <th class="text-left px-4 py-2">Fax</th>
                <td class="px-4 py-2">{{ $penerbit->fax }}</td>
            </tr>
            <tr>
                <th class="text-left px-4 py-2">Website</th>
                <td class="px-4 py-2"><a href="{{ $penerbit->website }}" target="_blank"
                        class="text-blue-500 underline">{{ $penerbit->website }}</a></td>
            </tr>
            <tr>
                <th class="text-left px-4 py-2">Kontak Person</th>
                <td class="px-4 py-2">{{ $penerbit->kontak }}</td>
            </tr>
        </table>

        <div class="mt-4">
            <a href="{{ route('penerbit.index') }}" class="btn btn-secondary me-2">Kembali</a>
            <a href="{{ route('penerbit.edit', $penerbit->id_penerbit) }}" class="btn btn-primary">Edit</a>
        </div>
    </div>
</div>
@endsection