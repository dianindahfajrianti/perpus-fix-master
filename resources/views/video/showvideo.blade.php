<!DOCTYPE html>
@extends('admin.body')
@section('title')
{{ 'Detail '.$video->title.' - Admin Rainer' }}
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
                <h1>Video Detail</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item"><a href="/admin/video">Video</a></li>
                    <li class="breadcrumb-item active">{{ $video->title }}</li>
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
                        <h3 class="card-title">Detail <b>{{ $video->title }}</b></h3>
                        <div class="float-right">
                            <form class="ml-3 d-inline" action="/admin/video/{{ $video->id }}" method="post">@method('delete')@csrf <button id="delvideo" class="btn btn-danger" type="submit">Hapus</button></form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <a href="/admin/video/{{ $video->id }}/edit-file" class="btn btn-warning">Edit video</a><br><br>
                                <video width="70%" controls>
                                    <source src="{{ url('storage/video/'.$video->filename.".".$video->filetype) }}" type="video/{{ $video->filetype }}">
                                        Your browser does not support the video tag.
                                </video>
                                <h3>Judul Video : {{ $video->title }}</h3>
                                <h3>Thumbnail Video :</h3>
                                <img class="img-fluid" src="/storage/thumb/video/{{ $video->thumb }}" alt="Thumbnail">
                            </div>
                            <div class="col-lg-6">
                                <a href="/admin/video/{{ $video->id }}/edit" class="btn btn-success">Edit info</a>
                                <table class="table table-borderless">
                                    <tr>
                                        <td>Deskripsi</td>
                                        <td>:</td>
                                        <td>{{ $video->desc }}</td>
                                    </tr>
                                    <tr>
                                        <td>Creator</td>
                                        <td>:</td>
                                        <td>{{ $video->creator }}</td>
                                    </tr>
                                    <tr>
                                        <td>Jenjang</td>
                                        <td>:</td>
                                        <td>
                                            @if(empty($video->getEdu->edu_name))
                                            -
                                            @else
                                            {{ $video->getEdu->edu_name }}
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
                                        <td>Mata Pelajaran</td>
                                        <td>:</td>
                                        <td>
                                            @if(empty($video->getSubject->sbj_name))
                                            -
                                            @else
                                            {{ $video->getSubject->sbj_name }}
                                            @endif
                                        </td>
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