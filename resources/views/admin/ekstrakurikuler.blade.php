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
<section class="section">
    <div class="card">
        <div class="card-header">
            <div class="clearfix">
                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Tambah
                </button>
            </div>

        </div>
        <div class="card-body">
            <table class='table table-hover' id="table1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Ketua</th>
                        <th>Pembina</th>
                        <th>Pendaftar</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($daftarData as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->ekstrakurikuler }}</td>
                        <td>{{ $data->ketua->nama }}</td>
                        <td>{{ $data->pembina }}</td>
                        <td>{{ $data->pendaftar->count() }}</td>
                        <td>
                            <button class="btn btn-info btn-sm px-2"><i data-feather="edit"></i></button>
                            <button class="btn btn-outline-danger btn-sm px-2"><i data-feather="trash-2"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</section>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Ekstrakurikuler</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama Ekstrakurikuler</label>
                        <input type="text" class="form-control" id="nama" name="nama" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="ketua">Ketua</label>
                        <select class="choices form-select" id="ketua" name="ketua" required>
                            <option value="">Pilih</option>
                            @foreach ($daftarSiswa as $siswa)
                            <option value="{{ $siswa->username }}">{{ $siswa->username }} - {{ $siswa->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pembina">Nama Pembina</label>
                        <input type="text" class="form-control" id="pembina" name="pembina" autocomplete="off" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
