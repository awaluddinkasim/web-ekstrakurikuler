<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>

<body>

    <div id="auth">

        <div class="container">
            <div class="row">
                <div class="col-md-7 col-sm-12 mx-auto">
                    <div class="card py-4">
                        <div class="card-body">
                            <div class="text-center mb-5">
                                <img src="assets/images/logo.png" height="100" class='mb-4'>
                                <h3>Buat Akun</h3>
                                <p>Silahkan lengkapi data Anda.</p>
                            </div>
                            @if (Session::has('failed'))
                            <div class="alert alert-light-danger">{!! Session::get('failed') !!}</div>
                            @endif
                            <form action="" method="POST" id="formRegister">
                                @csrf
                                <div class="form-group">
                                    <label for="nama">Nama Lengkap</label>
                                    <input type="text" id="nama" class="form-control" name="nama" autocomplete="off" required>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="nis">Nomor Induk Siswa</label>
                                            <input type="text" id="nis" class="form-control" name="nis" autocomplete="off" maxlength="10" required>
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
                                            <input type="password" id="conf_password" class="form-control" name="conf_password" required>
                                            <div class="invalid-feedback">
                                                Konfirmasi password tidak cocok.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-grid gap-2 mt-4">
                                    <button class="btn btn-primary" id="signUpBtn" disabled>Sign up</button>
                                </div>
                                <div class="d-flex justify-content-center pt-3">
                                    <p>Sudah punya akun? <a href="/login">Sign in</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="{{ asset('assets/js/feather-icons/feather.min.js') }}"></script>

    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>

    <script src="{{ asset('assets/js/main.js') }}"></script>

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
</body>

</html>
