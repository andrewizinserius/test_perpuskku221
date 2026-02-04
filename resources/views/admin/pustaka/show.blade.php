@extends('admin.layout')

@section('content')
<div class="container">
    <h1>Detail Pustaka</h1>
    <table class="table table-bordered">
        <tr>
            <th>Kode Pustaka</th>
            <td>{{ $pustaka->kode_pustaka }}</td>
        </tr>
        <tr>
            <th>Judul Pustaka</th>
            <td>{{ $pustaka->judul_pustaka }}</td>
        </tr>
        <tr>
            <th>Tahun Terbit</th>
            <td>{{ $pustaka->tahun_terbit }}</td>
        </tr>
        <tr>
            <th>ISBN</th>
            <td>{{ $pustaka->isbn }}</td>
        </tr>
        <tr>
            <th>Keyword</th>
            <td>{{ $pustaka->keyword }}</td>
        </tr>
        <tr>
            <th>Keterangan Fisik</th>
            <td>{{ $pustaka->keterangan_fisik }}</td>
        </tr>
        <tr>
            <th>Abstraksi</th>
            <td>{{ $pustaka->abstraksi }}</td>
        </tr>
        <tr>
            <th>Gambar</th>
            <td>
                @if($pustaka->gambar)
                    <img src="{{ asset('storage/' . $pustaka->gambar) }}" alt="Gambar Pustaka" class="mt-2 w-18 h-10"
                        width="200">
                @endif
            </td>
        </tr>
        <tr>
            <th>Harga Buku</th>
            <td>{{ $pustaka->harga_buku }}</td>
        </tr>
        <tr>
            <th>Denda Terlambat</th>
            <td>{{ $pustaka->denda_terlambat }}</td>
        </tr>
        <tr>
            <th>Denda Hilang</th>
            <td>{{ $pustaka->denda_hilang }}</td>
        </tr>
        <tr>
            <th>Jumlah Buku</th>
            <td>{{ $pustaka->jml_pinjam }}</td>
        </tr>
        <tr>
            <th>Kondisi Buku</th>
            <td>{{ $pustaka->kondisi_buku }}</td>
        </tr>
        <tr>
            <th>DDC</th>
            <td>{{ $pustaka->ddc->ddc }}</td>
        </tr>
        <tr>
            <th>Format</th>
            <td>{{ $pustaka->format->format }}</td>
        </tr>
        <tr>
            <th>Penerbit</th>
            <td>{{ $pustaka->penerbit->nama_penerbit }}</td>
        </tr>
        <tr>
            <th>Pengarang</th>
            <td>{{ $pustaka->pengarang->nama_pengarang }}</td>
        </tr>
    </table>
    <div class="mt-3">
        <a href="{{ route('pustaka.index') }}" class="btn btn-secondary me-2">Kembali</a>
    </div>
</div>
@endsection