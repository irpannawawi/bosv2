@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header d-flex  justify-content-between">
            <h3 class="pull-left">Uraian</h3>
            {{-- <a href="{{ route('uraian.create') }}" class="btn btn-primary">Add</a> --}}
        </div>
        <div class="card-body">
            <table id="data-table" class="table table-bordered table-sm table-striped ">
                <thead class="bg-dark text-light text-center">
                    <tr>
                        <th>No</th>
                        <th>Keterangan</th>
                        <th>Tags</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($uraians as $uraian)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $uraian->keterangan }}</td>
                            <td>{{ $uraian->tags }}</td>
                            <td class="text-end">
                                <a href="{{ route('uraian.edit', $uraian->id) }}" class="btn btn-primary">Edit</a>

                                <!-- Button untuk menghapus -->
                                <form id="deleteuraianForm" method="POST"
                                    action="{{ route('uraian.destroy', $uraian->id) }}" style="display: inline;">
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
