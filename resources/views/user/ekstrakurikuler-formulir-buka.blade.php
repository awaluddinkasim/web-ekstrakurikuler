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
            <div class="divider">
                <div class="divider-text">Data Pribadi</div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <p class="form-control-static" id="nama">{{ $data->pendaftar->nama }}</p>
                    </div>

                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <p class="form-control-static" id="kelas">{{ $data->kelas }}</p>
                    </div>

                    <div class="form-group">
                        <label for="alamat" class="form-label">Alamat</label>
                        <p class="form-control-static" id="alamat">{{ $data->alamat }}</p>

                    </div>
                    <div class="form-group">
                        <label for="jk">Jenis Kelamin</label>
                        <p class="form-control-static" id="jk">{{ $data->pendaftar->jk == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                    </div>

                </div>
                <div class="col-md-6">


                    <div class="form-group">
                        <label for="tempat_lahir">Tempat Lahir</label>
                        <p class="form-control-static" id="tempat_lahir">{{ $data->tempat_lahir }}</p>
                    </div>

                    <div class="form-group">
                        <label for="tgl_lahir">Tanggal Lahir</label>
                        <p class="form-control-static" id="tgl_lahir">{{ Carbon\Carbon::parse($data->tgl_lahir)->isoFormat('D MMMM YYYY') }}</p>
                    </div>
                    <div class="form-group">
                        <label for="usia">Usia</label>
                        <p class="form-control-static" id="usia">{{ $data->usia }} Tahun</p>
                    </div>

                    <div class="form-group position-relative has-icon-left">
                        <label for="hp">No. HP</label>
                        <p class="form-control-static" id="usia">0{{ $data->hp }}</p>
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
                        <p class="form-control-static" id="ayah">{{ $data->ayah }}</p>
                    </div>
                    <div class="form-group position-relative has-icon-left">
                        <label for="hp_ortu">No. HP</label>
                        <p class="form-control-static" id="hp_ortu">0{{ $data->hp_ortu }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ibu">Nama Ibu</label>
                        <p class="form-control-static" id="ibu">{{ $data->ibu }}</p>
                    </div>
                </div>
            </div>

            <div class="divider">
                <div class="divider-text">Data Lain</div>
            </div>


            <div class="row">
                <div class="form-group col-md-6">
                    <label for="pengalaman_org" class="form-label">Pengalaman Organisasi</label>
                    <p class="form-control-static" id="pengalaman_org">{{ $data->pengalaman_org }}</p>
                </div>
                <div class="form-group col-md-6">
                    <label for="motto" class="form-label">Motto</label>
                    <p class="form-control-static" id="motto">{{ $data->motto }}</p>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="gol_darah">Golongan Darah</label>
                    <p class="form-control-static" id="gol_darah">{{ $data->gol_darah ? $data->gol_darah : '-' }}</p>
                </div>
                <div class="form-group col-md-6">
                    <label for="riwayat_penyakit">Penyakit yang pernah diderita</label>
                    <p class="form-control-static" id="riwayat_penyakit">{{ $data->riwayat_penyakit }}</p>
                </div>
            </div>


            <div class="form-group">
                <label for="alasan_masuk" class="form-label">Alasan Masuk</label>
                <p class="form-control-static" id="alasan_masuk">{{ $data->alasan_masuk }}</p>
            </div>
            <div class="d-flex justify-content-end">
                <button class="btn icon icon-left btn-danger me-2" onclick="document.location.href = '{{ Request::url().'/'.md5('tolak') }}'">
                    <i data-feather="x-circle" width="20"></i>
                    Tolak
                </button>
                <button class="btn icon icon-left btn-success me-2" onclick="document.location.href = '{{ Request::url().'/'.md5('terima') }}'">
                    <i data-feather="check-circle" width="20"></i>
                    Terima
                </button>
            </div>
        </div>
    </div>

</section>
@endsection
