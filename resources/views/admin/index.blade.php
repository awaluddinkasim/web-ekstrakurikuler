@extends('layouts.admin')


@section('content')
<div class="page-title">
    <h3>Dashboard</h3>
</div>
@php
$siswa = App\Models\User::where('level', 'siswa')->count();
$prestasi = App\Models\Prestasi::count();
$ekstrakurikuler = App\Models\Ekstrakurikuler::count();
@endphp
<section class="section">
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-none bg-primary">
                <div class="card-body text-white">
                    <h5>Siswa</h5>
                    <div class="clearfix">
                        <h2 class="float-end">{{ $siswa }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-none bg-primary">
                <div class="card-body text-white">
                    <h5>Ekstrakurikuler</h5>
                    <div class="clearfix">
                        <h2 class="float-end">{{ $ekstrakurikuler }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-none bg-primary">
                <div class="card-body text-white">
                    <h5>Prestasi Ekstrakurikuler</h5>
                    <div class="clearfix">
                        <h2 class="float-end">{{ $prestasi }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Profil</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Struktur</button>
                </div>
            </nav>
        </div>
        <div class="card-body">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="clearfix my-1">
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                            data-bs-target="#modalProfil">
                            Edit
                        </button>
                    </div>
                    @if (isset($profil->value))
                        <img src="{{ asset('img/profil/'.$profil->value) }}" alt="" style="width: 100%">
                    @else
                    <div class="d-flex flex-column text-center text-muted py-5" style="opacity: .3">
                        <i data-feather="image" style="width: 150px; height: 150px" class="mx-auto"></i>
                        <h4>Profil Kosong</h4>
                    </div>
                    @endif
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="clearfix my-1">
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                            data-bs-target="#modalStruktur">
                            Edit
                        </button>
                    </div>
                    @if (isset($struktur->value))
                        <img src="{{ asset('img/profil/'.$struktur->value) }}" alt="" style="width: 100%">
                    @else
                    <div class="d-flex flex-column text-center text-muted py-5" style="opacity: .3">
                        <i data-feather="image" style="width: 150px; height: 150px" class="mx-auto"></i>
                        <h4>Struktur Belum Ada</h4>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Kegiatan 1 minggu kedepan</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Kegiatan</th>
                                    <th>Penyelenggara</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $item)
                                <tr>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->ekstrakurikuler->ekstrakurikuler }}</td>
                                    <td>{{ Carbon\Carbon::parse($item->tgl_mulai)->diffForHumans() }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center">Tidak ada kegiatan</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Grafik Pendaftar</h4>
                </div>
                <div class="card-body">
                    <canvas id="bar"></canvas>
                </div>
            </div>
        </div>
    </div>

</section>


<!-- Modal -->
<div class="modal fade" id="modalStruktur" tabindex="-1" aria-labelledby="modalStrukturLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalStrukturLabel">Upload Struktur Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ Request::url().'/struktur' }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-file">
                        <label class="form-file-label d-block" for="gambar">
                            <span class="form-file-text">Pilih Gambar</span>
                        </label>
                        <input type="file" class="form-file-input" id="gambar" name="gambar" accept=".jpg, .jpeg, .png" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalProfil" tabindex="-1" aria-labelledby="modalProfilLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalProfilLabel">Upload Profil Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ Request::url().'/data' }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-file">
                        <label class="form-file-label d-block" for="gambar">
                            <span class="form-file-text">Pilih Gambar</span>
                        </label>
                        <input type="file" class="form-file-input" id="gambar" name="gambar" accept=".jpg, .jpeg, .png" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
var chartColors = {
  red: 'rgb(255, 99, 132)',
  orange: 'rgb(255, 159, 64)',
  yellow: 'rgb(255, 205, 86)',
  green: 'rgb(75, 192, 192)',
  info: '#41B1F9',
  blue: '#3245D1',
  purple: 'rgb(153, 102, 255)',
  grey: '#EBEFF6'
};

var ctxBar = document.getElementById("bar").getContext("2d");
var myBar = new Chart(ctxBar, {
  type: 'bar',
  data: {
    labels: ["Total Siswa", "Siswa Mendaftar"],
    datasets: [{
      label: 'Siswa',
      backgroundColor: [chartColors.blue, chartColors.purple],
      data: [
        {{ $totalSiswa }},
        {{ $siswaMendaftar }},
      ]
    }]
  },
  options: {
    responsive: true,
    barRoundness: 1,
    title: {
      display: false,
      text: "Grafik Siswa"
    },
    legend: {
      display:false
    },
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true,
          suggestedMax: 10,
          padding: 10,
        },
        gridLines: {
          drawBorder: false,
        }
      }],
      xAxes: [{
            gridLines: {
                display:false,
                drawBorder: false
            }
        }]
    }
  }
});

</script>
@endpush
