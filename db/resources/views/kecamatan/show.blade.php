@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header d-flex  justify-content-between">
            <h3 class="pull-left">Kecamatan {{ $kecamatan->nama }}</h3>
            <a href="{{ route('desa.create') }}" class="btn btn-primary">Add</a>
        </div>
        <div class="card-body">
            <table id="data-table" class="table table-bordered table-sm table-striped ">
                <thead class="bg-dark text-light text-center">
                    <tr>
                        <th>No</th>
                        <th>Kode Prov</th>
                        <th>Kode Kab</th>
                        <th>Kode Kec</th>
                        <th>Desa</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($desas as $desa)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $desa->kd_prov }}</td>
                            <td class="text-center">{{ $desa->kd_kab }}</td>
                            <td class="text-center">{{ $desa->kd_kec }}</td>
                            <td><a href="{{ route('desa.show', $desa->id) }}">{{ $desa->nama }}</a></td>
                            <td class="text-end">
                                <a href="{{ route('kecamatan.edit', $desa->id) }}" class="btn btn-primary">Edit</a>

                                <!-- Button untuk menghapus -->
                                <form id="deletedesaForm" method="POST"
                                    action="{{ route('kecamatan.destroy', $desa->id) }}" style="display: inline;">
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
        <div class="card-footer">
            <x-prev-url />
        </div>
    </div>
@endsection
