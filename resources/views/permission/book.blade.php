<!DOCTYPE html>
@extends('/admin/body')
@section('title', 'Akses Buku - Admin Perpus')
@section('ext-css')
<!-- Select2 -->
<link rel="stylesheet" href="/assets/adminlte/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="/assets/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

{{-- DataTables --}}
<link rel="stylesheet" href="/assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="/assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection
@section('container')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 style="font-size: 45px" class="display-3">Daftar Buku {{ $school->sch_name }}</h2>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item"><a href="/admin/akses">Akses</a></li>
                    <li class="breadcrumb-item"><a href="/admin/akses/{{ $school->id }}">Sekolah</a></li>
                    <li class="breadcrumb-item active">buku</li>
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
                        <button data-target="#modal-add" data-toggle="modal" class="btn btn-dark">Tambah buku</button>
                    </div>
                    <div class="card-body">
                        <table id="tb-book" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Buku</th>
                                    <th>Jenjang</th>
                                    <th>Kelas</th>
                                    <th>Tahun</th>
                                    <th>Penerbit</th>
                                    <th>Pengarang</th>
                                    <th>Aksi</th>
                                </tr>
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
                <div class="modal-header">
                    <h1>Tambah Buku</h1>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <table id="tb-add" class="table table-responsive table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Buku</th>
                                    <th>Jenjang</th>
                                    <th>Kelas</th>
                                    <th>Tahun</th>
                                    <th>Penerbit</th>
                                    <th>Pengarang</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    
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
        var idschool = "{{ Request::segment(3) }}";

        var table = $('#tb-book').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "dom":'Blfrtip',
            "buttons": ['excel','pdf'],
            "autoWidth": false,
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "columns": [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            }, {
                data: "title",
                name: "title"
            }, {
                data: "get_edu",
                name: "get_edu",
                render: function(data) {
                    return data.edu_name;
                },
                orderable: false,
                searchable: false
            },{
                data: "get_grade",
                name: "get_grade",
                render: function(data) {
                    return data.grade_name;
                },
                orderable: false,
                searchable: false
            },{
                data: "published_year",
                name: "published_year"
                
            },{
                data: "publisher",
                name: "publisher"
                
            },{
                data: "author",
                name: "author"

            },
            // {
            //     data: "schools",
            //     render: function (data) { 
            //      return data[0].sch_name;
            //     }
            // },
            {
                data: 'DT_RowId',
                render: function (data) { 
                    return '<button data-id="'+data+'" type="button" class="d-inline del-book btn btn-danger"><i class="fas fa-trash"></i></button>';
                 },
                 orderable : false,
                 searchable: false
            }],
            "ajax": {url : "/sekolah/"+idschool+"/buku",}
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
                        url: "/admin/akses/" + idschool +"/buku",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id_buku: id
                        },
                        success: function(data) {
                            Swal.fire({
                                icon: data.status,
                                title: "Berhasil",
                                text: data.message,
                                timer: 1200
                            });
                            table.draw();
                        },
                        error: function(data) {
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

        // Modal pop-up
        var tb = $('#tb-add');
        $('#modal-add').on('shown.bs.modal', function (e) {
            e.preventDefault();
            tb.DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                // "dom":'Blfrtip',
                // "buttons": ['excel','pdf'],
                "autoWidth": false,
                "responsive": true,
                "processing": true,
                "serverSide": true,
                "columns": [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                }, {
                    data: "title",
                    name: "title"
                }, {
                    data: "get_edu",
                    name: "get_edu",
                    render: function(data) {
                        return data.edu_name;
                    },
                    orderable: false,
                    searchable: false
                },
                {
                    data: "get_grade",
                    name: "get_grade",
                    render: function(data) {
                        return data.grade_name;
                    },
                    orderable: false,
                    searchable: false
                },{
                    data: "published_year",
                    name: "published_year"
                    
                },{
                    data: "publisher",
                    name: "publisher"
                    
                },{
                    data: "author",
                    name: "author"

                },{
                    data: 'DT_RowId',
                    render: function (data) { 
                        return '<button data-id="'+data+'" type="button" class="d-inline add-buku btn btn-success"><i class="fas fa-plus"></i></button>';
                    },
                    searchable:false
                }],
                "ajax": {url : "/akses/buku/"+idschool}
            });
        });
        $('#modal-add').on('hidden.bs.modal', function (e) {
            e.preventDefault();
            tb.dataTable().fnClearTable();
            tb.dataTable().fnDestroy();
        });
        $('#tb-add tbody').on('click', '.add-buku', function(e) {
            e.preventDefault();
            var id = $(this).attr('data-id');
            Swal.fire({
                title: 'Yakin tambah akses buku?',
                text: "Sekolah akan dapat akses buku tersebut!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#4CAF50',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, tambah!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: "/admin/akses/" + idschool+"/buku",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id_buku: id
                        },
                        success: function(data) {
                            Swal.fire({
                                icon: data.status,
                                title: "Berhasil",
                                text: data.message,
                                timer: 1200
                            });
                            $('#modal-add').modal('hide');
                            table.draw();
                            $('#modal-add').modal('show');
                        },
                        error: function(data) {
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