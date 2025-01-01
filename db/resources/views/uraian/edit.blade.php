@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header d-flex  justify-content-between">
        <a href="{{ route('provinsi.index') }}" class="btn btn-danger">Back</a>
    </div>
    <div class="card-body">
        <h1 class="mt-4 mb-4">Edit {{$provinsi->nama}}</h1>
        <form id="provinsiForm" method="POST" action="{{ route('provinsi.update', $provinsi->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="id" class="form-label">ID</label>
                <input type="number" class="form-control" id="id" value="{{ $provinsi->kd_prov }}" name="kd_prov" required autocomplete="off">
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Provinsi</label>
                <input type="text" class="form-control" id="nama" value="{{ $provinsi->nama }}" name="nama" required autocomplete="off">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection