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
                        <li class="breadcrumb-item active" aria-current="page">Admin</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                Daftar Akun Admin
            </div>
            <div class="card-body">
                <table class='table table-hover' id="table1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($daftarAdmin as $admin)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $admin->username }}</td>
                            <td>{{ $admin->nama }}</td>
                            <td>{{ $admin->jk }}</td>
                            <td class="text-center">
                                @if ($admin->username != 'admin')
                                <button class="btn btn-info btn-sm px-2"><i data-feather="edit"></i></button>
                                <button class="btn btn-outline-danger btn-sm px-2"><i data-feather="trash-2"></i></button>
                                @else
                                -
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </section>
@endsection
