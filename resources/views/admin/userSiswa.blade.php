@extends('layouts.admin')


@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Daftar Pengguna</h3>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('adminIndex') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Data Pengguna</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Siswa</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<section class="section">
    <div class="card">
        <div class="card-header">
            <div class="clearfix">
                Daftar Akun Siswa
                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    Tambah
                </button>
            </div>
        </div>
        <div class="card-body">

            @if (Session::has('failed'))
            <div class="alert alert-light-danger">{!! Session::get('failed') !!}</div>
            @endif
            <table class='table table-hover' id="table1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($daftarSiswa as $siswa)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $siswa->username }}</td>
                        <td>{{ $siswa->nama }}</td>
                        <td>{{ $siswa->jk == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                        <td>
                            <button class="btn btn-info btn-sm px-2"
                                onclick="document.location.href = '{{ Request::url().'/'.$siswa->username }}'"><i
                                    data-feather="edit"></i></button>
                            <form action="{{ Request::url().'/hapus' }}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="username" value="{{ $siswa->username }}">
                                <button class="btn btn-outline-danger btn-sm px-2" type="submit"><i
                                        data-feather="trash-2"></i></button>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Ekstrakurikuler</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST">
                @csrf
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" id="nama" class="form-control" name="nama" autocomplete="off" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="nis">Nomor Induk Siswa</label>
                                <input type="text" id="nis" class="form-control" name="nis" autocomplete="off"
                                    maxlength="10" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="jk">Jenis Kelamin</label>
                                <select class="form-select" id="jk" name="jk" required>
                                    <option value="" selected hidden>Pilih</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" id="password" class="form-control" name="password" required>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="conf_password">Konfirmasi Password</label>
                                <input type="password" id="conf_password" class="form-control" name="conf_password"
                                    required>
                                <div class="invalid-feedback">
                                    Konfirmasi password tidak cocok.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="signUpBtn" disabled>Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>

        function confirmed() {
            var password = $('#password').val();
            var konfirmasiPassword = $('#conf_password').val();

            if (password == konfirmasiPassword) {
                $('#conf_password').removeClass('is-invalid')
                $('#signUpBtn').attr('disabled', false)
            } else {
                $('#conf_password').addClass('is-invalid')
                $('#signUpBtn').attr('disabled', true)
            }
        }

        $('#password').on('change keyup', function() {
            if ($('#password').val() != '') {
                confirmed()
            }
        })

        $('#conf_password').on('change keyup', function() {
            confirmed()
        })

        $('#formRegister').submit(function (e) {
            var password = $('#password').val();
            var konfirmasiPassword = $('#conf_password').val();

            if (password != konfirmasiPassword) {
                e.preventDefault();
                $('#conf_password').focus()
            }
        })
    </script>
@endpush
