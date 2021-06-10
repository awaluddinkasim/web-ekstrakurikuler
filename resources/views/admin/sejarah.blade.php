@extends('layouts.admin')

@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>{{ ucfirst($sub) }}</h3>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('adminIndex') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Profil</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ ucfirst($sub) }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>


<section class="section">
    <div class="card">
        <div class="card-header">
            <div class="clearfix">
                <button type="button" class="btn btn-primary float-end" onclick="document.location.href = '{{ Request::url().'/edit' }}'">
                    Edit
                </button>
            </div>
        </div>
        <div class="card-body py-5">
            {!! isset($data->value) ? $data->value : '' !!}
        </div>
    </div>
</section>
@endsection
