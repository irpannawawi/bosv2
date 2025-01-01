@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header d-flex  justify-content-between">
            <h3 class="pull-left">Generator</h3>
            <form action="{{ route('generator.create') }}" method="get">
                @csrf
                <div class="row">
                    <div class="col">
                        <input type="number" name="jml" class="form-control mr-2" placeholder="Jumlah">
                    </div>
                    <div class="col">
                        <input type="date" name="tgl_start" class="form-control mr-2" placeholder="Tanggal Mulai">
                    </div>
                    <div class="col">
                        <input type="date" name="tgl_end" class="form-control mr-2" placeholder="Tanggal Selesai">
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Generate</button>
                    </div>
                </div>

            </form>
        </div>
        <div class="card-body">
            <table id="data-table" class="table table-bordered table-sm table-striped ">
                <thead class="bg-dark text-light text-center">
                    <tr>
                        <th>No</th>
                        <th>Anggota</th>
                        <th>Laporan</th>
                        <th>Download</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($anggotas as $anggota)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $anggota->nama }}</td>
                            <td class="text-center">{{ $anggota->laporan->count() }}</td>
                            <td class="text-center">
                                <a href="{{ route('generator.download', $anggota->nrp) }}" class="btn btn-primary"><i class="fa fa-download"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
