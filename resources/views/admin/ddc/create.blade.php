@extends('admin.layout')

@section('content')
<div class="container">
    <h1>Tambah Data DDC</h1>
    <form action="{{ route('ddc.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="id_rak">Rak</label>
            <select name="id_rak" class="form-control" required>
                <option value="">Pilih Rak</option>
                @foreach($raks as $rak)
                    <option value="{{ $rak->id_rak }}">{{ $rak->rak }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="kode_ddc">Kode DDC</label>
            <input type="text" name="kode_ddc" class="form-control" required maxlength="10">
        </div>
        <div class="form-group">
            <label for="ddc">DDC</label>
            <input type="text" name="ddc" class="form-control" required maxlength="100">
        </div>
        <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <input type="text" name="keterangan" class="form-control" maxlength="100">
        </div>
        
        <div class="d-flex justify-content-start mt-3">
            <a href="{{ route('ddc.index') }}" class="btn btn-secondary me-2">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>
@endsection