@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header d-flex  justify-content-between">
            <h3 class="pull-left">Kabupaten</h3>
            <a href="{{ route('kabupaten.create') }}" class="btn btn-primary">Add</a>
        </div>
        <div class="card-body">
            <table id="data-table" class="table table-bordered table-sm table-striped ">
                <thead class="bg-dark text-light text-center">
                    <tr>
                        <th>No</th>
                        <th>Kode Prov</th>
                        <th>Kode Kab</th>
                        <th>Kabupaten</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kabupatens as $kabupaten)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $kabupaten->kd_prov }}</td>
                            <td class="text-center">{{ $kabupaten->kd_kab }}</td>
                            <td>{{ $kabupaten->nama }}</td>
                            <td class="text-end">
                                <a href="{{ route('kabupaten.edit', $kabupaten->id) }}" class="btn btn-primary">Edit</a>

                                <!-- Button untuk menghapus -->
                                <form id="deletekabupatenForm" method="POST"
                                    action="{{ route('kabupaten.destroy', $kabupaten->id) }}" style="display: inline;">
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
