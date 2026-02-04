@extends('admin.layout')

@section('content')
<form action="{{ route('transaksi.store') }}" method="POST">
    @csrf

    <div class="mt-4 mb-4">
        <label for="id_pustaka" class="block text-gray-700">Buku</label>
        <select name="id_pustaka" id="id_pustaka" required class="w-full p-2 border rounded form-control">
            <option value="">-- Pilih Buku --</option>
            @foreach ($pustakas as $pustaka)
                <option value="{{ $pustaka->id_pustaka }}">
                    {{ $pustaka->judul_pustaka }}
                </option>
            @endforeach
        </select>
        @error('id_pustaka')
            <span class="text-red-500">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-4">
        <label for="id_anggota" class="block text-gray-700">Anggota</label>
        <select name="id_anggota" id="id_anggota" required class="w-full p-2 border rounded form-control">
            <option value="">-- Pilih Anggota --</option>
            @foreach ($anggotas as $anggota)
                <option value="{{ $anggota->id_anggota }}">
                    {{ $anggota->nama_anggota }}
                </option>
            @endforeach
        </select>
        @error('id_anggota')
            <span class="text-red-500">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-4">
        <label for="tgl_pinjam" class="block text-gray-700">Tanggal Pinjam</label>
        <input type="date" name="tgl_pinjam" id="tgl_pinjam" required
            class="w-full p-2 border rounded form-control">
        @error('tgl_pinjam')
            <span class="text-red-500">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-4">
        <label for="tgl_kembali" class="block text-gray-700">Tanggal Kembali</label>
        <input type="date" name="tgl_kembali" id="tgl_kembali" required
            class="w-full p-2 border rounded form-control" readonly>
        @error('tgl_kembali')
            <span class="text-red-500">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-4">
        <label for="keterangan" class="block text-gray-700">Keterangan</label>
        <input type="text" name="keterangan" id="keterangan" class="w-full p-2 border rounded form-control">
        @error('keterangan')
            <span class="text-red-500">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-4">
        <label for="fp" class="block text-gray-700">Status Peminjaman</label>
        <select name="fp" id="fp" required class="w-full p-2 border rounded form-control">
            <option value="0">Belum Selesai</option>
            <option value="1">Selesai</option>
        </select>
        @error('fp')
            <span class="text-red-500">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-4">
        <a href="{{ route('transaksi.index') }}" class="btn btn-secondary me-2">Kembali</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>

<script>
    function formatDate(date) {
        return date.toISOString().split('T')[0];
    }

    function setTanggal(pinjamDate = null) {
        let tglPinjam;

        if (pinjamDate) {
            tglPinjam = new Date(pinjamDate);
        } else {
            tglPinjam = new Date(); // hari ini
        }

        const tglKembali = new Date(tglPinjam);
        tglKembali.setDate(tglPinjam.getDate() + 3); // +3 hari

        document.getElementById('tgl_pinjam').value = formatDate(tglPinjam);
        document.getElementById('tgl_kembali').value = formatDate(tglKembali);
    }

    // Saat halaman dibuka
    document.addEventListener('DOMContentLoaded', function () {
        setTanggal();
    });

    // Kalau user ganti tanggal pinjam
    document.getElementById('tgl_pinjam').addEventListener('change', function () {
        setTanggal(this.value);
    });
</script>
@endsection
