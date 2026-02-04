@extends('admin.layout')

@section('content')
<div class="container">
    <h1>Detail Data DDC</h1>
    <div class="form-group">
        <label for="rak">Rak</label>
        <p>{{ $ddc->rak->rak }}</p>
    </div>
    <div class="form-group">
        <label for="kode_ddc">Kode DDC</label>
        <p>{{ $ddc->kode_ddc }}</p>
    </div>
    <div class="form-group">
        <label for="ddc">DDC</label>
        <p>{{ $ddc->ddc }}</p>
    </div>
    <div class="form-group">
        <label for="keterangan">Keterangan</label>
        <p>{{ $ddc->keterangan }}</p>
    </div>
</div>
@endsection