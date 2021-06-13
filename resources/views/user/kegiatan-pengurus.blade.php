@extends('layouts.user')


@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>{{ ucfirst($jenis) }} Kegiatan {{ auth()->user()->ekstrakurikuler->ekstrakurikuler }}</h3>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('adminIndex') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Kegiatan</li>
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
                        <th>Nama Kegiatan</th>
                        <th>Mulai</th>
                        <th>Akhir</th>
                        @if ($jenis == 'jadwal')
                        <th></th>
                        @endif
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($daftarKegiatan as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->nama }}</td>
                        <td>{{ Carbon\Carbon::parse($data->tgl_mulai)->isoFormat('D MMMM YYYY') }} pukul {{ Carbon\Carbon::parse($data->jam_mulai)->format('H:i') }}</td>
                        <td>{{ Carbon\Carbon::parse($data->tgl_selesai)->isoFormat('D MMMM YYYY') }} pukul {{ Carbon\Carbon::parse($data->jam_selesai)->format('H:i') }}</td>
                        @if ($jenis == 'jadwal')
                        <td>
                            <form action="{{ Request::url().'/'.md5('selesai') }}" method="post">
                                @csrf
                                @method('put')
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <button class="btn btn-warning btn-sm">Selesai</button>
                            </form>
                        </td>
                        @endif
                        <td>
                            <button class="btn btn-info btn-sm px-2" onclick="document.location.href = '{{ Request::url().'/'.$data->id }}'"><i data-feather="edit"></i></button>
                            <form action="{{ Request::url().'/hapus' }}" method="post">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <button class="btn btn-outline-danger btn-sm px-2" type="submit"><i data-feather="trash-2"></i></button>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kegiatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama Kegiatan</label>
                        <input type="text" class="form-control" id="nama" name="nama" autocomplete="off" required>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="mulai">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="mulai" name="mulai" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="jam_mulai">Pukul</label>
                            <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="selesai">Tanggal Selesai</label>
                            <input type="date" class="form-control" id="selesai" name="selesai" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="jam_selesai">Pukul</label>
                            <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" required>
                        </div>
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
