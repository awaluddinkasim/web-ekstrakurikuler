@extends('layouts.admin')


@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Edit</h3>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('adminIndex') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Data Pengguna</a></li>
                    <li class="breadcrumb-item"><a href="#">Siswa</a></li>
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
            <form action="" method="POST" id="formEdit">
                @csrf
                <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" id="nama" class="form-control" name="nama" autocomplete="off" value="{{ $data->nama }}" required>
                </div>
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="nis">Nomor Induk Siswa</label>
                            <input type="text" id="nis" class="form-control" name="nis" autocomplete="off" value="{{ $data->username }}" maxlength="10" readonly required>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="jk">Jenis Kelamin</label>
                            <select class="form-select" id="jk" name="jk" required>
                                <option value="" selected hidden>Pilih</option>
                                <option value="L" {{ $data->jk == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ $data->jk == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" class="form-control" name="password">
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="conf_password">Konfirmasi Password</label>
                            <input type="password" id="conf_password" class="form-control" name="conf_password">
                            <div class="invalid-feedback">
                                Konfirmasi password tidak cocok.
                            </div>
                        </div>
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
                $('#conf_password').attr('required', true)
                confirmed()
            } else {
                $('#conf_password').attr('required', false)
                $('#conf_password').removeClass('is-invalid')
            }
        })

        $('#conf_password').on('change keyup', function() {
            confirmed()
        })
    </script>
@endpush
