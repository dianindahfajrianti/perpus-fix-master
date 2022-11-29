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
@section('csrf-ajax')
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                                <th>No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Sekolah</th>
                                <th>Role</th>
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
    @php
    function numberToRomanRepresentation($number) {
    $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
    $returnValue = '';
    while ($number > 0) {
    foreach ($map as $roman => $int) {
    if($number >= $int) {
    $number -= $int;
    $returnValue .= $roman;
    break;
    }
    }
    }
    return $returnValue;
    }
    @endphp
    <div class="modal fade" aria-modal="true" id="modal-add" aria-hidden="false" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form id="fdata" action="{{ route('user-store' )}}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h1>Tambah User</h1>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control @error('nama'){{'is-invalid'}}@enderror" value="{{old('nama')}}">
                            @error('nama')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control @error('username'){{'is-invalid'}}@enderror" value="{{old('username')}}">
                            @error('username')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="email">Email</label>
                            <input type="text" name="email" id="email" class="form-control @error('email'){{'is-invalid'}}@enderror" value="{{old('email')}}">
                            @error('email')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <select class="custom-select mb-3" name="maildisplay" id="id_maildisplay" data-initial-value="1">
                            <option value="0">Sembunyikan alamat email saya dari pengguna yang tidak diizinkan</option>
                            <option value="1" selected>Izinkan semua orang melihat alamat email saya</option>
                            <option value="2">Izinkan hanya peserta kursus yang melihat alamat email saya</option>
                        </select>
                        <div class="form-group">
                            <label class="form-label" for="sekolah">Sekolah</label>
                            <div class="input-group">
                                <select name="sekolah" class="form-control select2bs4 @error('sekolah'){{ 'is-invalid' }}@enderror" id="sekolah" aria-label="">
                                    <option value="">-- Pilih Sekolah --</option>
                                    @foreach ($sch as $s )
                                    <option @if(old('sekolah')==$s->id){{ 'selected' }}@endif value="{{ $s->id }}">{{ $s->sch_name }}</option>
                                    @endforeach
                                </select>
                                @error('sekolah')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="sekolah">Sekolah</label>
                            <div class="input-group">
                                <select name="sekolah" class="form-control select2bs4 @error('sekolah'){{ 'is-invalid' }}@enderror" id="sekolah" aria-label="">
                                    <option value="">-- Pilih Sekolah --</option>
                                    @foreach ($sch as $s )
                                    <option @if(old('sekolah')==$s->id){{ 'selected' }}@endif value="{{ $s->id }}">{{ $s->sch_name }}</option>
                                    @endforeach
                                </select>
                                @error('sekolah')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="kelas">Kelas</label>
                            <div class="input-group">
                                <select name="kelas" class="form-control select2bs4 @error('kelas'){{ 'is-invalid' }}@enderror" id="kelas" aria-label="">
                                    <option value="">-- Pilih Kelas --</option>
                                    {{-- @foreach ($grade as $k )
                                    <option @if(old('kelas')==$k->id){{ 'selected' }}@endif value="{{ $k->id }}">{{ $k->grade_name }}</option>
                                    @endforeach --}}
                                </select>
                                @error('kelas')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="sekolah">Jurusan</label>
                            <div class="input-group">
                                <select name="jurusan" class="form-control select2bs4 @error('jurusan'){{ 'is-invalid' }}@enderror" id="jurusan" aria-label="">
                                    <option value="">-- Pilih Jurusan --</option>
                                    {{-- @foreach ($maj as $m )
                                    <option @if(old('jurusan')==$m->id){{ 'selected' }}@endif value="{{ $m->id }}">{{ $m->maj_name }} - {{ $m->educations->edu_name }}</option>
                                    @endforeach --}}
                                </select>
                                @error('jurusan')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label class="form-label" for="role">Role</label>
                            <div class="input-group">
                                <select name="role" required class="form-control select2bs4 @error('role'){{ 'is-invalid' }}@enderror" id=" role" aria-label="">
                                    <option selected>-- Pilih Role --</option>
                                    @php
                                    $rl = [
                                    'Super Admin',
                                    'Admin Sekolah',
                                    'Guru',
                                    'Murid'
                                    ];
                                    @endphp
                                    @for($i = 0; $i < count($rl); $i++)
                                    {{-- <option @if (old('role') == $i) {{'selected'}}@endif value="{{ $i }}">{{ $rl[$i] }}</option> --}}
                                    <option value="{{ $i }}">{{ $rl[$i] }}</option>

                                    @endfor
                                </select>
                                @error('role')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button id="save-user" class="btn btn-secondary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" aria-modal="true" id="modal-import" aria-hidden="false" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header"><h2>Import User</h2></div>
                    <div class="modal-body">
                        <p class="text-red">*) Pastikan anda sudah melengkapi data jurusan dengan menginputnya dibagian menu<a class="text-red" href="/admin/jurusan"><u> jurusan</u></a></p>
                        <p>CONTOH IMPORT USER</p>
                        <img src="/assets/perpus/assets/img/contohuser.png" alt="" class="img-fluid">
                        <p></p>
                        <div class="form-group">
                            <label for="xcl">Excel File</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <label for="xcl" class="custom-file-label">Choose excel file</label>
                                    <input class="custom-file-input" type="file" name="xcl" id="xcl" accept=".xls,.xlsx">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-secondary">Tambah</button>
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

        var table = $('#tb-user').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "dom":'Blfrtip',
            "buttons": ['excel','pdf'],
            "autoWidth": false,
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "columns": [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            }, {
                data: "name",
                name: "name"
            }, {
                data: "username",
                name: "username"
            }, {
                data: "schools",
                name: "schools",
                render: function(data, type, full, mime) {
                    if (data == null) {
                        return "-";
                    }else{
                        console.log(data);
                        return data.sch_name;
                    }
                },
                orderable: false
            }, {
                data: "role",
                name: "role",
                render: function(data, type, full, mime) {
                    var rl = "";
                    if (data == 0) {
                        rl = "Super Admin";
                    } else if (data == 1) {
                        rl = "Admin Sekolah";
                    } else if (data == 2) {
                        rl = "Admin Guru";
                    } else {
                        rl = "Murid";
                    }
                    return rl;
                }
            }, {
                data: 'DT_RowId',
                    render: function (data) { 
                        return '<button data-id="'+data+'" class="d-inline v-user btn btn-info"><i class="fas fa-eye"></i></button> <button data-id="'+data+'" type="button" class="edit-user btn btn-success"><i class="fas fa-edit"></i></button> <button data-id="'+data+'" type="button" class="d-inline del-user btn btn-danger"><i class="fas fa-trash"></i></button>';
                    },
                    searchable:false
            }],
            "ajax": "/user/all"
        });
        $('#tb-user tbody').on('click', '.edit-user', function(e) {
            e.preventDefault;
            var id = $(this).attr('data-id');
            window.location.href = "user/" + id + "/edit";
        });
        $('#tb-user tbody').on('click', '.v-user', function(e) {
            e.preventDefault;
            var id = $(this).attr('data-id');
            window.location.href = "user/" + id;
        });
        $('#tb-user tbody').on('click', '.del-user', function(e) {
            e.preventDefault;
            var id = $(this).attr('data-id');
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
                        url: "/admin/user/" + id,
                        data: {
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(data) {
                            Swal.fire({
                                icon: data.status,
                                title: "Berhasil",
                                text: data.message,
                                timer: 1200
                            });
                            table.draw();
                        },
                        error: function(data) {
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

        var sekolahID = $('#sekolah').val();
        console.log(sekolahID);
        var url = "{{ Request :: segment(count(Request :: segments())) }}";
        var oldKelas = "{{ old('kelas') }}"
        var oldJurusan = "{{ old('jurusan') }}"
        
        if (oldKelas){
            $.ajax({
                url: '/sch/'+sekolahID,
                type: "GET",
                success:function(data){
                    console.log(data);
                    $('#kelas').empty();
                    $('#kelas').append('<option value="" hidden="">-- Pilih Kelas --</option>'); 
                    $.each(data, function(id, kelas){
                        if (oldKelas == kelas.id){
                            $('select[name="kelas"]').append('<option selected value="'+ kelas.id +'">' + kelas.grade_name+ '</option>');
                        }else{
                            $('select[name="kelas"]').append('<option value="'+ kelas.id +'">' + kelas.grade_name+ '</option>');
                        }
                        });
                    }
            });
            console.log(oldKelas);
        }
        if(oldJurusan){
            $.ajax({
                type: "get",
                url: "/maj/"+sekolahID+"?url="+url,
                success: function (data) {
                    $('#jurusan').empty();
                    $('#jurusan').append('<option value="" hidden>-- Pilih jurusan --</option>'); 
                    $.each(data, function(id, jurusan){
                        if (oldJurusan == jurusan.id){
                            $('select[name="jurusan"]').append('<option selected value="'+ jurusan.id +'">' + jurusan.maj_name + " - "+jurusan.educations.edu_name+ '</option>');
                        }else{
                            $('select[name="jurusan"]').append('<option value="'+ jurusan.id +'">' + jurusan.maj_name + " - "+jurusan.educations.edu_name+ '</option>');
                        }
                    });
                }
            });
        }

        $('#sekolah').on('change', function(e) {
            e.preventDefault();
            var sekolahID = $(this).val();
            console.log('Sekolah ID : ',sekolahID);
            var url = "{{ Request :: segment(count(Request :: segments())) }}";
            $.ajax({
                url: '/sch/'+sekolahID,
                type: "GET",
                success:function(data)
                {
                    console.log('Data Kelas :',data);
                    $('#kelas').empty();
                    $('#kelas').append('<option value="">-- Pilih Kelas --</option>'); 
                    $.each(data, function(id, kelas){
                        $('select[name="kelas"]').append('<option value="'+ kelas.id +'">' + kelas.grade_name+ '</option>');
                    });
                }
            });
            $.ajax({
                type: "get",
                url: "/maj/"+sekolahID+"?url="+url,
                success: function (data) {
                    $('#jurusan').empty();
                    $('#jurusan').append('<option value="" hidden>-- Pilih jurusan --</option>'); 
                    $.each(data, function(id, jurusan){
                        console.log('Data Jurusan : ',jurusan);
                        $('select[name="jurusan"]').append('<option value="'+ jurusan.id +'">' + jurusan.maj_name + " - "+jurusan.educations.edu_name+ '</option>');
                    });
                }
            });
        });

    });
</script>
@include('admin.validator')
@endsection