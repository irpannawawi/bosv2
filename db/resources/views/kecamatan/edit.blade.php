@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header d-flex  justify-content-between">
        <a href="{{ route('kecamatan.index') }}" class="btn btn-danger">Back</a>
    </div>
    <div class="card-body">
        <h1 class="mt-4 mb-4">Edit {{$kecamatan->nama}}</h1>
        <form id="kecamatanForm" method="POST" action="{{ route('kecamatan.update', $kecamatan->id) }}">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="kd_prov" class="form-label">Provinsi</label>
                <select name="kd_prov" id="kd_prov" class="form-control">
                    @foreach ($provinsis as $provinsi)
                        <option {{ $provinsi->kd_prov == $kecamatan->kd_prov ? 'selected' : '' }} value="{{ $provinsi->kd_prov }}">{{ $provinsi->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="kd_kab" class="form-label">Kabupaten</label>
                <select name="kd_kab" id="kd_kab" class="form-control">
                    @foreach ($kabupatens as $kabupaten)
                        <option {{ $kabupaten->kd_kab == $kecamatan->kd_kab ? 'selected' : '' }} value="{{ $kabupaten->kd_kab }}">{{ $kabupaten->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="id" class="form-label">ID</label>
                <input type="number" class="form-control" id="id" value="{{ $kecamatan->kd_kec }}" name="kd_kec" required autocomplete="off">
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama kecamatan</label>
                <input type="text" class="form-control" id="nama" value="{{ $kecamatan->nama }}" name="nama" required autocomplete="off">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection