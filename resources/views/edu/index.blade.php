<!DOCTYPE html>
@extends('/admin/body')
@section('title', 'Jenjang Pendidikan - Admin Perpus')
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
                <h3 class="display-4">Daftar Pendidikan</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item active">Pendidikan</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-12">
                <!-- general form elements -->
                <div class="card">
                    <div class="card-header">
                        <button data-target="#modal-add" data-toggle="modal" class="btn btn-dark">Tambah Jenjang</button>
                    </div>
                    <div class="card-body">
                        <table id="tb-edu" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Jenjang</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($edu as $e)
                                    <tr id="{{ $e->id }}">
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$e->edu_name}}</td>
                                        <td><a type="button" class="btn btn-success" href="{{ route('pendidikan.edit',$e->id) }}"><i class="fas fa-edit"></i></a> <a type="button" class="d-inline del-edu btn btn-danger"><i class="fas fa-trash"></i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade show" aria-modal="true" id="modal-add" aria-hidden="false" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form id="fdata" action="{{route('pendidikan.store')}}" method="POST">
                    @csrf
                    <div class="modal-header"><h1>Tambah Jenjang</h1></div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edu_name">Nama Jenjang</label>
                            <input type="text" name="edu_name" id="edu_name" class="form-control @error('edu_name'){{'is-invalid'}}@enderror" value="{{old('edu_name')}}">
                            @error('edu_name')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button id="save-edu" class="btn btn-secondary">Tambah</button>
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

        var table = $('#tb-edu').DataTable({
            "paging": true
            , "lengthChange": false
            , "searching": false
            , "ordering": true
            , "info": true
            , "autoWidth": false
            , "responsive": true
            // ,"processing": true
            // , "serverSide":true
            // ,"columnDefs":[
            //     {targets: 0, render: function ( data, type, full, meta ) {
            //         return  meta.row+1;
            //     }},
            //     {targets:1,
            //     render: function(data, type, full, meta) {
            //         return full.edu_name;
            //      },
            //     searchable:true},
            //     {targets: 2, render: function (data, type, full, meta) {
            //         return '<a type="button" class="btn btn-success" href="/admin/pendidikan/'+full.id+'/edit"><i class="fas fa-edit"></i></a>';
            //     }}
            // ], "columns" : [
            //     {"data": "id","name":"id"},
            //     {"data": "edu_name","name":"edu_name"}
            // ]
            // ,"ajax" : "/pendidikan/all"
        });
        
        // $.ajax({
        //     type:"get",
        //     url:"/pendidikan/all",
        //     dataType:"json",
        //     success:function(d){
        //         console.log(d);
        //         // alert(d);
        //     },error:function(d){
        //         console.log(d);
        //         // alert(d);
        //     }
        // });

        // $('#save-edu').click(function(e){
        //     e.preventDefault;
        //     var fData = $('#fdata').serialize();
        //     console.log(fData);
        //     $.ajax({
        //         type : "post",
        //         url : "/admin/pendidikan",
        //         dataType : "json",
        //         data : fData
        //         ,success:function(d){
        //             var uc = d.status;
        //             $('#modal-add').modal('hide');
        //             console.log(d);
        //             Swal.fire({
        //                 icon : d.status,
        //                 title : d.data,
        //                 text : d.message,
        //                 timer : 1650
        //             });
        //             table.draw();
        //         },error:function(d){
        //             var uc = d.responseJSON;
        //             console.log(uc);
        //             Swal.fire({
        //                 icon : 'error',
        //                 title : uc.exception,
        //                 text : uc.message,
        //                 timer : 1650
        //             });
        //         }
        //     });
        // });
        $('.del-edu').click(function(e) {
            e.preventDefault;
            var id = $(this).closest('tr').attr('id');
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
                    url: "/admin/pendidikan/"+id,
                    dataType: "json",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success:function(data){
                        // var js = data.responseJSON;
                        Swal.fire({
                            icon: data.status,
                            title: "Berhasil",
                            text: data.message,
                            timer: 1200
                        })
                        console.log(data);
                    },error:function(data){
                        var js = data.responseJSON;
                        Swal.fire({
                            icon: 'error',
                            title: js.exception,
                            text: js.message,
                            timer: 1200
                        });
                        console.log(data);
                    }

                });
            }
            });
        });
        
    });
</script>
@error('edu_name')
<script type="text/javascript">
$(document).ready(function(){
    $('#modal-add').modal('show');
});
</script>
@enderror
@if (session('success'))
<script type="text/javascript">
    $(document).ready(function(e) {
        e.preventDefault;
        var data = '<?= session("success") ?>';
        var js = JSON.parse(data);
        Swal.fire({
           icon: 'success'
            , title: 'Berhasil'
            , text: js.message
            , timer: 1700
        });
    });
</script>
@endif
@if (session('error'))
<script type="text/javascript">
    $(document).ready(function(e) {
        e.preventDefault;
        var data = "<?= session('error'); ?>";
        var js = JSON.parse(data);
        console.log(data);
        Swal.fire({
            icon: 'error'
            , title: 'Gagal'
            , text: js.message
            , timer: 1700
        });
    });
</script>
@endif
@endsection
