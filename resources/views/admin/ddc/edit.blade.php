@extends('admin.layout')

@section('content')
<div class="container">
    <h1>Edit Data DDC</h1>
    <form action="{{ route('ddc.update', $ddc->id_ddc) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="id_rak">Rak</label>
            <select name="id_rak" class="form-control" required>
                @foreach($raks as $rak)
                    <option value="{{ $rak->id_rak }}" {{ $rak->id_rak == $ddc->id_rak ? 'selected' : '' }}>{{ $rak->rak }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="kode_ddc">Kode DDC</label>
            <input type="text" name="kode_ddc" class="form-control" value="{{ $ddc->kode_ddc }}" required
                maxlength="10">
        </div>
        <div class="form-group">
            <label for="ddc">DDC</label>
            <input type="text" name="ddc" class="form-control" value="{{ $ddc->ddc }}" required maxlength="100">
        </div>
        <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <input type="text" name="keterangan" class="form-control" value="{{ $ddc->keterangan }}" maxlength="100">
        </div>
        <a href="{{ route('ddc.index') }}" class="btn btn-secondary me-2 mt-3">Kembali</a>
        <button type="submit" class="btn btn-primary mt-3">Perbarui</button>
    </form>
</div>
@endsection