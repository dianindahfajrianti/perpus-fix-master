<!DOCTYPE html>
@extends('/admin/body')
@section('title', 'Mata Pelajaran - Admin Perpus')
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
            <div class="col-sm-8">
                <h3 class="display-4">Daftar Mata Pelajaran</h3>
            </div>
            <div class="col-sm-4">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item active">Mata Pelajaran</li>
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
                        <button data-target="#modal-add" data-toggle="modal" class="btn btn-dark">Tambah Mata Pelajaran</button>
                    </div>
                    <div class="card-body">
                        <table id="tb-subject" class="table table-bordered table-striped">
                            <thead>
                                <th>No</th>
                                <th>Mata Pelajaran</th>
                                <th>Jurusan</th>
                                <th>Aksi</th>
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
                <form id="fdata" action="{{route('mapel.store')}}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h1>Tambah Mata Pelajaran</h1>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mt-3">
                            <label class="form-label" for="jurusan">Jurusan</label>
                            <div class="input-group">
                                <select name="jurusan" class="form-control select2bs4 @error('jurusan'){{ 'is-invalid' }}@enderror"" id="jurusan" aria-label="">
                                    <option value="">-- Pilih Jurusan --</option>
                                    @foreach ($maj as $m )
                                    <option @if(old('jurusan')==$m->id){{ 'selected' }}@endif value="{{ $m->id }}">{{ $m->maj_name." - ".$m->educations->edu_name }}</option>
                                    @endforeach
                                </select>
                                @error('jurusan')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="mapel">Mata Pelajaran</label>
                            <input type="text" name="mapel" id="mapel" class="form-control @error('mapel'){{'is-invalid'}}@enderror" value="{{old('mapel')}}">
                            @error('mapel')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button id="save-subject" class="btn btn-secondary">Tambah</button>
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

<!-- Page specific script -->
<script>
    $(document).ready(function() {
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
        bsCustomFileInput.init();

        var table = $('#tb-subject').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true
            , "processing": true
            , "serverSide":true
            ,"columns": [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: "sbj_name",
                    name: "sbj_name"
                },
                {
                    data: "major",
                    name: "major.maj_name",
                    render: function (full,data,type,row) {
                        var ed = JSON.parse(full);
                        return ed.maj_name+" - "+ ed.educations.edu_name;
                    },
                    searchable:false,
                    orderable:false
                },
                {
                    data: 'DT_RowId',
                    render: function (data) { 
                        return '<button data-id="'+data+'" type="button" class="edit-subject btn btn-success"><i class="fas fa-edit"></i></button> <button data-id="'+data+'" type="button" class="d-inline del-subject btn btn-danger"><i class="fas fa-trash"></i></button>';
                    },
                    searchable:false,
                    orderable:false
                }
            ]
            ,"ajax" : "/mapel/all"
        });

        $('#tb-subject tbody').on('click','.edit-subject',function(e){
            e.preventDefault;
            var id = $(this).attr('data-id');
            window.location.href = "mapel/"+id+"/edit";
        });
        $('#tb-subject tbody').on('click','.del-subject',function(e){
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
                        type:"delete",
                        url:"/admin/mapel/"+id,
                        data:{
                            _token: "{{ csrf_token() }}",
                        },
                        success:function(data){
                            Swal.fire({
                            icon: data.status,
                            title: data.title,
                            text: data.message,
                            timer: 1200
                            });
                            table.draw();
                        },error:function(data){
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

    });
</script>
@include('admin.validator')
@endsection