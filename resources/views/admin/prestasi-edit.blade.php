@extends('layouts.admin')


@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Prestasi</h3>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('adminIndex') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ekstrakurikuler</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<form action="" method="POST"></form>
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="nama">Nama Prestasi</label>
                    <input type="text" class="form-control" id="nama" name="nama" autocomplete="off" value="{{ $data->prestasi }}" required>
                </div>
                <div class="form-group">
                    <label for="tahun">Tahun</label>
                    <input type="text" class="form-control" id="tahun" name="tahun" autocomplete="off" value="{{ $data->tahun }}" required>
                </div>

                <div class="form-group">
                    <label for="old">Gambar Lama</label>
                    <img src="{{ asset('img/'.strtolower(str_replace(' ', '-', $data->ekstrakurikuler->ekstrakurikuler))).'/'.$data->gambar }}" alt="" class="d-block" style="max-width: 200px">
                </div>

                <div class="form-file">
                    <label class="form-file-label d-block" for="gambar">
                        <span class="form-file-text">Pilih Gambar Baru</span>
                    </label>
                    <input type="file" class="form-file-input" id="gambar" name="gambar">
                </div>
                <div class="clearfix">
                    <button type="submit" class="btn btn-primary float-end">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
