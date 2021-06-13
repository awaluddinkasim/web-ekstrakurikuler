@extends('layouts.user')


@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>{{ ucfirst($jenis) }} Kegiatan</h3>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('userIndex') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Kegiatan</a></li>
                    <li class="breadcrumb-item"><a href="{{ '/'.md5('user').'/kegiatan/'.$jenis }}">{{ ucfirst($jenis) }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<form action="" method="POST"></form>
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <form action="" method="POST">
                @csrf

                <div class="form-group">
                    <label for="nama">Nama Kegiatan</label>
                    <input type="text" class="form-control" id="nama" name="nama" autocomplete="off" value="{{ $data->nama }}" required>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="mulai">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="mulai" name="mulai" value="{{ $data->tgl_mulai }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="jam_mulai">Pukul</label>
                        <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" value="{{ Carbon\Carbon::parse($data->jam_mulai)->format('H:i') }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="selesai">Tanggal Selesai</label>
                        <input type="date" class="form-control" id="selesai" name="selesai" value="{{ $data->tgl_selesai }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="jam_selesai">Pukul</label>
                        <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" value="{{ Carbon\Carbon::parse($data->jam_selesai)->format('H:i') }}" required>
                    </div>
                </div>
                <div class="clearfix">
                    <button type="submit" class="btn btn-primary float-end">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
