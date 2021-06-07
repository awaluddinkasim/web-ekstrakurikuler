@extends('layouts.user')


@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Prestasi</h3>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('userIndex') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Prestasi</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<section class="section">
    <div class="card">
        <div class="card-body">
            <table class='table table-hover' id="table1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Gambar</th>
                        <th>Prestasi</th>
                        <th>Ekstrakurikuler</th>
                        <th>Tahun</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($daftarPrestasi as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <img src="{{ asset('img/'.strtolower(str_replace(' ', '-', $data->ekstrakurikuler->ekstrakurikuler))).'/'.$data->gambar }}" alt="" width="100">
                        </td>
                        <td>{{ $data->prestasi }}</td>
                        <td>{{ $data->ekstrakurikuler->ekstrakurikuler }}</td>
                        <td>{{ $data->tahun }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</section>
@endsection
