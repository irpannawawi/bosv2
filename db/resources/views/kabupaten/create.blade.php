@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header d-flex  justify-content-between">
        <a href="{{ route('kabupaten.index') }}" class="btn btn-danger">Back</a>
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
        <h1 class="mt-4 mb-4">Form Kabupaten</h1>
        <form id="provinsiForm" method="POST" action="{{ route('kabupaten.store') }}">
            @csrf
            <div class="mb-3">
                <label for="kd_prv" class="form-label">Provinsi</label>
                <select name="kd_prov" id="kd_prv" class="form-control">
                    @foreach ($provinsis as $provinsi)
                        <option value="{{ $provinsi->kd_prov }}">{{ $provinsi->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="id" class="form-label">ID</label>
                <input type="number" class="form-control" id="id" name="kd_kab" required autocomplete="off">
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Kabupaten</label>
                <input type="text" class="form-control" id="nama" name="nama" required autocomplete="off">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection