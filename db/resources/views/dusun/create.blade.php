@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header d-flex  justify-content-between">
        <a href="{{ route('dusun.index') }}" class="btn btn-danger">Back</a>
    </div>
    <div class="card-body">
        @if ($errors->any())
        <div class="alert alert-danger">
            <div class="card">
                <div class="card-header">
                    Error
                </div>
                <div class="card-body">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif
        <h1 class="mt-4 mb-4">Form Dusun</h1>
        <form id="provinsiForm" method="POST" action="{{ route('dusun.store') }}">
            @csrf
            
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
                        <option value="{{ $kecamatan->kd_kec }}">{{ $kecamatan->nama }}</option>
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
                <label for="nama" class="form-label">Nama Dusun</label>
                <input type="text" class="form-control" id="nama" name="nama" autofocus required autocomplete="off">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection