@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header d-flex  justify-content-between">
            <h3 class="pull-left">Warga</h3>
            <a href="{{ route('warga.create') }}" class="btn btn-primary">Add</a>
        </div>
        <div class="card-body">
            <table id="data-table" class="table table-bordered table-sm table-striped ">
                <thead class="bg-dark text-light text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($wargas as $warga)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $warga->nama_warga }}</td>
                            <td class="text-end">
                                <a href="{{ route('warga.edit', $warga->id) }}" class="btn btn-primary">Edit</a>

                                <!-- Button untuk menghapus -->
                                <form id="deletewargaForm" method="POST"
                                    action="{{ route('warga.destroy', $warga->id) }}" style="display: inline;">
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
