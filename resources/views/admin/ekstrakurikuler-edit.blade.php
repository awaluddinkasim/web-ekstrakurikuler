@extends('layouts.admin')


@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Ekstrakurikuler</h3>
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
            <form action="" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama">Nama Ekstrakurikuler</label>
                    <input type="text" class="form-control" id="nama" name="nama" autocomplete="off" value="{{ $data->ekstrakurikuler }}" required>
                </div>
                <div class="form-group">
                    <label for="ketua">Ketua</label>
                    <select class="choices form-select" id="ketua" name="ketua" required>
                        <option value="">Pilih</option>
                        @foreach ($daftarSiswa as $siswa)
                        <option value="{{ $siswa->username }}" {{ $data->ketua->username == $siswa->username ? 'selected' : '' }}>{{ $siswa->username }} - {{ $siswa->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="pembina">Nama Pembina</label>
                    <input type="text" class="form-control" id="pembina" name="pembina" autocomplete="off" value="{{ $data->pembina }}" required>
                </div>

                <div class="clearfix">
                    <button type="submit" class="btn btn-primary float-end">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
