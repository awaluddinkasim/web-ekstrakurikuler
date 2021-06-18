@extends('layouts.user')


@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Profil</h3>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('userIndex') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Profil</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ ucfirst($sub) }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>


<section class="section">
    <div class="card">
        <div class="card-body">
            @if (isset($data->value))
                <img src="{{ asset('img/profil/'.$data->value) }}" alt="" style="width: 100%">
            @else
            <div class="d-flex flex-column text-center text-muted py-5" style="opacity: .3">
                <i data-feather="image" style="width: 150px; height: 150px" class="mx-auto"></i>
                <h4>Profil Kosong</h4>
            </div>
            @endif
        </div>
    </div>
</section>


@endsection
