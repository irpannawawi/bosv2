@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header d-flex  justify-content-between">
        <a href="{{ route('warga.index') }}" class="btn btn-danger">Back</a>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h1 class="mt-4 mb-4">Edit {{$warga->nama_warga}}</h1>
        <form id="wargaForm" method="POST" action="{{ route('warga.update', $warga->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nama" class="form-label">Nama warga</label>
                <input type="text" class="form-control" id="nama" value="{{ $warga->nama_warga }}" name="nama_warga" required autocomplete="off">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection