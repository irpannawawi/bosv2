@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header d-flex  justify-content-between">
            <h3 class="pull-left">Anggota</h3>
            <a href="{{ route('anggota.create') }}" class="btn btn-primary">Add</a>
        </div>
        <div class="card-body">
            <table id="data-table" class="table table-bordered table-sm table-striped ">
                <thead class="bg-dark text-light text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Pangkat/Nrp</th>
                        <th>Lokasi Tugas</th>
                        <th>Username/Password</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($anggotas as $anggota)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $anggota->nama }}</td>
                            <td>{{ $anggota->pangkat.'/'.$anggota->nrp }}</td>
                            <td>{{ $anggota->desa?->kecamatan?->nama.'/'.$anggota->desa?->nama }}</td>
                            <td>{{ $anggota->username.'/'.$anggota->password }}</td>
                            <td class="text-end">
                                <a href="{{ route('anggota.edit', $anggota->id) }}" class="btn btn-primary">Edit</a>

                                <!-- Button untuk menghapus -->
                                <form id="deleteanggotaForm" method="POST"
                                    action="{{ route('anggota.destroy', $anggota->id) }}" style="display: inline;">
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
