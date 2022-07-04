<!DOCTYPE html>
@extends('/admin/body')
@section('title', 'Admin - Import Video')
@section('ext-css')
<!-- Select2 -->
<link rel="stylesheet" href="/assets/adminlte/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="/assets/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<link rel="stylesheet" href="/assets/css/admin.css">
{{-- TimePicker --}}
<link rel="stylesheet" href="/assets/adminlte/plugins/timepicker/jquery.timepicker.min.css">
@endsection
@section('container')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="display-4">Import Excel</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item"><a href="/admin/video">Video</a></li>
                    <li class="breadcrumb-item">Import Video</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@php
    function numberToRomanRepresentation($number) {
    $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
    $returnValue = '';
    while ($number > 0) {
    foreach ($map as $roman => $int) {
    if($number >= $int) {
    $number -= $int;
    $returnValue .= $roman;
    break;
    }
    }
    }
    return $returnValue;
    }
@endphp
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Import Excel</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{ route('video.saveExcel') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Download Nama File</label>
                                <div class="input-group">
                                    <a href="/admin/video/xcl-download">
                                        <button type="button" class="btn btn-primary">
                                            <i class="fas fa-download" download></i>
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Contoh Input Excel</label>
                                <div class="input-group">
                                    <img src="/assets/perpus/assets/img/contohexcelvideo.png" alt="" class="img-fluid">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="xcl">Import Excel File</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <label for="xcl" class="custom-file-label">Choose excel file</label>
                                        <input class="custom-file-input" type="file" name="xcl" id="xcl" accept=".xls,.xlsx">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-dark">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('ext-script')
<!-- bs-custom-file-input -->
<script src="/assets/adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="/assets/adminlte/plugins/select2/js/select2.min.js"></script>
<script src="/assets/adminlte/plugins/timepicker/jquery.timepicker.min.js"></script>
<!-- Page specific script -->
<script>
    $(document).ready(function() {
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
        bsCustomFileInput.init();

        //Customize timepicker.js
        $('#frame').timepicker({
            timeFormat: 'HH:mm:ss',
            maxHour: 2,
            dynamic: true,
            dropdown: true,
            scrollbar: true
        });
    });

</script>
@endsection
