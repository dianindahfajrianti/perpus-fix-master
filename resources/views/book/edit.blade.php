<!DOCTYPE html>
@extends('/admin/body')
@section('title', 'Admin - Menu')
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
                <h3 class="display-4">Edit Buku</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item"><a href="/admin/buku">Buku</a></li>
                    <li class="breadcrumb-item">Edit Buku</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Edit Buku</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{route("buku.update",$book->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="card-body">
                            <div class="form-group">
                                <label class="form-label" for="filebook">Upload File</label>
                                <input type="file" name="filebook" id="filebook" class="form-control @error('filebook'){{'is-invalid'}}@enderror" value="{{ old('filebook', $book->filename) }}">
                                @error('filebook')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="jenjang">Jenjang</label>
                                <div class="input-group">
                                    <select class="form-control select2bs4 @error('jenjang'){{ 'is-invalid' }}@enderror"" id=" jenjang" aria-label="Example select with button addon">
                                        <option value="">-- Pilih Jenjang --</option>
                                        @foreach ($edu as $e)
                                        <option @if( old('jenjang', $book->edu_id) ==$e->id){{ 'selected' }} @endif value="{{ $e->id }}">{{ $e->edu_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('jenjang')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
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
                            <div class="form-group">
                                <label class="form-label" for="judul">Judul Buku</label>
                                <input type="text" name="judul" id="judul" class="form-control @error('judul'){{'is-invalid'}}@enderror" value="{{ old('judul', $book->title) }}">
                                @error('judul')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="desc">Deskripsi</label>
                                <input type="text" name="desc" id="desc" class="form-control @error('desc'){{'is-invalid'}}@enderror" value="{{ old('desc', $book->desc) }}">
                                @error('desc')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="tahun">Tahun Terbit</label>
                                <input type="text" name="tahun" id="tahun" class="form-control @error('tahun'){{'is-invalid'}}@enderror" value="{{ old('tahun', $book->published_year) }}">
                                @error('tahun')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="penerbit">Penerbit</label>
                                <input type="text" name="penerbit" id="penerbit" class="form-control @error('penerbit'){{'is-invalid'}}@enderror" value="{{ old('penerbit', $book->publisher) }}">
                                @error('penerbit')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="pengarang">Pengarang</label>
                                <input type="text" name="pengarang" id="pengarang" class="form-control @error('pengarang'){{'is-invalid'}}@enderror" value="{{ old('pengarang', $book->author) }}">
                                @error('pengarang')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-dark">Save</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
@section('ext-script')
<!-- bs-custom-file-input -->
<script src="/assets/adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="/assets/adminlte/plugins/select2/js/select2.min.js"></script>
<!-- Page specific script -->
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
        bsCustomFileInput.init();
    });
</script>
@endsection