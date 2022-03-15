<!DOCTYPE html>
@extends('/admin/body')
@section('title', 'Admin - Menu')
@section('ext-css')
<!-- Select2 -->
<link rel="stylesheet" href="/assets/adminlte/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="/assets/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endsection
@section('container')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Daftar Sekolah</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item active">Akses</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            @forelse ($school as $s )
            <div class="col-lg-2 col-6">
                @php
                    $arCo = ['info','success','lightblue','teal','olive'];
                    $c = array_rand($arCo);
                @endphp
                <a href="/admin/akses/{{$s->id}}" class="small-box bg-gradient-{{ $arCo[$c] }}">
                    <div class="inner">
                        <h3>{{ $s->hasEdu->edu_name }}</h3>
                        <p>{{ $s->sch_name }}</p>
                    </div>
                    <div class="icon"><i class="fas fa-school"></i></div>
                </a>
            </div>
            @empty
            <div class="col-lg-2 col-6">
                Sekolah belum ditambahkan
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
@section('ext-script')
<!-- bs-custom-file-input -->
<script src="/assets/adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="/assets/adminlte/plugins/select2/js/select2.min.js"></script>
<!-- Page specific script -->
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
        bsCustomFileInput.init();
    });

</script>
@include('admin.validator')
@endsection
