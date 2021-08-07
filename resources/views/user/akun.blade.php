@extends('layouts.user')


@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Akun Saya</h3>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('adminIndex') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Akun</li>
                </ol>
            </nav>
        </div>
    </div>
</div>


<section class="section">
    <div class="card">
        <div class="card-body p-5">
            <div class="row">
                <div class="col-md-5 col-sm-12 pe-4">
                    <img src="{{ asset('assets/images/profile.svg') }}" alt="profile" class="w-100">
                </div>
                <div class="col-md-7 col-sm-12 ps-4">
                    <form action="" method="POST" id="formProfile">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" id="nama" class="form-control" name="nama" autocomplete="off" required value="{{ auth()->user()->nama }}">
                        </div>
                        <div class="form-group">
                            <label for="nis">Nomor Induk Siswa</label>
                            <input type="text" id="nis" class="form-control" name="nis" autocomplete="off" value="{{ auth()->user()->username }}" readonly>
                        </div>
                        <div class="row">
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
                        <button class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>
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

        $('#formProfile').submit(function (e) {
            var password = $('#password').val();
            var konfirmasiPassword = $('#conf_password').val();

            if (password != konfirmasiPassword) {
                e.preventDefault();
                $('#conf_password').focus()
            }
        })
    </script>
@endpush
