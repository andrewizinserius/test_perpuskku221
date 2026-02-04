@extends('admin.layout')

@section('content')
<div class="container">
    <h1>Edit Rak</h1>
    <form action="{{ route('rak.update', $rak->id_rak) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="rak" class="form-label">Rak</label>
            <input type="text" name="rak" class="form-control" id="rak" value="{{ $rak->rak }}" required>
        </div>
        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea name="keterangan" class="form-control" id="keterangan" required>{{ $rak->keterangan }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('rak.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection