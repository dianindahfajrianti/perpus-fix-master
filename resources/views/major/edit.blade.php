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
                <h3 class="display-4">Edit Jurusan</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item"><a href="/admin/jurusan">Jurusan</a></li>
                    <li class="breadcrumb-item">Edit Jurusan</li>
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
                        <h3 class="card-title">Edit Jurusan</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{ route("jurusan.update",$jurusan->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="card-body">
                            <div class="form-group mt-3">
                                <label class="form-label" for="jenjang">Jenjang</label>
                                <div class="input-group">
                                    <select name="jenjang" class="form-control select2bs4 @error('jurusan'){{ 'is-invalid' }}@enderror" id="jenjang" aria-label="">
                                        <option value="">-- Pilih Jenjang --</option>
                                        @foreach ($edu as $e )
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
                                <label for="jurusan">Nama Jurusan</label>
                                <input type="text" name="jurusan" id="jurusan" class="form-control @error('jurusan'){{'is-invalid'}}@enderror" placeholder="Document Name" value="{{ old('jurusan',$jurusan->maj_name) }}">
                                @error('jurusan')
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
