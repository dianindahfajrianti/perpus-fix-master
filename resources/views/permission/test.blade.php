<!DOCTYPE html>
@extends('/admin/body')
@section('title', 'User - Admin Perpus')
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
                <h3 class="display-4">Daftar user</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item active">user</li>
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
                        <button data-target="#modal-add" data-toggle="modal" class="btn btn-dark">Tambah user</button> <button data-target="#modal-import" data-toggle="modal" class="d-inline btn btn-dark">Import user</button>
                    </div>
                    <div class="card-body">
                        <p>Export to :</p>
                        <table id="tb-user" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Buku</th>
                                    <th>Nama Sekolah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($schools as $s => $v)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @forelse($v->books as $b => $va)
                                        @if ($va->id === $v->)
                                            
                                        @endif
                                        {{ $va->title }}
                                        @empty
                                            No Books in this school
                                        @endforelse
                                    </td>
                                    <td>{{ $v->sch_name }}</td>
                                    <td></td>
                                </tr>
                                @empty
                                    No Books in this school
                                @endforelse
                            </tbody>
                        </table>
                    </div>
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

        // var table = $('#tb-user').DataTable({
        //     "paging": true,
        //     "lengthChange": false,
        //     "searching": true,
        //     "ordering": true,
        //     "info": true,
        //     "dom":'Blfrtip',
        //     "buttons": ['excel','pdf'],
        //     "autoWidth": false,
        //     "responsive": true,
        //     "processing": true,
        //     "serverSide": true,
        //     "columns": [{
        //         data: 'DT_RowIndex',
        //         name: 'DT_RowIndex',
        //         orderable: false,
        //         searchable: false
        //     }, {
        //         data: "name",
        //         name: "name"
        //     }, {
        //         data: "username",
        //         name: "username"
        //     }, {
        //         data: "role",
        //         name: "role",
        //         render: function(data, type, full, mime) {
        //             var rl = "";
        //             if (data == 0) {
        //                 rl = "Super Admin";
        //             } else if (data == 1) {
        //                 rl = "Admin Sekolah";
        //             } else if (data == 2) {
        //                 rl = "Admin Guru";
        //             } else {
        //                 rl = "Murid";
        //             }
        //             return rl;
        //         }
        //     }, {
        //         defaultContent: '<button type="button" class="d-inline v-user btn btn-info"><i class="fas fa-eye"></i></button> <button type="button" class="edit-user btn btn-success"><i class="fas fa-edit"></i></button> <button type="button" class="d-inline del-user btn btn-danger"><i class="fas fa-trash"></i></button>'
        //     }],
        //     "ajax": "/user/all"
        // });
        // $('#tb-user tbody').on('click', '.edit-user', function(e) {
        //     e.preventDefault;
        //     var id = $(this).closest('tr').attr('id');
        //     window.location.href = "user/" + id + "/edit";
        // });
        // $('#tb-user tbody').on('click', '.v-user', function(e) {
        //     e.preventDefault;
        //     var id = $(this).closest('tr').attr('id');
        //     window.location.href = "user/" + id;
        // });
        // $('#tb-user tbody').on('click', '.del-user', function(e) {
        //     e.preventDefault;
        //     var id = $(this).closest('tr').attr('id');
        //     Swal.fire({
        //         title: 'Yakin hapus?',
        //         text: "Anda tidak bisa kembalikan data!",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Ya, hapus!'
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             $.ajax({
        //                 type: "delete",
        //                 url: "/admin/user/" + id,
        //                 data: {
        //                     _token: "{{ csrf_token() }}",
        //                 },
        //                 success: function(data) {
        //                     Swal.fire({
        //                         icon: data.status,
        //                         title: "Berhasil",
        //                         text: data.message,
        //                         timer: 1200
        //                     });
        //                     table.draw();
        //                 },
        //                 error: function(data) {
        //                     var js = data.responseJSON;
        //                     Swal.fire({
        //                         icon: 'error',
        //                         title: js.exception,
        //                         text: js.message,
        //                         timer: 1200
        //                     });
        //                 }
        //             });
        //         }
        //     });
        // });
    });
</script>
@include('admin.validator')
@endsection