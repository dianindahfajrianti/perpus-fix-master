<!DOCTYPE html>
@extends('/admin/body')
@section('title', 'Sekolah - Admin Perpus')
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
                <h3 class="display-4">Daftar sekolah</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item active">Sekolah</li>
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
                        <button data-target="#modal-add" data-toggle="modal" class="btn btn-dark">Tambah sekolah</button>
                    </div>
                    <div class="card-body">
                        <table id="tb-school" class="table table-bordered table-striped">
                            <thead>
                                <th>No</th>
                                <th>Nama Sekolah</th>
                                <th>Jenjang</th>
                                <th>Alamat</th>
                                <th>Nomor Telephone</th>
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
                <form id="fdata" action="{{route('sekolah.store')}}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h1>Tambah sekolah</h1>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama Sekolah</label>
                            <input type="text" name="nama" id="nama" class="form-control @error('nama'){{'is-invalid'}}@enderror" value="{{old('nama')}}">
                            @error('nama')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
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
                        <div class="form-group">
                            <label class="form-label" for="alamat">Alamat</label>
                            <textarea type="text" name="alamat" id="alamat" class="form-control @error('alamat') {{'is-invalid'}} @enderror" placeholder="Alamat Lengkap Sekolah">{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="notelp">Nomor Telephone</label>
                            <input type="tel" name="notelp" id="notelp" class="form-control @error('notelp') {{'is-invalid'}} @enderror" value="{{ old('notelp') }}">
                            @error('notelp')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button id="save-school" class="btn btn-secondary">Tambah</button>
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

        var table = $('#tb-school').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "processing": true,
            "serverSide":true,
            "ajax" : "/sekolah/all",
            "columns": [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: "sch_name",
                    name: "sch_name"
                },
                {
                    data: "has_edu.edu_name",
                    name: "has_edu.edu_name",
                    searchable: false
                },
                {
                    data: "address",
                    name: "address"
                },
                {
                    data: "phone",
                    name: "phone"
                },
                {
                    defaultContent:'<button type="button" class="edit-school btn btn-success"><i class="fas fa-edit"></i></button> <button type="button" class="d-inline del-school btn btn-danger"><i class="fas fa-trash"></i></button>'
                }
            ]
        });
        
        $('#tb-school tbody').on('click','.edit-school',function(e){
            e.preventDefault;
            var id = $(this).closest('tr').attr('id');
            window.location.href = "sekolah/"+id+"/edit";
        });
        $('#tb-school tbody').on('click','.del-school',function(e){
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
                        type:"delete",
                        url:"/admin/sekolah/"+id,
                        data:{
                            _token: "{{ csrf_token() }}",
                        },
                        success:function(data){
                            Swal.fire({
                            icon: data.status,
                            title: "Berhasil",
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