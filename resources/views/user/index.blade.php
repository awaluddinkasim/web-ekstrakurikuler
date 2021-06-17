@extends('layouts.user')

@section('content')
<div class="page-title">
    <h3>Dashboard</h3>
</div>
@php
    $kegiatan = App\Models\Kegiatan::where('jenis', 'jadwal')->count();
    $prestasi = App\Models\Prestasi::count();
    $ekstrakurikuler = App\Models\Ekstrakurikuler::count();
@endphp
<section class="section">
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-none bg-primary">
                <div class="card-body text-white">
                    <h5>Kegiatan</h5>
                    <div class="clearfix">
                        <h2 class="float-end">{{ $kegiatan }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-none bg-primary">
                <div class="card-body text-white">
                    <h5>Prestasi</h5>
                    <div class="clearfix">
                        <h2 class="float-end">{{ $prestasi }}</h2>
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
                                    <td colspan="2" class="text-center">Tidak ada kegiatan</td>
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
