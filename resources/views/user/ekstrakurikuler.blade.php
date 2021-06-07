@extends('layouts.user')


@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Ekstrakurikuler</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('userIndex') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ekstrakurikuler</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">

                <table class='table table-hover' id="table1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Ketua</th>
                            <th>Pembina</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($daftarData as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->ekstrakurikuler }}</td>
                            <td>{{ $data->ketua->nama }}</td>
                            <td>{{ $data->pembina }}</td>
                            <td class="text-center">
                                @if (auth()->user()->formulir->count() > 0)
                                    @php
                                        $formulir = auth()->user()->formulir->where('id_ekstrakurikuler', $data->id)->first();
                                    @endphp
                                    @if ($formulir)
                                        @if ($formulir->status == 'pending')
                                        <form action="{{ Request::url().'/'.md5('batal') }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $formulir->id }}">
                                            <button class="btn btn-danger btn-sm" type="submit">Batal</button>
                                        </form>
                                        @else
                                        <span class="{{ $formulir->status == 'diterima' ? 'text-success' : 'text-danger' }}">{{ ucfirst($formulir->status) }}</span>
                                        @endif
                                    @else
                                        <button class="btn btn-success btn-sm" onclick="document.location.href = '{{ Request::url().'/'.$data->id }}'">Daftar</button>
                                    @endif
                                @else
                                    <button class="btn btn-success btn-sm" onclick="document.location.href = '{{ Request::url().'/'.$data->id }}'">Daftar</button>
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
