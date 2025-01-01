@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header d-flex  justify-content-between">
            <h3 class="pull-left">Dusun</h3>
            <a href="{{ route('dusun.create') }}" class="btn btn-primary">Add</a>
        </div>
        <div class="card-body">
            <table id="data-table" class="table table-bordered table-sm table-striped ">
                <thead class="bg-dark text-light text-center">
                    <tr>
                        <th>No</th>
                        <th>Kode Prov</th>
                        <th>Kode Kab</th>
                        <th>Kode Kec</th>
                        <th>Kode Desa</th>
                        <th>Dusun</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dusuns as $dusun)
                        
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $dusun->kd_prov }}</td>
                            <td class="text-center">{{ $dusun->kd_kab }}</td>
                            <td class="text-center">{{ $dusun->kd_kec }}</td>
                            <td class="text-center">{{ $dusun->kd_desa }}</td>
                            <td>{{ $dusun->nama }}</td>
                            <td class="text-end">
                                <a href="{{ route('dusun.edit', $dusun->id) }}" class="btn btn-primary">Edit</a>

                                <!-- Button untuk menghapus -->
                                <form id="deletedusunForm" method="POST" action="{{ route('dusun.destroy', $dusun->id) }}"
                                    style="display: inline;">
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
