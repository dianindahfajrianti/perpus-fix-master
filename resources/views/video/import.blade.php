<!DOCTYPE html>
@extends('/admin/body')
@section('title', 'Admin - Import Video')
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
                <h3 class="display-4">Import Video</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                    <li class="breadcrumb-item"><a href="/admin/video">Video</a></li>
                    <li class="breadcrumb-item">Import Video</li>
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
                        <h3 class="card-title">Import Video</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body">
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="ct-file">Video File</label>
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input name="file" type="file" class="custom-file-input" value="{{old('file')}}" id="ct-file" accept="video/*" multiple>
                                            <label class="custom-file-label" for="ct-file" aria-describedby="ct-file-desc">Choose Multi Video</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="ct-file-desc">Upload</span>
                                        </div>
                                    </div>
                                    <div id="totalFiles">Total : <span class="totalFiles"></span> File(s) </div>
                                </div>
                                
                                <div class="form-group">
                                    {{-- <a href="" class="form-control" id="your-file"></a> --}}
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%" id="pb_total"></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <ul class="list-group" id="list-file">
                                        <li class="list-group-item">
                                            <div class="row justify-content-center align-items-center text-center text-bold">
                                                <div class="col-7">File Name</div>
                                                <div class="col-2">Size</div>
                                                <div class="col-3">Progress</div>
                                            </div>
                                        </li>
                                    </ul>
                                    <ul class="list-group" id="list-file">
                                        
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <a href="/admin/video-excel" id="save-file" class="btn btn-dark">Save</a>
                    </div>
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
<script src="/assets/js/resumable/resumable.js"></script>
<!-- Page specific script -->
<script type="text/javascript">
    $(document).ready(function() {
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
        bsCustomFileInput.init();

        // $('#your-file').hide();
        $('#list-file').hide();
        $('#totalFiles').hide();
        $('#save-file').addClass('disabled');

        var totalFiles = 0;
        var counter = 0;
        let browseFile = $('#ct-file');
        browseFile.on('change',function(e){
            e.preventDefault();
            var file = $(this)[0].files;
            totalFiles = file.length;
            // console.log(totalFiles);
        });
        
        let resumable = new Resumable({
        target: '/admin/video/mass'
        , chunkSize: 10*1024*1024 // default is 1*1024*1024, this should be less than your maximum limit in php.ini
        , query: {
            _token: '{{ csrf_token() }}',
        } // CSRF token
        , fileType: ['mp4','webm','ogm']
        , headers: {
            'Accept': 'application/json'
        }
        , testChunks: false
        , throttleProgressCallbacks: 1
        , });
        var uploaded = 0;
        var total_filesize = 0;
        resumable.assignBrowse(browseFile);
        var files;

        resumable.on('fileAdded', function(file, event) { // trigger when file picked
            total_filesize += file.size;
            $('.totalFiles').text(totalFiles);
            $('#totalFiles').show();
            
            let fsize = file.size / 1000000;
            // let fsize = file.size;
            // if (fsize / 1024 > 1)
            // {
            //     if (((fsize / 1024) / 1024) > 1)
            //     {
            //         fsize = (Math.round(((fsize / 1024) / 1024) * 100) / 100);
            //         var actual_fileSize = fsize + " GB";
            //     }
            //     else
            //     {
            //         fsize = (Math.round((fsize / 1024) * 100) / 100)
            //         var actual_fileSize = fsize + " MB";
            //     }
            // }
            // else
            // {
            //     fsize = (Math.round(fsize * 100) / 100)
            //     var actual_fileSize = fsize  + " KB";
            // }

            // console.log('Total File Size : ', total_filesize)
            // alert(fsize);
            let fname = file.fileName;
            // console.log('filename : ',fname);
            console.log(file);
            let list = $('#list-file');
            
            let li = '<li class="list-group-item"><div class="row justify-content-center align-items-center"><div class="col-7">'+fname+'</div><div class="col-2 text-center">'+fsize+' KB</div><div class="col-3"><div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%" id="pb'+file.uniqueIdentifier+'"></div></div></div></div></li>';
            list.show();
            list.append(li);
            // $('#fname').text(fname);
            // $('.fsize').text(fsize);
            showProgress();
            resumable.upload() // to actually start uploading.
        });
        
        resumable.on('fileProgress', function(file) { // trigger when file progress update
            files = resumable.files.length;
            
            // if(files > 1){
            //     updateProgress(Math.floor((file.progress() * 100) / files));
            // }else{
                // console.log('progress ',file.progress()*100)
                
                let progress = $('#pb'+file.uniqueIdentifier);
                let value = Math.floor(file.progress() * 100);
                pb_uploaded = Math.floor((uploaded / total_filesize )*100);
                // console.log(value);
                // $('#test'+file.uniqueIdentifier).text(value);
                $('#pb'+file.uniqueIdentifier).css('width', `${value}%`);
                $('#pb'+file.uniqueIdentifier).html(`${value}%`);
                // console.log('Uploaded before ',file)
                // uploaded = uploaded + file.chunks[0].loaded;
                //     // console.log('File Chunk',file);
                // console.log('Uploaded :',uploaded, ' of ', total_filesize);
                // console.log('pb Uploaded : ', pb_uploaded );
                console.log("File proggress var : "+file.progress());
                // let tp = Math.floor((file.progress() + ) * 100);

                // updateProgress(tp);
            // }
        });

        resumable.on('fileSuccess', function(file, response) { // trigger when file upload complete
            response = JSON.parse(response)
            // $('#your-file').attr('href', response.path);
            // $('#your-file').text(response.filename);
            // $('#your-file').show();
            counter++;

            // console.log(total_filesize);
            // uploaded += file.size;
            //     console.log('File Chunk',file);
            //     pb_uploaded = (uploaded / total_filesize);
            uploaded += file.size;
            // console.log(file);
            pb_uploaded = (uploaded / total_filesize)*100;
            // console.log('Uploaded :',uploaded);
            // console.log('pb uploaded : ',pb_uploaded);
            $('#pb_total').css('width', `${pb_uploaded}%`);
            $('#pb_total').html(`${pb_uploaded}%`);

            if (counter == totalFiles) {
                $('#save-file').removeClass('disabled');
            }
            // console.log(counter);
        });
        // resumable.on('complete',()=>{
        //     $('#save-file').removeClass('disabled');
        // })

        resumable.on('fileError', function(file, response) { // trigger when there is any error
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: response,
                timer: 1800
            });
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