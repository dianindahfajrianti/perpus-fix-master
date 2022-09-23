<!DOCTYPE html>
@extends('/admin/body')
@section('title', 'Buku - Admin Perpus')
@section('ext-css')
<!-- Select2 -->
<link rel="stylesheet" href="/assets/adminlte/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="/assets/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

<link rel="stylesheet" href="/assets/css/admin.css">

@endsection
@section('csrf-ajax')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('container')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="display-4">Daftar buku</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item active">Buku</li>
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
        <div class="row justify-content-center">
            <div class="col-10">
                <!-- general form elements -->
                <div class="card">
                    <div class="card-header">
                        <button data-target="#modal-add" data-toggle="modal" class="btn btn-dark">Tambah buku</button>
                        <button class="btn btn-dark ask">Import Buku</button>
                    </div>
                    <div class="card-body">
                        {{-- <div class="table-responsive"> --}}
                        <table id="tb-book" class="table table-bordered table-striped">
                            <thead>
                                <th>No</th>
                                <th>ID</th>
                                <th>Judul Buku</th>
                                <th>Jenjang</th>
                                <th>Kelas</th>
                                <th>Tahun Terbit</th>
                                <th>Penerbit</th>
                                <th>Pengarang</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade show" aria-modal="true" id="modal-add" aria-hidden="false" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form id="fdata" action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h1>Tambah buku</h1>
                    </div>
                    <div class="modal-body">
                        <p class="text-red">*) Pastikan seluruh input terisi</p>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-toggle="tab" href="#tab1" role="tab" aria-controls="file" aria-selected="true">File</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-toggle="tab" href="#tab2" role="tab" aria-controls="sekolah" aria-selected="false">Sekolah</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-toggle="tab" href="#tab3" role="tab" aria-controls="buku" aria-selected="false">Buku</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label" for="filebook">Upload File</label>
                                            <div class="input-group @error('filebook'){{'is-invalid'}}@enderror">
                                                <div class="custom-file">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="ct-file-desc">Upload</span>
                                                    </div>
                                                    <label for="" class="custom-file-label">Pilih PDF</label>
                                                    @csrf
                                                    <input type="file" name="filebook" id="filebook" class="custom-file-input @error('filebook'){{'is-invalid'}}@enderror" value="{{old('filebook')}}" accept=".pdf">
                                                </div>
                                            </div>
                                            @error('filebook')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <canvas id="pdfViewer"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2">
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
                                                    {{-- @foreach ($kls as $k )
                                                    <option @if(old('kelas')==$k->id){{ 'selected' }}@endif value="{{ $k->id }}">{{ $k->grade_name }}</option>
                                                    @endforeach --}}
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
                                                <select name="jurusan" class="form-control select2bs4 @error('jurusan'){{ 'is-invalid' }}@enderror" id="jurusan" aria-label="">
                                                    <option hidden value="">-- Pilih Jurusan --</option>
                                                    {{-- @foreach ($maj as $m )
                                                    <option @if(old('jurusan')==$m->id){{ 'selected' }}@endif value="{{ $m->id }}">{{ $m->maj_name }}</option>
                                                    @endforeach --}}
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
                                                <select name="mapel" class="form-control select2bs4 @error('mapel'){{ 'is-invalid' }}@enderror" id="mapel" aria-label="">
                                                    <option value="">-- Pilih Mata Pelajaran --</option>
                                                    {{-- @foreach ($sub as $sbj )
                                                    <option @if(old('mapel')==$sbj->id){{ 'selected' }}@endif value="{{ $sbj->id }}">{{ $sbj->sbj_name }}</option>
                                                    @endforeach --}}
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
                                            <label class="form-label" for="judul">Judul Buku</label>
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
                                            <textarea type="text" name="desc" id="desc" class="form-control @error('desc'){{'is-invalid'}}@enderror" value="{{old('desc')}}"></textarea>
                                            @error('desc')
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
                                            <label class="form-label" for="tahun">Tahun Terbit</label>
                                            <input type="text" name="tahun" id="tahun" class="form-control @error('tahun'){{'is-invalid'}}@enderror" value="{{old('tahun')}}">
                                            @error('tahun')
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
                                            <label class="form-label" for="penerbit">Penerbit</label>
                                            <input type="text" name="penerbit" id="penerbit" class="form-control @error('penerbit'){{'is-invalid'}}@enderror" value="{{old('penerbit')}}">
                                            @error('penerbit')
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
                                            <label class="form-label" for="pengarang">Pengarang</label>
                                            <input type="text" name="pengarang" id="pengarang" class="form-control @error('pengarang'){{'is-invalid'}}@enderror" value="{{old('pengarang')}}">
                                            @error('pengarang')
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
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" id="save-book" class="btn btn-secondary">Tambah</button>
                    </div>
                </form>  
            </div>
        </div>
    </div>
</section>
@endsection
@section('ext-script')
<!-- bs-custom-file-input -->

<script src="/assets/adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="/assets/adminlte/plugins/select2/js/select2.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="/assets/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/assets/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/assets/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/assets/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/assets/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="/assets/adminlte/plugins/jszip/jszip.min.js"></script>
<script src="/assets/adminlte/plugins/pdfmake/pdfmake.min.js"></script>
<script src="/assets/adminlte/plugins/pdfmake/vfs_fonts.js"></script>
<script src="/assets/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/assets/adminlte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="/assets/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- SweetAlert2 -->
<script src="/assets/adminlte/plugins/sweetalert2/sweetalert2.min.js"></script>

<!--Javascript Admin -->
<script src="/assets/js/admin.js"></script>
<!-- Page specific script -->
<script>
    $(document).ready(function() {
        //Initialize Select2 Elements
        $('#valpar').hide();
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
        bsCustomFileInput.init();

        var table = $('#tb-book').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "columnDefs": [{
                targets: [1],
                visible: false,
                searchable: false
            }],
            "columns": [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    className: 'details-control',
                    responsivePriority: 1
                },
                {
                    data: "id",
                    name: "id",
                    orderable: false
                },
                {
                    data: "title",
                    name: "title"
                },
                {
                    data: "education",
                    name: "education.edu_name",
                    render: function(data) {
                        console.log();
                        return data.edu_name;
                    },
                },
                {
                    data: "grades",
                    name: "grades.grade_name",
                    render: function(data) {
                        return data.grade_name;
                    },
                },
                {
                    data: "published_year",
                    name: "published_year"
                },
                {
                    data: "publisher",
                    name: "publisher"
                },
                {
                    data: "author",
                    name: "author"
                },
                {
                    data: 'DT_RowId',
                    render: function (data) { 
                        return '<button data-id="'+data+'" type="button" class="edit-book btn btn-success"><i class="fas fa-edit"></i></button> <button data-id="'+data+'" type="button" class="d-inline del-book btn btn-danger"><i class="fas fa-trash"></i></button>';
                    },
                    searchable:false
                }
            ],
            "ajax": "/buku/all"
        });
        $('#tb-book tbody').on('click', '.edit-book', function(e) {
            e.preventDefault;
            var id = $(this).attr('data-id');
            window.location.href = "buku/" + id + "/edit";
        });
        $('#tb-book tbody').on('click', '.del-book', function(e) {
            e.preventDefault;
            var id = $(this).attr('data-id');
            Swal.fire({
                title: 'Yakin hapus?',
                text: "Anda tidak bisa kembalikan data!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "delete",
                        url: "/admin/buku/"+id,
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(data) {
                            console.log(data);
                            Swal.fire({
                                icon: data.status,
                                title: data.title,
                                text: data.message,
                                timer: 1200
                            });
                            table.draw();
                        },
                        error: function(data) {
                            console.log(data);
                            var js = data.responseJSON;
                            Swal.fire({
                                icon: 'error',
                                title: js.exception,
                                text: js.message,
                                timer: 1200
                            });
                        }
                    });
                }
            });
        });

        $(".ask").on('click',function (e) { 
            e.preventDefault();
            Swal.fire({
                title: 'Sudah import file?',
                html: "<a href='buku-import' class='btn btn-dark'>Belum</a> <a href='buku-excel' class='btn btn-dark'>Sudah</a>",
                icon: 'question',
                showConfirmButton:false,
                showCancelButton: true,
                cancelButtonColor: '#d33'
            });
        });
    
        var id = $('#jenjang').val();
        // console.log('ID Jenjang :' ,id);
        var url = "{{ Request :: segment(count(Request :: segments())) }}";
        var oldKelas = "{{ old('kelas') }}"
        var oldJurusan = "{{ old('jurusan') }}"

        if (oldKelas){
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
            // console.log('Old Kelas :' ,oldKelas);
        }
        
        if(oldJurusan){
            $.ajax({
                type: "get",
                url: "/maj/"+id,
                success: function (data) {
                    $('#jurusan').empty();
                    $('#jurusan').append('<option value="" hidden>-- Pilih jurusan --</option>'); 
                    $.each(data, function(index, jurusan){
                        console.log(jurusan);
                        if (oldJurusan = jurusan.id){
                            $('select[name="jurusan"]').append('<option selected value="'+ jurusan.id +'">' + jurusan.maj_name + " - "+jurusan.educations.edu_name+ '</option>');
                        }else{
                            $('select[name="jurusan"]').append('<option value="'+ jurusan.id +'">' + jurusan.maj_name + " - "+jurusan.educations.edu_name+ '</option>');
                        }
                    });
                }
            });
            // console.log('Old Jurusan :' ,oldJurusan);
        }
        
        // var jurusanID = $('#jurusan').val();
        var oldMapel = "{{ old('mapel') }}"
        // console.log('ID Jurusan :' ,oldJurusan);

        if(oldJurusan){
            if(oldMapel) {
                $.ajax({
                    url: '/sub/'+oldJurusan,
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
            }
        }
        
        $('#jenjang').change(function(e) {
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

        $('#jurusan').on('change', function() {
            var jurusanID = $(this).val();
            console.log(jurusanID);
            if(jurusanID) {
                    $.ajax({
                    url: '/sub/'+jurusanID,
                    type: "GET",
                    success:function(data)
                    {
                        console.log(data);
                        $('#mapel').empty();
                        $('#mapel').append('<option value="" hidden>-- Pilih Mata Pelajaran --</option>'); 
                        $.each(data, function(index, mapel){
                            $('select[name="mapel"]').append('<option value="'+ mapel.id +'">' + mapel.sbj_name+ '</option>');
                        });
                    }
                });
            }
            
        });

    });
</script>
@include('admin.validator')
@endsection