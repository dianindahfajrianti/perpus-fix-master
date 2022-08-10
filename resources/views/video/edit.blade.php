<!DOCTYPE html>
@extends('/admin/body')
@section('title')
Detail {{ $video->title }}
@endsection
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
                <h3 class="display-4">Edit Video</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item"><a href="/admin/video">Video</a></li>
                    <li class="breadcrumb-item">Edit Video Info</li>
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
                        <h3 class="card-title">Edit Video Info</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{route("video.update",$video->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Detik video untuk thumbnail</label>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="input-group @error('jam'){{ 'is-invalid' }}@enderror">
                                            <div class="input-group-prepend"><span class="input-group-text">Jam</span></div>
                                            <input class="form-control" type="number" min="00" max="2" name="jam" id="jam" value="{{ old('jam',$tObj->jam) }}"/>
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
                                            <input class="form-control" type="number" menit="00" max="59" name="menit" id="menit" value="{{ old('menit',$tObj->menit) }}"/>
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
                                            <input class="form-control" type="number" min="00" max="59" name="detik" id="detik" value="{{ old('detik',$tObj->detik) }}"/>
                                        </div>
                                        @error('detik')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="jenjang">Jenjang</label>
                                <div class="input-group">
                                    <select name="jenjang" class="form-control select2bs4 @error('jenjang'){{ 'is-invalid' }}@enderror" id="jenjang" aria-label="Example select with button addon">
                                        <option value="">-- Pilih Jenjang --</option>
                                        @foreach ($edu as $e)
                                        <option @if( old('jenjang', $video->edu_id) ==$e->id){{ 'selected' }} @endif value="{{ $e->id }}">{{ $e->edu_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('jenjang')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="kelas">Kelas</label>
                                <div class="input-group">
                                    <select name="kelas" class="form-control select2bs4 @error('kelas'){{ 'is-invalid' }}@enderror" id="kelas" aria-label="">
                                        <option value="">-- Pilih Kelas --</option>
                                        {{-- @for ($i = 1; $i < 13; $i++) <option @if(old('kelas',$video->grade_id)==$i){{ 'selected' }}@endif value="{{ $i }}">{{ numberToRomanRepresentation($i) }}</option>
                                            @endfor --}}
                                    </select>
                                    @error('kelas')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="sekolah">Jurusan</label>
                                <div class="input-group">
                                    <select name="jurusan" class="form-control select2bs4 @error('jurusan'){{ 'is-invalid' }}@enderror" id="jurusan" aria-label="">
                                        <option value="">-- Pilih Jurusan --</option>
                                        {{-- @foreach ($maj as $m )
                                        <option @if(old('jurusan',$video->major_id)==$m->id){{ 'selected' }}@endif value="{{ $m->id }}">{{ $m->maj_name }}</option>
                                        @endforeach --}}
                                    </select>
                                    @error('jurusan')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="mapel">Mata Pelajaran</label>
                                <div class="input-group">
                                    <select name="mapel" class="form-control select2bs4 @error('mapel'){{ 'is-invalid' }}@enderror" id="mapel" aria-label="">
                                        <option value="">-- Pilih Mata Pelajaran --</option>
                                        {{-- @foreach ($sub as $sbj )
                                        <option @if(old('mapel',$video->sub_id)==$sbj->id){{ 'selected' }}@endif value="{{ $sbj->id }}">{{ $sbj->sbj_name }}</option>
                                        @endforeach --}}
                                    </select>
                                    @error('mapel')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="judul">Judul Video</label>
                                <input type="text" name="judul" id="judul" class="form-control @error('judul'){{'is-invalid'}}@enderror" value="{{ old('judul', $video->title) }}">
                                @error('judul')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="desc">Deskripsi</label>
                                <input type="text" name="deskripsi" id="desc" class="form-control @error('deskripsi'){{'is-invalid'}}@enderror" value="{{ old('deskripsi', $video->desc) }}">
                                @error('deskripsi')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="creator">Creator</label>
                                <input type="text" name="nama_pembuat" id="creator" class="form-control @error('nama_pembuat'){{'is-invalid'}}@enderror" value="{{ old('nama_pembuat', $video->creator) }}">
                                @error('nama_pembuat')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
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
<!-- Page specific script -->
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
        bsCustomFileInput.init();

        
    });
    function addZero(i) {
        if (i < 10) {i = "0" + i}
        return i;
    }

    $(document).ready(function() {

        var jurusanID = $('#jurusan').val();
        var oldMapel = "{{ old('kelas', $video->sub_id) }}"
        console.log(oldKelas);
        console.log(jurusanID);
            $.ajax({
                url: '/sub/'+jurusanID,
                type: "GET",
                success:function(data){
                    console.log(data);
                    $('#mapel').empty();
                    $('#mapel').append('<option value="" hidden>-- Pilih Mata Pelajaran --</option>'); 
                    $.each(data, function(index, mapel){
                        if (oldMapel == mapel.id){
                            $('select[name="mapel"]').append('<option selected value="'+ mapel.id +'">' + mapel.sbj_name+ '</option>');
                        } else{
                            $('select[name="mapel"]').append('<option value="'+ mapel.id +'">' + mapel.sbj_name+ '</option>');
                        }
                    });
                }
            });
        
        var id = $('#jenjang').val();
        var oldKelas = "{{ old('kelas', $video->grade_id) }}"
        console.log(oldKelas);
        console.log(id);
        var url = "{{ Request :: segment(count(Request :: segments())) }}";
        $.ajax({
            type: "get",
            url: "/gr/"+id+"?url="+url,
            success:function(data){
                console.log(data);
                $('#kelas').empty();
                $('#kelas').append('<option value="" hidden>-- Pilih Kelas --</option>'); 
                $.each(data, function(index, kelas){
                    if (oldKelas == kelas.id){
                        $('select[name="kelas"]').append('<option selected value="'+ kelas.id +'">' + kelas.grade_name+ '</option>');

                    } else {
                        $('select[name="kelas"]').append('<option value="'+ kelas.id +'">' + kelas.grade_name+ '</option>');
                    }
                });
            }
        });

        $('#jurusan').on('change', function() {
            var jurusanID = $(this).val();
            console.log(jurusanID);
                $.ajax({
                    url: '/sub/'+jurusanID,
                    type: "GET",
                    success:function(data){
                        console.log(data);
                        $('#mapel').empty();
                        $('#mapel').append('<option value="" hidden>-- Pilih Mata Pelajaran --</option>'); 
                        $.each(data, function(index, mapel){
                            $('select[name="mapel"]').append('<option value="'+ mapel.id +'">' + mapel.sbj_name+ '</option>');
                        });
                    }
                });
        });

        $('#jenjang').change(function (e) {
            e.preventDefault();
            var id = $(this).val();
            console.log(id);
            var url = "{{ Request :: segment(count(Request :: segments())) }}";
            $.ajax({
                type: "get",
                url: "/gr/"+id+"?url="+url,
                success:function(data){
                    console.log(data);
                    $('#kelas').empty();
                    $('#kelas').append('<option value="" hidden>-- Pilih Kelas --</option>'); 
                    $.each(data, function(index, kelas){
                        $('select[name="kelas"]').append('<option value="'+ kelas.id +'">' + kelas.grade_name+ '</option>');
                    });
                }
            });
            $.ajax({
                type: "get",
                url: "/maj/"+id,
                success: function (data) {
                    $('#jurusan').empty();
                    $('#jurusan').append('<option value="" hidden>-- Pilih jurusan --</option>'); 
                    $.each(data, function(index, jurusan){
                        console.log(jurusan);
                        $('select[name="jurusan"]').append('<option value="'+ jurusan.id +'">' + jurusan.maj_name + " - "+jurusan.educations.edu_name+ '</option>');
                    });
                }
            });
        });
        
    });
</script>
@endsection