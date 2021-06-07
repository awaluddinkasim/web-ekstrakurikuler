@extends('layouts.user')


@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Riwayat Kegiatan</h3>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('adminIndex') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Kegiatan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ ucfirst($jenis) }}</li>
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
                        <th>Nama Kegiatan</th>
                        <th>Mulai</th>
                        <th>Akhir</th>
                        <th>Ekstrakurikuler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($daftarKegiatan as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->nama }}</td>
                        <td>{{ Carbon\Carbon::parse($data->tgl_mulai)->isoFormat('D MMMM YYYY') }} pukul {{ Carbon\Carbon::parse($data->jam_mulai)->format('H:i') }}</td>
                        <td>{{ Carbon\Carbon::parse($data->tgl_selesai)->isoFormat('D MMMM YYYY') }} pukul {{ Carbon\Carbon::parse($data->jam_selesai)->format('H:i') }}</td>
                        <td>{{ $data->ekstrakurikuler->ekstrakurikuler }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</section>
@endsection
