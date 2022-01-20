<!DOCTYPE html>
@extends('/admin/body')
@section('title', 'Buku - Admin Perpus')
@section('ext-css')
<!-- Select2 -->
<link rel="stylesheet" href="/assets/adminlte/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="/assets/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<link rel="stylesheet" href="/assets/css/admin.css">

@endsection
@section('container')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="display-4">Daftar buku</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item active">Buku</li>
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
                        <button data-target="#modal-add" data-toggle="modal" class="btn btn-dark">Tambah buku</button>
                    </div>
                    <div class="card-body">
                        <table id="tb-book" class="table table-bordered table-striped">
                            <thead>
                                <th>No</th>
                                <th>Judul Buku</th>
                                <th>Deskripsi</th>
                                <th>Jml Dilihat</th>
                                <th>Tahun Terbit</th>
                                <th>Penerbit</th>
                                <th>Pengarang</th>
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
                <form id="fdata" action="{{route('buku.store')}}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h1>Tambah buku</h1>
                    </div>
                    <div class="modal-body">
                        <p class="text-red">*) Pastikan seluruh data terisi</p>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-toggle="tab" href="#tab1" role="tab" aria-controls="file" aria-selected="true">File</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-toggle="tab" href="#tab2" role="tab" aria-controls="sekolah" aria-selected="false">Sekolah</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-toggle="tab" href="#tab3" role="tab" aria-controls="buku" aria-selected="false">Buku</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="filebook">Upload File</label>
                                            <input type="file" name="filebook" id="filebook" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2">
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="jenjang">Jenjang</label>
                                            <div class="input-group">
                                                <select class="form-control select2bs4" id="jenjang" aria-label="Example select with button addon">
                                                    <option selected>-- Pilih Jenjang --</option>
                                                    <option value="1">SD</option>
                                                    <option value="2">SMP</option>
                                                    <option value="3">SMA</option>
                                                    <option value="3">SMK</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group mt-3">
                                            <label class="form-label" for="kelas">Kelas</label>
                                            <div class="input-group">
                                                <select class="form-control select2bs4" id="kelas" aria-label="Example select with button addon">
                                                    <option selected>-- Pilih Kelas --</option>
                                                    <option value="1">I</option>
                                                    <option value="2">II</option>
                                                    <option value="3">III</option>
                                                    <option value="4">IV</option>
                                                    <option value="5">V</option>
                                                    <option value="6">VI</option>
                                                    <option value="7">VII</option>
                                                    <option value="8">VIII</option>
                                                    <option value="9">IX</option>
                                                    <option value="10">X</option>
                                                    <option value="11">XI</option>
                                                    <option value="12">XII</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                    <div class="form-group mt-3">
                                            <label class="form-label" for="jurusan">Jurusan</label>
                                            <div class="input-group">
                                                <select class="form-control select2bs4" id="jurusan" aria-label="Example select with button addon">
                                                    <option selected>-- Pilih Jurusan --</option>
                                                    <option value="1">IPA</option>
                                                    <option value="2">IPS</option>
                                                    <option value="3">TKJ</option>
                                                    <option value="4">Tata Boga</option>
                                                    <option value="5">Perhotelan</option>
                                                    <option value="6">Akuntansi</option>
                                                    <option value="7">Hukum</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                    <div class="form-group mt-3">
                                            <label class="form-label" for="mapel">Mata Pelajaran</label>
                                            <div class="input-group">
                                                <select class="form-control select2bs4" id="mapel" aria-label="Example select with button addon">
                                                    <option selected>-- Pilih Mata Pelajaran --</option>
                                                    <option value="1">Bahasa Indonesia</option>
                                                    <option value="2">Bahasa Inggris</option>
                                                    <option value="3">Matematika</option>
                                                    <option value="4">Seni Budaya</option>
                                                    <option value="5">PJOK</option>
                                                    <option value="6">Agama</option>
                                                    <option value="7">Fisika</option>
                                                    <option value="8">Kimia</option>
                                                    <option value="9">Ekonomi</option>
                                                    <option value="10">Sejarah</option>
                                                    <option value="11">Astronomi</option>
                                                    <option value="12">Biologi</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab3" role="tabpanel" aria-labelledby="tab3">
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="judul">Judul Buku</label>
                                            <input type="text" name="title" id="judul" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="desc">Deskripsi</label>
                                            <input type="text" name="title" id="desc" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="jml">Jml Dilihat</label>
                                            <input type="text" name="title" id="jml" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="tahun">Tahun Terbit</label>
                                            <input type="text" name="title" id="tahun" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="penerbit">Penerbit</label>
                                            <input type="text" name="title" id="penerbit" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="pengarang">Pengarang</label>
                                            <input type="text" name="title" id="pengarang" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="form-group">
                            <label for="book_name">Nama buku</label>
                            <input type="text" name="book_name" id="book_name" class="form-control @error('book_name'){{'is-invalid'}}@enderror" placeholder="Document Name" value="{{old('book_name')}}">
                            @error('book_name')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div> -->
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button id="save-book" class="btn btn-secondary">Tambah</button>
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

<!--Javascript Admin -->
<script src="/assets/js/admin.js"></script>

<!-- Page specific script -->
<script>
    $(document).ready(function() {
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
        bsCustomFileInput.init();

        var table = $('#tb-book').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "columns": [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: "title",
                    name: "title"
                },
                {
                    data: "desc",
                    name: "desc"
                },
                {
                    data: "clicked_time",
                    name: "clicked_time"
                },
                {
                    data: "published_year",
                    name: "published_year"
                },
                {
                    data: "publisher",
                    name: "publisher"
                },
                {
                    data: "author",
                    name: "author"
                },
                {
                    defaultContent: '<a type="button" class="edit-book btn btn-success"><i class="fas fa-edit"></i></a>',
                    orderable: false,
                    searchable: false
                }
            ],
            "ajax": "/buku/all"
        });

        $.ajax({
            type: "get",
            url: "/buku/all",
            dataType: "json",
            success: function(d) {
                console.log(d);
                // alert(d);
            },
            error: function(d) {
                console.log(d);
                // alert(d);
            }
        });

        // $('#save-book').click(function(e){
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
@error('book_name')
<script type="text/javascript">
    $(document).ready(function() {
        $('#modal-add').modal('show');
    });
</script>
@enderror
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
@if (session('error'))
<script>
    $(document).ready(function(e) {
        e.preventDefault;
        Swal.fire({
            icon: 'error',
            title: 'Failed',
            text: "{{session('error')}}",
            timer: 1700
        });
    })
</script>
@endif
@endsection