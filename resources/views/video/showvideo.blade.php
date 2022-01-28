<!DOCTYPE html>
@extends('admin.body')
@section('title')
{{ 'Detail '.$video->name.' - Admin Rainer' }}
@endsection
@section('ext-css')
<!-- DataTables -->
<link rel="stylesheet" href="/assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="/assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="/assets/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- SweetAlert2 -->
<link rel="stylesheet" href="/assets/adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
@endsection
@section('container')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Buku Detail</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item"><a href="/admin/video">Buku</a></li>
                    <li class="breadcrumb-item active">{{ $video->name }}</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Detail <b>{{ $video->name }}</b></h3>
                        <div class="float-right">
                            <a href="/admin/video/{{ $video->id }}/edit" class="btn btn-success">Edit</a>
                            <form class="ml-3 d-inline" action="/admin/video/{{ $video->id }}" method="post">@method('delete')@csrf <button id="delvideo" class="btn btn-danger" type="submit">Hapus</button></form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <h3>Judul Buku : {{ $video->name }}</h3>
                                <h3>Cover Buku : </h3>
                            </div>
                            <div class="col-lg-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td>Email</td>
                                        <td>:</td>
                                        <td>{{ $video->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Sekolah</td>
                                        <td>:</td>
                                        <td>
                                            @if(empty($video->getSchool->sch_name))
                                            -
                                            @else
                                            {{ $video->getSchool->sch_name }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kelas</td>
                                        <td>:</td>
                                        <td>
                                            @if(empty($video->getGrade->grade_name))
                                            -
                                            @else
                                            {{ $video->getGrade->grade_name }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Jurusan</td>
                                        <td>:</td>
                                        <td>
                                            @if(empty($video->getMajor->maj_name))
                                            -
                                            @else
                                            {{ $video->getMajor->maj_name }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Role</td>
                                        <td>:</td>
                                        <td>{{ $video->role }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- card body -->
                    <div class="card-footer">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('ext-script')
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

{{-- Custom Scripts --}}
{{-- <script>
    $(document).ready(function() {
        $('.btn-videodel').click(function(e) {
            e.preventDefault;
            Swal.fire({
                title: 'Are you sure?'
                , text: "You won't be able to revert this!"
                , icon: 'warning'
                , showCancelButton: true
                , confirmButtonColor: '#3085d6'
                , cancelButtonColor: '#d33'
                , confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/admin/singlepage"
                        , data: {{}}
, success: success
, dataType: dataType
});
}
})
});
});

</script> --}}
<script>
    $(function() {
        $('#videotable').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
@if (session('success'))
<script>
    $(document).ready(function(e) {
        e.preventDefault;
        Swal.fire({
            icon: 'success',
            title: 'Done',
            text: "{{session('success')}}",
            timer: 1700
        });
    })
</script>
@endif
@if (session('failed'))
<script>
    $(document).ready(function(e) {
        e.preventDefault;
        Swal.fire({
            icon: 'error',
            title: 'Failed',
            text: "{{session('failed')}}",
            timer: 1700
        });
    })
</script>
@endif
@endsection