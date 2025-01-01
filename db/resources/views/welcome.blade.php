@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header d-flex  justify-content-between">
        <h3 class="pull-left">Anggota</h3>
        <a class="btn btn-primary">Add</a>
    </div>
    <div class="card-body">
        <table id="data-table" class="table table-sm table-striped ">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NRP</th>
                    <th>Nama</th>
                    <th>Kecamatan</th>
                    <th>Desa</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($anggotas as $anggota)
                <tr>
                    <td>{{ $anggota->id }}</td>
                    <td>{{ $anggota->nrp }}</td>
                    <td>{{ $anggota->name }}</td>
                    <td>{{ $anggota->kecamatan }}</td>
                    <td>{{ $anggota->desa }}</td>
                    <td>
                        <a class="btn btn-primary">Edit</a>
                        <a class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection