@extends('layouts.main')
@section('ext-css')
    <link rel="stylesheet" href="/assets/adminlte/plugins/sweetalert2/sweetalert2.css">
@endsection
@section('container')
    <!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">

    <div class="container">
        <div class="row">
            <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
                <h1>Selamat Datang di Perpustakaan Online</h1>
                <h2>Bergabunglah untuk membaca buku dan melihat video lebih banyak untuk mempelajari materi</h2>
                <div class="justify-content-center justify-content-lg-start">
                    <div class="row">
                        <div class="col-8">
                            <div class="search-form">
                                <form action="/search">
                                    <input type="text" placeholder="Cari judul..." name="search" value="{{ request('search') }}">
                                    <button type="submit"><i class="bi bi-search"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                <img src="/assets/perpus/assets/img/img-book.png" class="img-fluid animated" alt="">
            </div>
            {{-- <div class="col-lg-6 order-1 order-lg-2">
                <center>
                    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                    <lottie-player src="https://assets10.lottiefiles.com/packages/lf20_Q895iE.json"  background="transparent"  speed="1"  style="width: 500px; height: 500px;"  loop  autoplay></lottie-player>
                </center>
            </div> --}}
        </div>
    </div>

</section><!-- End Hero -->
<main id="main">
    <section class="jenjang">
        <form action="/tiket" method="post" class="form" enctype="multipart/form-data">
            <div class="row justify-content-center">
                <div class="col-6 cl">
                    <div class="form-group my-3">
                        <input name="file" class="form-control" type="file" id="FileUpload" accept=".pdf,.doc,.docx"/>
                    </div>
                    <div class="form-group my-3">
                        {{-- <a href="" class="form-control" id="your-file"></a> --}}
                        {{-- <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-6">
                    <button class="btn btn-dark" type="submit">Show</button>
                </div>
            </div>
        </form>
        <div class="row justify-content-center">
            <div class="col-12">
                {{-- <table class="table table-striped" id="tbtemp">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama File</th>
                            <th></th>
                        </tr>
                    </thead>
                </table> --}}
            </div>
            <div class="col-6">
                
            </div>
        </div>
    </section>
</main>
@endsection
@section('ext-js')
<script src="/assets/adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="/assets/js/resumable/resumable.js"></script>
<!-- SweetAlert2 -->
<script src="/assets/adminlte/plugins/sweetalert2/sweetalert2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        let browseFile = $('#FileUpload');

        var wd = window.screen.width;
        var hg = window.screen.height;

        console.log(wd);
        console.log(hg);
        let fg = '<div class="form-group fg1"></div>';
        let fg2 = '<div class="form-group fg2"></div>';
        let fw = '<input hidden type="number" min=0 name="width" value="'+wd+'" />';
        let fh = '<input hidden type="number" min=0 name="height" value="'+hg+'" />';
        $('.cl').append(fg);
        $('.fg1').append(fw);
        $('.cl').append(fg2);
        $('.fg2').append(fh);

        // let resumable = new Resumable({
        // target: '/admin/buku/'
        // , chunkSize: 10*1024*1024 // default is 1*1024*1024, this should be less than your maximum limit in php.ini
        // , query: {
        //     _token: '{{ csrf_token() }}',
        // } // CSRF token
        // , fileType: ['pdf','doc','docx']
        // , headers: {
        //     'Accept': 'application/json'
        // }
        // , testChunks: false
        // , throttleProgressCallbacks: 1
        // , });
        
        // resumable.assignBrowse(browseFile);

        // resumable.on('fileAdded', function(file, event) { // trigger when file picked
        //     showProgress();
        //     // let fSize = file.size / 1000000;
        //     resumable.upload() // to actually start uploading.
        // });
        
        // resumable.on('fileProgress', function(file) { // trigger when file progress update
        // updateProgress(Math.floor(file.progress() * 100));
        // });

        // resumable.on('fileSuccess', function(file, response) { // trigger when file upload complete
        //     response = JSON.parse(response);
        //     filename = response.filename;
        //     ext = response.extension
        //     $("#btnExtract").show();
        // });

        // resumable.on('fileError', function(file, response) { // trigger when there is any error
        //     Swal.fire({
        //         icon: 'error',
        //         title: 'Error',
        //         text: response,
        //         timer: 1800
        //     });
        // });

        // let progress = $('.progress');

        // function showProgress() {
        //     progress.find('.progress-bar').css('width', '0%');
        //     progress.find('.progress-bar').html('0%');
        //     progress.find('.progress-bar').removeClass('bg-success');
        //     progress.show();
        // }

        // function updateProgress(value) {
        //     progress.find('.progress-bar').css('width', `${value}%`)
        //     progress.find('.progress-bar').html(`${value}%`)
        // }

        // function hideProgress() {
        //     progress.hide();
        // }


        // $("#btnExtract").on('click', function (e) {
        //     e.preventDefault();
        //     $.ajax({
        //         type: "post",
        //         url: "/extract",
        //         data: {
        //             _token:"{{ csrf_token() }}",
        //             type: "pdf",
        //             filename: filename,
        //             ext: ext
        //         },
        //         dataType: "json",
        //         success: function (data) {
        //             $("#btnNext").show();
        //             $("#btnNext").attr('href',data.url);

        //             Swal.fire({
        //                 icon: data.status,
        //                 title: data.title,
        //                 text: data.message,
        //                 timer: 1800
        //             });
        //         },
        //         error:function (data) {
        //             Swal.fire({
        //                 icon: data.status,
        //                 title: data.title,
        //                 text: data.message,
        //                 timer: 1800
        //             });
        //         }
        //     });
        // });
    });
</script>
@if (session('error'))
<script type="text/javascript">
    $(document).ready(function () {
        var data = '<?= session("error") ?>';
        var js = JSON.parse(data);
        console.log(data);
        Swal.fire({
            icon: js.status,
            title: js.title,
            text: js.message,
            timer: 2000
        });
    });
</script>
@endif
@endsection