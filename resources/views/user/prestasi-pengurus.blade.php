@extends('layouts.user')


@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Prestasi {{ auth()->user()->ekstrakurikuler->ekstrakurikuler }}</h3>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('adminIndex') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Prestasi</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<section class="section">
    <div class="card">
        <div class="card-header">
            <div class="clearfix">
                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    Tambah
                </button>
            </div>
        </div>
        <div class="card-body">
            <table class='table table-hover' id="table1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Gambar</th>
                        <th>Prestasi</th>
                        <th>Tahun</th>
                        <th></th>
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
                        <td>{{ $data->tahun }}</td>
                        <td>
                            <button class="btn btn-info btn-sm px-2" onclick="document.location.href = '{{ Request::url().'/'.$data->id }}'"><i data-feather="edit"></i></button>
                            <form action="{{ Request::url().'/hapus' }}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <button class="btn btn-outline-danger btn-sm px-2"><i data-feather="trash-2"></i></button>
                            </form>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Prestasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama Prestasi</label>
                        <input type="text" class="form-control" id="nama" name="nama" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="tahun">Tahun</label>
                        <input type="text" class="form-control" id="tahun" name="tahun" autocomplete="off" required>
                    </div>
                    <div class="form-file">
                        <label class="form-file-label d-block" for="gambar">
                            <span class="form-file-text">Pilih Gambar</span>
                        </label>
                        <input type="file" class="form-file-input" id="gambar" name="gambar">
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
