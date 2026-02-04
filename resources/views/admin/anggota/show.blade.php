@extends('admin.layout')

@section('content')
<div class="container">
    <h1>Detail Anggota</h1>
    <table class="table">
        <tr>
            <th>Kode Anggota</th>
            <td>{{ $anggota->kode_anggota }}</td>
        </tr>
        <tr>
            <th>Nama Anggota</th>
            <td>{{ $anggota->nama_anggota }}</td>
        </tr>
        <tr>
            <th>Jenis Anggota</th>
            <td>{{ $anggota->jenisAnggota->jenis_anggota }}</td>
        </tr>
        <tr>
            <th>Username</th>
            <td>{{ $anggota->username }}</td>
        </tr>
        <tr>
            <th>Password</th>
            <td>{{ $anggota->password }}</td>
        </tr>
        <tr>
            <th>Tempat Lahir</th>
            <td>{{ $anggota->tempat }}</td>
        </tr>
        <tr>
            <th>Tanggal Lahir</th>
            <td>{{ $anggota->tgl_lahir->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td>{{ $anggota->alamat }}</td>
        </tr>
        <tr>
            <th>No Telepon</th>
            <td>{{ $anggota->no_telp }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $anggota->email }}</td>
        </tr>
        <tr>
            <th>Tanggal Daftar</th>
            <td>{{ $anggota->tgl_daftar->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <th>Masa Aktif</th>
            <td>{{ $anggota->masa_aktif->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <th>Status Akun</th>
            <td>
                @if($anggota->fa == 'Y')
                    <span class="badge bg-success">Aktif</span>
                @else
                    <span class="badge bg-danger">Non-Aktif</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>Keterangan</th>
            <td>{{ $anggota->keterangan }}</td>
        </tr>
        <tr>
            <th>Foto</th>
            <td><img src="{{ asset('storage/' . $anggota->foto) }}" alt="Foto Anggota" class="img-thumbnail"
                    style="width: 150px;"></td>
        </tr>
    </table>
    <a href="{{ route('anggota.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection