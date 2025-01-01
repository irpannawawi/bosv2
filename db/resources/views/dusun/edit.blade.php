@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header d-flex  justify-content-between">
        <a href="{{ route('desa.index') }}" class="btn btn-danger">Back</a>
    </div>
    <div class="card-body">
        <h1 class="mt-4 mb-4">Edit {{$dusun->nama}}</h1>
        <form id="desaForm" method="POST" action="{{ route('desa.update', $dusun->id) }}">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="kd_prov" class="form-label">Provinsi</label>
                <select name="kd_prov" id="kd_prov" class="form-control">
                    @foreach ($provinsis as $provinsi)
                        <option value="{{ $provinsi->kd_prov }}">{{ $provinsi->nama }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-3">
                <label for="kd_kab" class="form-label">Kabupaten</label>
                <select name="kd_kab" id="kd_kab" class="form-control">
                    @foreach ($kabupatens as $kabupaten)
                        <option value="{{ $kabupaten->kd_kab }}">{{ $kabupaten->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="kd_kec" class="form-label">Kecamatan</label>
                <select name="kd_kec" id="kd_kec" class="form-control">
                    @foreach ($kecamatans as $kecamatan)
                        <option {{ $kecamatan->kd_kec == $dusun->kd_kec ? 'selected' : '' }} value="{{ $kecamatan->kd_kec }}">{{ $kecamatan->nama }}</option>
                    @endforeach
                </select>
            </div>

            
            <div class="mb-3">
                <label for="kd_desa" class="form-label">Desa</label>
                <select name="kd_desa" id="kd_desa" class="form-control">
                    @foreach ($desas as $desa)
                        <option {{ $desa->kd_desa == $desa->kd_desa ? 'selected' : '' }} value="{{ $desa->kd_desa }}">{{ $desa->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama desa</label>
                <input type="text" class="form-control" id="nama" value="{{ $dusun->nama }}" name="nama" required autocomplete="off">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection