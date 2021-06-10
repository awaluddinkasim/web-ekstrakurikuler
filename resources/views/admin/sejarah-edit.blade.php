@extends('layouts.admin')

@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Edit Sejarah</h3>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('adminIndex') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="#">Profil</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('adminIndex').'/profil/sejarah' }}">Sejarah</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
    </div>
</div>


<section class="section">
    <div class="card">
        <div class="card-body">
            <form action="" method="post" id="formSejarah">
                @csrf
                <div data-tiny-editor id="editorSejarah">
                    {!! isset($data->value) ? $data->value : '' !!}
                </div>
                <input type="hidden" name="sejarah" id="sejarah" value="">
                <div class="clearfix mt-2">
                    <button class="btn btn-primary float-end" type="button" id="btnSimpan">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

@push('scripts')
    <script>
        $('#btnSimpan').click(function() {
            var editor_content = $('#editorSejarah').html();
            $('#sejarah').val(editor_content);
            $('#formSejarah').submit();
        })
    </script>
@endpush
