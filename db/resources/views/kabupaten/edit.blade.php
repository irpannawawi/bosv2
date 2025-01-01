@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header d-flex  justify-content-between">
        <a href="{{ route('kabupaten.index') }}" class="btn btn-danger">Back</a>
    </div>
    <div class="card-body">
        <h1 class="mt-4 mb-4">Edit {{$kabupaten->nama}}</h1>
        <form id="kabupatenForm" method="POST" action="{{ route('kabupaten.update', $kabupaten->id) }}">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="kd_prv" class="form-label">Provinsi</label>
                <select name="kd_prov" id="kd_prv" class="form-control">
                    @foreach ($provinsis as $provinsi)
                        <option {{ $provinsi->kd_prov == $kabupaten->kd_prov ? 'selected' : '' }} value="{{ $provinsi->kd_prov }}">{{ $provinsi->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="id" class="form-label">ID</label>
                <input type="number" class="form-control" id="id" value="{{ $kabupaten->kd_kab }}" name="kd_kab" required autocomplete="off">
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama kabupaten</label>
                <input type="text" class="form-control" id="nama" value="{{ $kabupaten->nama }}" name="nama" required autocomplete="off">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection