<!DOCTYPE html>
@extends('template/admin/body')
@section('title')
@foreach($prod as $p)
{{'Detail '.$p->name.' - Admin Rainer'}}
@endforeach
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
                <h1>Product Detail</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item"><a href="/admin/products">Products</a></li>
                    <li class="breadcrumb-item active">@foreach($prod as $p){{$p->name}}@endforeach</li>
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
                    @foreach ($prod as $p)
                    <div class="card-header">
                        <h3 class="card-title">Detail <b>{{$p->name}}</b></h3>
                        <div class="float-right">
                            <a href="/admin/products/{{$p->p_id}}/edit" class="btn btn-success">Edit</a>
                            <form class="ml-3 d-inline" action="/admin/products/{{$p->p_id}}" method="post">@method('delete')@csrf <button id="delprod" class="btn btn-danger" type="submit">Hapus</button></form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <h3>Product Name : {{$p->name}}</h3>
                                <h3>Product Image : </h3>
                                @php
                                $arrImg = explode(",",$p->img);
                                @endphp
                                @for($i = 0; $i < count($arrImg); $i++) <img src="/assets/uploads/products/{{$arrImg[$i]}}" alt="" class="img-fluid">
                                    <b>Image {{$i+1}}</b>
                                    @if($i != array_key_last($arrImg))
                                    <hr>
                                    @endif
                                    @endfor
                            </div>
                            <div class="col-lg-6">
                                <h3>Product's Selling Point :</h3>
                                <p>
                                    {{$p->desc1}}
                                </p>
                                <hr>
                                <h3>Product's Description :</h3>
                                <p>
                                    {{$p->desc}}
                                </p>
                                <hr>
                                <h3>Product's Key Feature :</h3>
                                @php
                                $arrKey = explode("\n",$p->feature);
                                @endphp
                                @for($i = 0; $i < count($arrKey); $i++) <p>
                                    {{$arrKey[$i]}}
                                    </p>
                                    @endfor
                                    <hr>
                                    <h3>Common Use :</h3>
                                    <p>
                                        {{$p->comuse}}
                                    </p>
                                    <hr>
                                    <h3>Product Specification : <a href="/admin/specs/{{$p->id}}/edit" type="button" class="float-right btn btn-success">Edit</a></h3>
                                    <table class="table table-borderless">
                                        <tr>
                                            <th>Part Type</th>
                                            <th></th>
                                            <th>Part Name</th>
                                        </tr>
                                        <tr>
                                            <td>Processor</td>
                                            <td>:</td>
                                            <td>{{$p->proc}}</td>
                                        </tr>
                                        <tr>
                                            <td>Chipset</td>
                                            <td>:</td>
                                            <td>{{$p->chip}}</td>
                                        </tr>
                                        <tr>
                                            <td>Memory</td>
                                            <td>:</td>
                                            <td>{{$p->memo}}</td>
                                        </tr>
                                        <tr>
                                            <td>PCIe Support</td>
                                            <td>:</td>
                                            <td>{{$p->pcie}}</td>
                                        </tr>
                                        <tr>
                                            <td>Storage</td>
                                            <td>:</td>
                                            <td>{{$p->storage}}</td>
                                        </tr>
                                        <tr>
                                            <td>Networking</td>
                                            <td>:</td>
                                            <td>{{$p->net}}</td>
                                        </tr>
                                        <tr>
                                            <td>I/O Ports</td>
                                            <td>:</td>
                                            <td>{{$p->io}}</td>
                                        </tr>
                                        <tr>
                                            <td>Advanced Technology</td>
                                            <td>:</td>
                                            <td>{{$p->advanced}}</td>
                                        </tr>
                                        <tr>
                                            <td>Security & Reliability</td>
                                            <td>:</td>
                                            <td>{{$p->security}}</td>
                                        </tr>
                                        <tr>
                                            <td>Form Factor</td>
                                            <td>:</td>
                                            <td>{{$p->ffactor}}</td>
                                        </tr>
                                        <tr>
                                            <td>Drive Bay</td>
                                            <td>:</td>
                                            <td>{{$p->dbay}}</td>
                                        </tr>
                                        <tr>
                                            <td>Front Panel</td>
                                            <td>:</td>
                                            <td>{{$p->fpanel}}</td>
                                        </tr>
                                    </table>
                            </div>
                        </div>
                    </div>
                    <!-- card body -->
                    <div class="card-footer">

                    </div>
                    @endforeach
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
        $('.btn-userdel').click(function(e) {
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
        $('#usertable').DataTable({
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