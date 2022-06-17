<!DOCTYPE html>
@extends('/admin/body')
@section('title', 'Admin - Tambah Video')
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
                <h3 class="display-4">Tambah Video</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item"><a href="/admin/Video">Video</a></li>
                    <li class="breadcrumb-item">Tambah Video</li>
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
                        <h3 class="card-title">Tambah Video</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{ route('video.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" data-toggle="tab" href="#tab2" role="tab" aria-controls="sekolah" aria-selected="true">Sekolah</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-toggle="tab" href="#tab3" role="tab" aria-controls="video" aria-selected="false">Video</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="tab2" role="tabpanel" aria-labelledby="tab2">
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="jenjang">Jenjang</label>
                                                <div class="input-group">
                                                    <select class="form-control select2bs4 @error('jenjang'){{'is-invalid'}}@enderror" name="jenjang" id="jenjang" aria-label="Example select with button addon">
                                                        <option value="">-- Pilih Jenjang --</option>
                                                        @foreach ($edu as $e)
                                                        <option @if(old('jenjang')==$e->id){{ 'selected' }}@endif value="{{ $e->id }}">{{ $e->edu_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('jenjang')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="kelas">Kelas</label>
                                                <div class="input-group">
                                                    <select name="kelas" class="form-control select2bs4 @error('kelas'){{ 'is-invalid' }}@enderror" id="kelas" aria-label="">
                                                        <option value="">-- Pilih Kelas --</option>
                                                        @foreach ($kls as $k )
                                                        <option @if(old('kelas')==$k->id){{ 'selected' }}@endif value="{{ $k->id }}">{{ $k->grade_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('kelas')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="sekolah">Jurusan</label>
                                                <div class="input-group">
                                                    <select name="jurusan" class="form-control select2bs4 @error('jurusan'){{ 'is-invalid' }}@enderror"" id=" jurusan" aria-label="">
                                                        <option value="">-- Pilih Jurusan --</option>
                                                        @foreach ($maj as $m )
                                                        <option @if(old('jurusan')==$m->id){{ 'selected' }}@endif value="{{ $m->id }}">{{ $m->maj_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('jurusan')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="mapel">Mata Pelajaran</label>
                                                <div class="input-group">
                                                    <select name="mapel" class="form-control select2bs4 @error('mapel'){{ 'is-invalid' }}@enderror"" id=" mapel" aria-label="">
                                                        <option value="">-- Pilih Mata Pelajaran --</option>
                                                        @foreach ($sub as $sbj )
                                                        <option @if(old('mapel')==$sbj->id){{ 'selected' }}@endif value="{{ $sbj->id }}">{{ $sbj->sbj_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('mapel')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3">
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="judul">Judul Video</label>
                                                <input type="text" name="judul" id="judul" class="form-control @error('judul'){{'is-invalid'}}@enderror" value="{{old('judul')}}">
                                                @error('judul')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="desc">Deskripsi</label>
                                                <textarea type="text" name="deskripsi" id="desc" class="form-control @error('deskripsi'){{'is-invalid'}}@enderror" value="{{old('deskripsi')}}"></textarea>
                                                @error('deskripsi')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label" for="pembuat">Nama Pembuat</label>
                                                <input type="text" name="nama_pembuat" id="pembuat" class="form-control @error('nama_pembuat'){{'is-invalid'}}@enderror" value="{{old('nama_pembuat')}}">
                                                @error('nama_pembuat')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="frame">Detik video untuk thumbnail</label>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <div class="input-group @error('jam'){{ 'is-invalid' }}@enderror">
                                                            <div class="input-group-prepend"><span class="input-group-text">Jam</span></div>
                                                            <input class="form-control" type="number" min="00" max="2" name="jam" id="jam" value="{{ old('jam') }}"/>
                                                        </div>
                                                        @error('jam')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="input-group @error('menit'){{ 'is-invalid' }}@enderror">
                                                            <div class="input-group-prepend"><span class="input-group-text">Menit</span></div>
                                                            <input class="form-control" type="number" min="00" max="59" name="menit" id="menit" value="{{ old('menit') }}"/>
                                                        </div>
                                                        @error('menit')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="input-group @error('detik'){{ 'is-invalid' }}@enderror">
                                                            <div class="input-group-prepend"><span class="input-group-text">Detik</span></div>
                                                            <input class="form-control" type="number" min="00" max="59" name="detik" id="detik" value="{{ old('detik') }}"/>
                                                        </div>
                                                        @error('detik')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
