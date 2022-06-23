<!DOCTYPE html>
@extends('/admin/body')
@section('title', 'Admin - Import Buku')
@section('ext-css')
<!-- Select2 -->
<link rel="stylesheet" href="/assets/adminlte/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="/assets/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<link rel="stylesheet" href="/assets/css/admin.css">
{{-- TimePicker --}}
<link rel="stylesheet" href="/assets/adminlte/plugins/timepicker/jquery.timepicker.min.css">
@endsection
@section('container')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="display-4">Import Buku</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item"><a href="/admin/buku">Buku</a></li>
                    <li class="breadcrumb-item">Import Buku</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
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
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="card card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Import Buku</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="/admin/buku" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="ct-file">Buku File</label>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input name="file" type="file" class="custom-file-input" value="{{old('file')}}" id="ct-file" accept=".pdf,.doc,.docx" multiple>
                                        <label class="custom-file-label" for="ct-file" aria-describedby="ct-file-desc">Choose Multi Buku</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="ct-file-desc">Upload</span>
                                    </div>
                                </div>
                                @error('file')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <a href="" id="your-file"></a>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- card-->
                <a href="/admin/buku" type="button" class="btn btn-dark">Save</a>

            </div>
        </div>
    </div>
</section>
@endsection
@section('ext-script')
<!-- bs-custom-file-input -->
<script src="/assets/adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="/assets/adminlte/plugins/select2/js/select2.min.js"></script>
<script src="/assets/adminlte/plugins/timepicker/jquery.timepicker.min.js"></script>
<!-- Page specific script -->
<script>
    $(document).ready(function() {
        $('#your-file').hide();
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
        bsCustomFileInput.init();

        //Customize timepicker.js
        $('#frame').timepicker({
            timeFormat: 'HH:mm:ss',
            maxHour: 2,
            dynamic: true,
            dropdown: true,
            scrollbar: true
        });

        let browseFile = $('#ct-file');
        let resumable = new Resumable({
<<<<<<< Updated upstream
        target: '/admin/buku-import'
        , chunkSize: 10*1024*1024
        , query: {
            _token: '{{ csrf_token() }}',
        }
        , fileType: ['.pdf','.doc','docx']
=======
        target: '/admin/driver/'+{{$driver->id}}+'/updateFile'
        , chunkSize: 10*1024*1024 // default is 1*1024*1024, this should be less than your maximum limit in php.ini
        , query: {
            _token: '{{ csrf_token() }}',
        } // CSRF token
        , fileType: ['iso','zip']
>>>>>>> Stashed changes
        , headers: {
            'Accept': 'application/json'
        }
        , testChunks: false
        , throttleProgressCallbacks: 1
        , });
        
        resumable.assignBrowse(browseFile);

        resumable.on('fileAdded', function(file, event) {
            showProgress();
            // let fSize = file.size / 1000000;
            resumable.upload()
        });
        
        resumable.on('fileProgress', function(file) {
        updateProgress(Math.floor(file.progress() * 100));
        });

        resumable.on('fileSuccess', function(file, response) {
            response = JSON.parse(response)
            $('#your-file').attr('href', response.path);
            $('#your-file').text(response.filename);
            $('#your-file').show();
        });

        resumable.on('fileError', function(file, response) {
            alert('file uploading error.')
        });


        let progress = $('.progress');

        function showProgress() {
            progress.find('.progress-bar').css('width', '0%');
            progress.find('.progress-bar').html('0%');
            progress.find('.progress-bar').removeClass('bg-success');
            progress.show();
        }

        function updateProgress(value) {
            progress.find('.progress-bar').css('width', `${value}%`)
            progress.find('.progress-bar').html(`${value}%`)
        }

        function hideProgress() {
            progress.hide();
        }
    });

</script>
@endsection
