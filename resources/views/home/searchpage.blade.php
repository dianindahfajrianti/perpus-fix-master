@extends('layouts.main')

@section('container')

<!-- ======= Search ======= -->
<section id="file" class="file">

    <div class="container" data-aos="fade-up">
        <br><br>
            <h4 class="title-home">Hasil Pencarian</h4>
            <div class="col-7">
                <div class="search-form">
                    <form action="/search">
                        <input type="text" placeholder="Cari judul..." name="search" value="{{ request('search') }}">
                        <button type="submit"><i class="bi bi-search"></i></button>
                    </form>
                </div>
            </div>

        <div class="row gy-4">
            @forelse($file as $f)
                @if ($f->filetype == 'pdf')
                    <div class="col-lg-2 col-md-3 col-sm-4 col-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="card">
                            <div class="card-img">
                                {{-- <center>
                                    <img src="/storage/thumb/pdf/@empty($f->thumb){{ 'default.png' }}@else{{ $f->thumb }}@endempty" class="img-fluid" alt="">
                                </center> --}}
                                <center>
                                    @php
                                    $name = $f->thumb;
                                    $ori = public_path("storage/thumb/pdf/");
                                    $path = "/storage/thumb/pdf/";
                                    $path1 = $ori.$name;
                                    if ( !file_exists($path1) || empty($name) ) {
                                        $path1 = $path."default.png";
                                    }else {
                                        $path1 = $path.$name;
                                    };
                                    @endphp
                                                                    
                                        <img src="{{ $path1 }}" class="img-fluid" alt="">
                                </center>
                                <div class="social">
                                    <a href="{{ Storage::url('public/pdf/').$f->filename }}"><i class="ri-file-download-fill"></i></a>
                                    <a href="@if($f->filetype == 'pdf'){{ '/pdfViewer/'.$f->id }}@else{{'/videoplayer/'.$f->id}}@endif"><i class="ri-eye-fill"></i></a>
                                </div>
                            </div>
                            <div class="card-info">
                                <h5>{{substr($f->title,0,16)."..."}}</h5>
                                <h6>
                                    @if(($f->getGrade || $f->getEdu) !== null)
                                    {{ "Kelas ".$f->getGrade->grade_name." ".$f->getEdu->edu_name}}
                                    @endif
                                </h6>
                                <div class="btn-file">
                                    <span>{{ strtoupper($f->filetype) }}</span>
                                </div>
                                <div class="stat-content">
                                    <a href="#">dilihat {{ $f->clicked_time }} kali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-lg-2 col-md-3 col-sm-4 col-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="card">
                            <div class="card-img">
                                {{-- <center>
                                    <img src="/storage/thumb/video/@empty($f->thumb){{ 'default.png' }}@else{{ $f->thumb }}@endempty" class="img-fluid" alt="">
                                </center> --}}
                                <center>
                                    @php
                                    $name = $f->thumb;
                                    $ori = public_path("storage/thumb/video/");
                                    $path = "/storage/thumb/video/";
                                    $path1 = $ori.$name;
                                    if ( !file_exists($path1) || empty($name) ) {
                                        $path1 = $path."default.png";
                                    }else {
                                        $path1 = $path.$name;
                                    };
                                    @endphp
                                                                    
                                        <img src="{{ $path1 }}" class="img-fluid" alt="">
                                </center>
                                <div class="social">
                                    <a href="{{ Storage::url('public/video/').$f->filename.".".$f->filetype }}"><i class="ri-video-download-fill"></i></a>
                                    <a href="@if($f->filetype == 'pdf'){{ '/pdfViewer/'.$f->id }}@else{{'/videoplayer/'.$f->id}}@endif"><i class="ri-eye-fill"></i></a>
                                </div>
                            </div>
                            <div class="card-info">
                                <h5>{{substr($f->title,0,16)."..."}}</h5>
                                <h6>
                                    @if(($f->getGrade || $f->getEdu) !== null)
                                    {{ "Kelas ".$f->getGrade->grade_name." ".$f->getEdu->edu_name}}
                                    @endif
                                </h6>
                                <div class="btn-file">
                                    <span>{{ strtoupper($f->filetype) }}</span>
                                </div>
                                <div class="stat-content">
                                    <a href="#">dilihat {{ $f->clicked_time }} kali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @empty
            <center>
                <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_mk6o3c37.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop  autoplay></lottie-player>
            </center>
                <div class="not-found">Tidak Ada File</div>
            @endforelse
            {{-- <a href="/file">
                <div class="btn-home justify-content-center d-grid col-lg-3 col-sm-6 col-10 mx-auto">
                    <a href="/video"><center>Lihat Video Lainnya</center></a>
                </div>
            </a> --}}
        </div>

    </div>

</section><!-- End Video Section -->

</main><!-- End #main -->

@endsection