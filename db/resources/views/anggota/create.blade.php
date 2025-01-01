@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header d-flex  justify-content-between">
        <a href="{{ route('anggota.index') }}" class="btn btn-danger">Back</a>
    </div>
    <div class="card-body">
        <h1 class="mt-4 mb-4">Form Anggota</h1>
        <form id="anggotaForm" method="POST" action="{{ route('anggota.store') }}">
            @csrf
            <div class="mb-3">
                <label for="nrp" class="form-label">NRP</label>
                <input type="number" class="form-control" id="nrp" name="nrp" required autocomplete="off">
            </div>
            <div class="mb-3">
                <label for="pangkat" class="form-label">Pangkat</label>
                <input type="text" class="form-control" id="pangkat" name="pangkat" required autocomplete="off">
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required autocomplete="off">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">username</label>
                <input type="text" class="form-control" id="username" name="username" required autocomplete="off">
            </div>
            
            <div class="mb-3">
                <label for="password" class="form-label">password</label>
                <input type="text" class="form-control" id="password" name="password" required autocomplete="off">
            </div>
            
            <div class="mb-3">
                <label for="desa" class="form-label">desa</label>
                <select name="kd_desa" id="desa" class="form-control">
                    @foreach ($desas as $desa)
                        <option value="{{ $desa->kd_desa }}">{{ $desa->nama }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection