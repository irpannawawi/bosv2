@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header d-flex  justify-content-between">
            <h3 class="pull-left">Provinsi</h3>
            <a href="{{ route('provinsi.create') }}" class="btn btn-primary">Add</a>
        </div>
        <div class="card-body">
            <table id="data-table" class="table table-bordered table-sm table-striped ">
                <thead class="bg-dark text-light text-center">
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Provinsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($provinsis as $provinsi)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $provinsi->kd_prov }}</td>
                            <td>{{ $provinsi->nama }}</td>
                            <td class="text-end">
                                <a href="{{ route('provinsi.edit', $provinsi->id) }}" class="btn btn-primary">Edit</a>

                                <!-- Button untuk menghapus -->
                                <form id="deleteProvinsiForm" method="POST"
                                    action="{{ route('provinsi.destroy', $provinsi->id) }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
