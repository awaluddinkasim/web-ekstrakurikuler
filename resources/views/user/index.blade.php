@extends('layouts.user')

@section('content')
<div class="page-title">
    <h3>Dashboard</h3>
</div>
@php
    $kegiatan = App\Models\Kegiatan::where('jenis', 'jadwal')->count();
    $prestasi = App\Models\Prestasi::count();
    $ekstrakurikuler = App\Models\Ekstrakurikuler::count();
@endphp
<section class="section">
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-none bg-primary">
                <div class="card-body text-white">
                    <h5>Kegiatan</h5>
                    <div class="clearfix">
                        <h2 class="float-end">{{ $kegiatan }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-none bg-primary">
                <div class="card-body text-white">
                    <h5>Prestasi</h5>
                    <div class="clearfix">
                        <h2 class="float-end">{{ $prestasi }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-none bg-primary">
                <div class="card-body text-white">
                    <h5>Ekstrakurikuler</h5>
                    <div class="clearfix">
                        <h2 class="float-end">{{ $ekstrakurikuler }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body py-5 text-center">
            <h4>Selamat Datang</h4>
            <p>Sistem Informasi Ekstrakurikuler SMAN 7</p>
        </div>
    </div>
</section>
@endsection
