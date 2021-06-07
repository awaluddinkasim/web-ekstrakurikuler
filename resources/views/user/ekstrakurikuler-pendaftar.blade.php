@extends('layouts.user')


@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data {{auth()->user()->ekstrakurikuler->ekstrakurikuler}}</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('userIndex') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pendaftar</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="card-title">Pendaftar Ekstrakurikuler {{ auth()->user()->ekstrakurikuler->ekstrakurikuler }}</div>
                <table class='table table-hover' id="table1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Usia</th>
                            <th>Jenis Kelamin</th>
                            <th>No. HP</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $pendaftar)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pendaftar->pendaftar->nama }}</td>
                            <td>{{ $pendaftar->usia }}</td>
                            <td>{{ $pendaftar->pendaftar->jk == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                            <td>0{{ $pendaftar->hp }}</td>
                            <td class="{{ $pendaftar->status == 'diterima' ? 'text-success' : 'text-danger' }}">{{  ucfirst($pendaftar->status)  }}</td>
                            <td class="text-center">
                                <button class="btn btn-outline-success btn-sm" onclick="document.location.href = '{{ Request::url().'/'.$pendaftar->id }}'">Periksa</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
@endsection
