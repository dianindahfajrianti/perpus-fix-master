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
                <h3 class="display-4">Edit Kelas</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item"><a href="/admin/grade">Kelas</a></li>
                    <li class="breadcrumb-item">Edit Kelas</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Edit Kelas</h3>
                    </div>
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
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{ route("grade.update",$grade->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="kelas">Kelas</label>
                                {{-- <input type="text" name="kelas" id="kelas" class="form-control @error('kelas'){{'is-invalid'}}@enderror" value="{{$grade->grade_name}}"> --}}
                                <select name="kelas" class="form-control select2bs4 @error('kelas'){{ 'is-invalid' }} @enderror" id="kelas" aria-label="Example select with button addon">
                                    <option value="">-- Pilih Kelas </option>
                                    @for ($i = 1; $i < 13; $i++) <option @if(old('kelas', $grade->grade_name)==$i) {{ 'selected' }}@endif value="{{ $i }}">{{ numberToRomanRepresentation($i) }}</option>
                                    @endfor
                                </select>

                                @error('kelas')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-dark">Save</button>
                            <a href="/admin/grade">
                                <button type="button" class="btn btn-secondary">Cancel</button>
                            </a>
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
@endsection
