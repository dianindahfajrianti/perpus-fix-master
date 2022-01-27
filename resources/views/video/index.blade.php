<!DOCTYPE html>
@extends('/admin/body')
@section('title', 'Video - Admin Perpus')
@section('ext-css')
<!-- Select2 -->
<link rel="stylesheet" href="/assets/adminlte/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="/assets/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<link rel="stylesheet" href="/assets/css/admin.css">

@endsection
@section('container')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="display-4">Daftar Video</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item active">Video</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-10">
                <!-- general form elements -->
                <div class="card">
                    <div class="card-header">
                        <button data-target="#modal-add" data-toggle="modal" class="btn btn-dark">Tambah Video</button>
                    </div>
                    <div class="card-body">
                        <table id="tb-video" class="table table-bordered table-striped">
                            <thead>
                                <th>No</th>
                                <th>Judul Video</th>
                                <th>Deskripsi</th>
                                <th>Creator</th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade show" aria-modal="true" id="modal-add" aria-hidden="false" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form id="fdata" action="{{route('video.store')}}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h1>Tambah video</h1>
                    </div>
                    <div class="modal-body">
                        <p class="text-red">*) Pastikan seluruh data terisi</p>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-toggle="tab" href="#tab1" role="tab" aria-controls="file" aria-selected="true">File</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-toggle="tab" href="#tab2" role="tab" aria-controls="sekolah" aria-selected="false">Sekolah</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-toggle="tab" href="#tab3" role="tab" aria-controls="video" aria-selected="false">Video</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="upload">Upload File</label>
                                            <input type="file" name="upload" id="upload" class="form-control @error('upload'){{'is-invalid'}}@enderror" value="{{old('upload')}}">
                                            @error('upload')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
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
                                                    @for ($i = 1; $i < 13; $i++) <option @if(old('kelas')==$i){{ 'selected' }}@endif value="{{ $i }}">{{ numberToRomanRepresentation($i) }}</option>
                                                        @endfor
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
                                            <input type="text" name="desc" id="desc" class="form-control @error('desc'){{'is-invalid'}}@enderror" value="{{old('desc')}}">
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
                                            <label class="form-label" for="creator">Creator</label>
                                            <input type="text" name="creator" id="creator" class="form-control @error('creator'){{'is-invalid'}}@enderror" value="{{old('creator')}}">
                                            @error('creator')
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
                        <button id="save-video" class="btn btn-secondary">Tambah</button>
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
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
        bsCustomFileInput.init();

        var table = $('#tb-video').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            // "processing": true,
            // "serverSide": true,
            // "ajax": "/video/all",
            "columns": [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: "title",
                    name: "title"
                },
                {
                    data: "desc",
                    name: "desc"
                },
                {
                    data: "creator",
                    name: "creator"
                },
                {
                    defaultContent: '<button type="button" class="edit-video btn btn-success"><i class="fas fa-edit"></i></button> <button type="button" class="d-inline del-video btn btn-danger"><i class="fas fa-trash"></i></button>'
                }
            ]
        });

    });
</script>
@include('admin.validator')
@endsection