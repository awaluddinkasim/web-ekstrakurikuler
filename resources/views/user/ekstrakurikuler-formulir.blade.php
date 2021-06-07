@extends('layouts.user')


@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Formulir</h3>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('userIndex') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a
                            href="{{ route('userIndex').'/ekstrakurikuler' }}">Ekstrakurikuler</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Formulir</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<section class="section">
    <div class="card">
        <div class="card-body">
            <form action="" method="POST">
                @csrf
                <div class="divider">
                    <div class="divider-text">Data Pribadi</div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ auth()->user()->nama }}"
                                readonly required>
                        </div>

                        <div class="form-group">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                        </div>


                        <div class="form-group">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" autocomplete="off" required>
                        </div>

                        <div class="form-group">
                            <label for="tgl_lahir">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jk">Jenis Kelamin</label>
                            <select class="form-select" id="jk" name="jk" required>
                                <option value="" hidden>Pilih</option>
                                <option value="L" {{ auth()->user()->jk == 'L' ? 'selected' : ''}}>Laki-laki</option>
                                <option value="P" {{ auth()->user()->jk == 'P' ? 'selected' : ''}}>Perempuan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="usia">Usia</label>
                            <input type="text" class="form-control" pattern="[0-9]+" id="usia" name="usia" autocomplete="off" required>
                        </div>

                        <div class="form-group position-relative has-icon-left">
                            <label for="hp">No. HP</label>
                            <div class="position-relative">
                                <input type="text" class="form-control" id="hp" name="hp" autocomplete="off" required>
                                <div class="form-control-icon">
                                    +62
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="divider">
                    <div class="divider-text">Data Orang Tua</div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ayah">Nama Ayah</label>
                            <input type="text" class="form-control" id="ayah" name="ayah" autocomplete="off" required>
                        </div>
                        <div class="form-group position-relative has-icon-left">
                            <label for="hp_ortu">No. HP</label>
                            <div class="position-relative">
                                <input type="text" class="form-control" id="hp_ortu" name="hp_ortu" autocomplete="off" required>
                                <div class="form-control-icon">
                                    +62
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ibu">Nama Ibu</label>
                            <input type="text" class="form-control" id="ibu" name="ibu" autocomplete="off" required>
                        </div>
                    </div>
                </div>

                <div class="divider">
                    <div class="divider-text">Data Lain</div>
                </div>


                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="pengalaman_org" class="form-label">Pengalaman Organisasi</label>
                        <textarea class="form-control" id="pengalaman_org" name="pengalaman_org" rows="2" required></textarea>
                        <p>
                            <small class="text-danger">Pisahkan dengan tanda koma (,) jika lebih dari satu.</small>
                        </p>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="motto" class="form-label">Motto</label>
                        <textarea class="form-control" id="motto" name="motto" rows="2" required></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="gol_darah">Golongan Darah (opsional)</label>
                        <input type="text" class="form-control" id="gol_darah" name="gol_darah" autocomplete="off">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="riwayat_penyakit">Penyakit yang pernah diderita</label>
                        <input type="text" class="form-control" id="riwayat_penyakit" name="riwayat_penyakit" autocomplete="off" required>
                        <p>
                            <small class="text-danger">Tulis ( - ) jika tidak ada.</small>
                        </p>
                    </div>
                </div>


                <div class="form-group">
                    <label for="alasan_masuk" class="form-label">Alasan Masuk</label>
                    <textarea class="form-control" id="alasan_masuk" name="alasan_masuk" rows="3" required></textarea>
                </div>
                <div class="clearfix">
                    <button class="btn btn-primary float-end">Kirim</button>
                </div>
            </form>
        </div>
    </div>

</section>
@endsection
