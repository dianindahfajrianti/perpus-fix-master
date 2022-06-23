<!DOCTYPE html>
@extends('admin.body')
@section('title','Admin - Import Video')
@section('ext-css')
<link rel="stylesheet" href="/assets/adminlte/plugins/sweetalert2/sweetalert2.css">

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
                    <li class="breadcrumb-item"><a href="/admin/video">Video</a></li>
                    <li class="breadcrumb-item">Import</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card card-dark">
                    <div class="card-header">
                        <div class="card-title">Daftar Import Video Sementara</div>
                    </div>
                    <div class="card-body">
                        <table id="tb-temp" class="table table-striped">
                            <tr>
                                <td>No</td>
                                <th>Judul Video</th>
                                <th>Deskripsi</th>
                                <th>Creator</th>
                                <td>Sekolah</td>
                                <td>Kelas</td>
                                <td>Jurusan</td>
                                <td>Mapel</td>
                                <td>Aksi</td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-footer"></div>
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

    <!--Javascript Admin -->
    <script src="/assets/js/admin.js"></script>
<script>
    $(document).ready(function() {
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
        bsCustomFileInput.init();
        //Initialize DataTable
        var tb = $('#tb-temp').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "processing": true,
            "serverSide": true,
        });

    });
</script>
@endsection