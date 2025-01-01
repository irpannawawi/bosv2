@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header d-flex  justify-content-between">
        <a href="{{ route('provinsi.index') }}" class="btn btn-danger">Back</a>
    </div>
    <div class="card-body">
        <h1 class="mt-4 mb-4">Form Provinsi</h1>
        <form id="provinsiForm" method="POST" action="{{ route('provinsi.store') }}">
            @csrf
            <div class="mb-3">
                <label for="id" class="form-label">ID</label>
                <input type="number" class="form-control" id="id" name="kd_prov" required autocomplete="off">
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Provinsi</label>
                <input type="text" class="form-control" id="nama" name="nama" required autocomplete="off">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection