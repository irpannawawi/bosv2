@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header d-flex  justify-content-between">
        <a href="{{ route('anggota.index') }}" class="btn btn-danger">Back</a>
    </div>
    <div class="card-body">
        <h1 class="mt-4 mb-4">Edit {{$anggota->nama}}</h1>
        <form id="provinsiForm" method="POST" action="{{ route('anggota.update', $anggota->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nrp" class="form-label">NRP</label>
                <input type="number" value="{{ $anggota->nrp }}" class="form-control" id="nrp" name="nrp" required autocomplete="off">
            </div>
            <div class="mb-3">
                <label for="pangkat" class="form-label">Pangkat</label>
                <input type="text" value="{{ $anggota->pangkat }}" class="form-control" id="pangkat" name="pangkat" required autocomplete="off">
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">nama</label>
                <input type="text" value="{{ $anggota->nama }}" class="form-control" id="nama" name="nama" required autocomplete="off">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">username</label>
                <input type="text"  value="{{ $anggota->username }}" class="form-control" id="username" name="username" required autocomplete="off">
            </div>
            
            <div class="mb-3">
                <label for="password" class="form-label">password</label>
                <input type="text" value="{{ $anggota->password }}" class="form-control" id="password" name="password" required autocomplete="off">
            </div>
            
            <div class="mb-3">
                <label for="kec" class="form-label">Kecamatan</label>
                <select name="kd_kec" id="kec" class="form-control">
                    @foreach ($kecamatans as $kec)
                        <option {{ $kec->kd_kec == $anggota->kd_kec ? 'selected' : '' }} value="{{ $kec->kd_kec }}">{{ $kec->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="desa" class="form-label">desa</label>
                <select name="kd_desa" id="desa" class="form-control">
                    @foreach ($desas as $desa)
                        <option {{ $desa->kd_desa == $anggota->kd_desa ? 'selected' : '' }} value="{{ $desa->kd_desa }}">{{ $desa->nama }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection