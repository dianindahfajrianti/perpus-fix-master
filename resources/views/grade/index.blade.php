<!DOCTYPE html>
@extends('/admin/body')
@section('title', 'Buku - Admin Perpus')
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
                <h3 class="display-4">Kelas</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item active">Kelas</li>
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
                        <button data-target="#modal-add" data-toggle="modal" class="btn btn-dark">Tambah Kelas</button>
                    </div>
                    <div class="card-body">
                        <table id="tb-grade" class="table table-bordered table-striped">
                            <thead>
                                <th>No</th>
                                <th>Jenjang</th>
                                <th>Kelas</th>
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
                <form id="fdata" action="{{route('buku.store')}}" method="POST">
                    @csrf
                    <div class="modal-header"><h1>Tambah Kelas</h1></div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label" for="txttile">Jenjang</label>
                            <input type="text" name="title" id="txttitle" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="grade_name">Kelas</label>
                            <input type="text" name="grade_name" id="grade_name" class="form-control @error('grade_name'){{'is-invalid'}}@enderror" value="{{old('grade_name')}}">
                            @error('grade_name')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button id="save-grade" class="btn btn-secondary">Tambah</button>
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

        var table = $('#tb-grade').DataTable({
            "paging": true
            , "lengthChange": false
            , "searching": true
            , "ordering": true
            , "info": true
            , "autoWidth": false
            , "responsive": true
            // , "processing": true
            // , "serverSide":true
            , "columns" : [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                {data: "title",name:"title"},
                {data: "desc",name:"desc"},
                {data: "clicked_time",name:"clicked_time"},
                {data: "published_year",name:"published_year"},
                {data: "publisher",name:"publisher"},
                {data: "author",name:"author"},
                {defaultContent: '<a type="button" class="edit-grade btn btn-success"><i class="fas fa-edit"></i></a>' , orderable: false, searchable: false }
            ]
            // ,"ajax" : "/buku/all"
        });

        $.ajax({
            type:"get",
            url:"/buku/all",
            dataType:"json",
            success:function(d){
                console.log(d);
                // alert(d);
            },error:function(d){
                console.log(d);
                // alert(d);
            }
        });

        // $('#save-grade').click(function(e){
        //     e.preventDefault;
        //     var fData = $('#fdata').serialize();
        //     console.log(fData);
        //     $.ajax({
        //         type : "post",
        //         url : "/admin/buku",
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

    });
</script>
@error('grade_name')
<script type="text/javascript">
$(document).ready(function(){
    $('#modal-add').modal('show');
});
</script>
@enderror
@if (session('success'))
<script>
    $(document).ready(function(e) {
        e.preventDefault;
        Swal.fire({
            icon: 'success'
            , title: 'Done'
            , text: "{{session('success')}}"
            , timer: 1700
        });
    })

</script>
@endif
@if (session('error'))
<script>
    $(document).ready(function(e) {
        e.preventDefault;
        Swal.fire({
            icon: 'error'
            , title: 'Failed'
            , text: "{{session('error')}}"
            , timer: 1700
        });
    })

</script>
@endif
@endsection
