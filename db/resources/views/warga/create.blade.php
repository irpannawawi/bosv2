@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header d-flex  justify-content-between">
        <a href="{{ route('warga.index') }}" class="btn btn-danger">Back</a>
    </div>
    <div class="card-body">
        <h1 class="mt-4 mb-4">Form Warga</h1>
        <form id="wargaForm" method="POST" action="{{ route('warga.store') }}">
            @csrf
            <div class="mb-3">
                <label for="nama" class="form-label">Nama warga</label>
                <input type="text" class="form-control" id="nama" name="nama_warga" required autocomplete="off">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection