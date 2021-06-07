@extends('layouts.user')


@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Galeri</h3>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('userIndex') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Galeri</li>
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
                        <th>Nama Ekstrakurikuler</th>
                        <th>Ketua</th>
                        <th>Pembina</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($daftarEkstrakurikuler as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->ekstrakurikuler }}</td>
                        <td>{{ $data->ketua->nama }}</td>
                        <td>{{ $data->pembina }}</td>
                        <td>
                            <button class="btn btn-info btn-sm icon icon-left" onclick="document.location.href = '{{ Request::url().'/'.$data->id }}'"><i data-feather="eye" width="20"></i>Lihat Galeri</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</section>

@endsection
