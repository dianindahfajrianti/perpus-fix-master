<!DOCTYPE html>
@extends('/admin/body')
@section('title', 'User - Admin Perpus')
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
                        <button data-target="#modal-add" data-toggle="modal" class="btn btn-dark">Tambah user</button>
                    </div>
                    <div class="card-body">
                        <table id="tb-user" class="table table-bordered table-striped">
                            <thead>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Username</th>
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
    <div class="modal fade show" aria-modal="true" id="modal-add" aria-hidden="false" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form id="fdata" action="{{route('user.store')}}" method="POST">
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
                        <div class="form-group">
                            <label class="form-label" for="sekolah">Sekolah</label>
                            <div class="input-group">
                                <select name="sekolah" class="form-control select2bs4 @error('sekolah'){{ 'is-invalid' }}@enderror"" id="sekolah" aria-label="">
                                    <option value="">-- Pilih Sekolah --</option>
                                    @foreach ($sch as $s )
                                    <option value="{{ $s->id }}">{{ $s->sch_name }}</option>
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
                            <label class="form-label" for="jenjang">Jenjang</label>
                            <div class="input-group">
                                <select name="jenjang" class="form-control select2bs4 @error('jenjang'){{ 'is-invalid' }}@enderror"" id="jenjang" aria-label="">
                                    <option value="">-- Pilih Jenjang --</option>
                                    @foreach ($edu as $e )
                                    <option value="{{ $e->id }}">{{ $e->edu_name }}</option>
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
                            <label class="form-label" for="kelas">Kelas</label>
                            <div class="input-group">
                                <select name="kelas" class="form-control select2bs4 @error('kelas'){{ 'is-invalid' }}@enderror" id="kelas" aria-label="">
                                    <option value="">-- Pilih Kelas --</option>
                                    @for ($i = 1; $i < 13; $i++) <option value="{{ $i }}">{{ numberToRomanRepresentation($i) }}</option>
                                        @endfor
                                </select>
                                @error('kelas')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label class="form-label" for="role">Role</label>
                            <div class="input-group">
                                <select class="form-control select2bs4 @error('role'){{ 'is-invalid' }}@enderror"" id="role" aria-label="">
                                    <option selected>-- Pilih Role --</option>
                                    @php
                                    $rl = [
                                    'Super Admin',
                                    'Admin Sekolah',
                                    'Guru',
                                    'Murid'
                                    ];
                                    @endphp
                                    @for($i = 0; $i < count($rl); $i++) <option value="{{ $i }}">{{ $rl[$i] }}</option>
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
                defaultContent: '<button type="button" class="d-inline v-user btn btn-info"><i class="fas fa-eye"></i></button> <button type="button" class="edit-user btn btn-success"><i class="fas fa-edit"></i></button> <button type="button" class="d-inline del-user btn btn-danger"><i class="fas fa-trash"></i></button>'
            }],
            "ajax": "/user/all"
        });
        $('#tb-user tbody').on('click', '.edit-user', function(e) {
            e.preventDefault;
            var id = $(this).closest('tr').attr('id');
            window.location.href = "user/" + id + "/edit";
        });
        $('#tb-user tbody').on('click', '.v-user', function(e) {
            e.preventDefault;
            var id = $(this).closest('tr').attr('id');
            window.location.href = "user/" + id;
        });
        $('#tb-user tbody').on('click', '.del-user', function(e) {
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
                        type: "delete"
                        , url: "/admin/user/" + id
                        , data: {
                            _token: "{{ csrf_token() }}"
                        , }
                        , success: function(data) {
                            Swal.fire({
                                icon: data.status,
                                title: "Berhasil",
                                text: data.message,
                                timer: 1200
                            })
                        }
                        , error: function(data) {
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
<script type="text/javascript">
    $(document).ready(function() {
        @if(count($errors) > 0) {
            $('#modal-add').modal('show');
        }
        @endif
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