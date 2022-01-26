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
        <div class="row justify-content-center">
            <div class="col-10">
                <!-- general form elements -->
                <div class="card">
                    <div class="card-header">
                        <button data-target="#modal-add" data-toggle="modal" class="btn btn-dark">Tambah buku</button>
                    </div>
                    <div class="card-body">
                        {{-- <div class="table-responsive"> --}}
                        <table id="tb-book" class="table table-bordered table-striped">
                            <thead>
                                <th>No</th>
                                <th>ID</th>
                                <th>Judul Buku</th>
                                <th>Tahun Terbit</th>
                                <th>Penerbit</th>
                                <th>Pengarang</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        {{-- </div> --}}
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
                        <p class="text-red">*) Pastikan seluruh input terisi</p>
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
                                            <input type="file" name="filebook" id="filebook" class="form-control @error('filebook'){{'is-invalid'}}@enderror" value="{{old('filebook')}}">
                                            @error('filebook')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
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
                                                <select class="form-control select2bs4 @error('jenjang'){{ 'is-invalid' }}@enderror"" id="jenjang" aria-label="Example select with button addon">
                                                    <option selected>-- Pilih Jenjang --</option>
                                                    <option value="1">SD</option>
                                                    <option value="2">SMP</option>
                                                    <option value="3">SMA</option>
                                                    <option value="3">SMK</option>
                                                </select>
                                                @error('jenjang')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
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
                                                @error('kelas')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
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
                                                @error('jurusan')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
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
                                                @error('mapel')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                                @enderror
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
                                            <input type="text" name="judul" id="judul" class="form-control @error('judul'){{'is-invalid'}}@enderror" value="{{old('judul')}}">
                                            @error('judul')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="desc">Deskripsi</label>
                                            <input type="text" name="desc" id="desc" class="form-control @error('desc'){{'is-invalid'}}@enderror" value="{{old('desc')}}">
                                            @error('desc')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="jml">Jml Dilihat</label>
                                            <input type="text" name="jml" id="jml" class="form-control @error('jml'){{'is-invalid'}}@enderror" value="{{old('jml')}}">
                                            @error('jml')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="tahun">Tahun Terbit</label>
                                            <input type="text" name="tahun" id="tahun" class="form-control @error('tahun'){{'is-invalid'}}@enderror" value="{{old('tahun')}}">
                                            @error('tahun')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="penerbit">Penerbit</label>
                                            <input type="text" name="penerbit" id="penerbit" class="form-control @error('penerbit'){{'is-invalid'}}@enderror" value="{{old('penerbit')}}">
                                            @error('penerbit')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label" for="pengarang">Pengarang</label>
                                            <input type="text" name="pengarang" id="pengarang" class="form-control @error('pengarang'){{'is-invalid'}}@enderror" value="{{old('pengarang')}}">
                                            @error('pengarang')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "columnDefs": [{
                targets: [1],
                visible: false,
                searchable: false
            }],
            "columns": [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    className: 'details-control',
                    responsivePriority: 1
                },
                {
                    data: "id",
                    name: "id",
                    orderable: false
                },
                {
                    data: "title",
                    name: "title"
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
                    defaultContent: '<button type="button" class="edit-book btn btn-success"><i class="fas fa-edit"></i></button> <button type="button" class="d-inline del-book btn btn-danger"><i class="fas fa-trash"></i></button>'
                }
            ],
            "ajax": "/buku/all"
        });
        $('#tb-book tbody').on('click', '.edit-book', function(e) {
            e.preventDefault;
            var id = $(this).closest('tr').attr('id');
            window.location.href = "buku/" + id + "/edit";
        });
        $('#tb-book tbody').on('click', '.del-book', function(e) {
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
                        url: "/admin/buku/" + id,
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success:function(data){
                            console.log(data);
                            Swal.fire({
                                icon: data.status,
                                title: data.title,
                                text: data.message,
                                timer: 1200
                            });
                            table.draw();
                        },
                        error:function(data){
                            console.log(data);
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