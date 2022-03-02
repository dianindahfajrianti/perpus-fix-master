@extends('layouts.main')

@section('container')
<!-- ======= Breadcrumbs ======= -->
<section class="breadcrumbs">
  <div class="container">

    <div class="d-flex justify-content-between align-items-center">
      <h2>Video</h2>
      <ol>
        <li><a href="/">Home</a></li>
        <li><a href="/file">Multimedia</a></li>
        <li>Video</li>
      </ol>
    </div>

  </div>
</section><!-- End Breadcrumbs -->

<!-- ======= Buku======= -->
<section id="file" class="file">

    <div class="container" data-aos="fade-up">
        <h4 class="title-home">Buku Terbaru</h4>

        <div class="row gy-4">

            @forelse($book as $b)
            <div class="col-lg-2 col-md-3 col-sm-4 col-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card">
                    <div class="card-img">
                        <center>
                            <img src="/assets/perpus/assets/img/coverbuku.png" class="img-fluid" alt="">
                        </center>
                        <div class="social">
                            <a href="#"><i class="ri-file-download-fill"></i></a>
                            <a href="/pdfViewer/{{ $b->id }}"><i class="ri-eye-fill"></i></a>
                        </div>
                    </div>
                    <div class="card-info">
                        <h5>{{substr($b->title,0,25)."..."}}</h5>
                        <h6>
                            @if(($b->getGrade || $b->getEdu) !== null)
                            {{ "Kelas ".$b->getGrade->grade_name." ".$b->getEdu->edu_name}}
                            @endif
                        </h6>
                        <div class="btn-file">
                            <span>@if($b->filetype == 'pdf')
                                {{ 'PDF' }}
                                @endif</span>
                        </div>
                        <div class="stat-content">
                            <a href="#">dilihat 120 kali</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-6 text-center"><b>Belum ada buku terbaru</b></div>
            @endforelse
            <a href="/file">
                <div class="d-grid gap-2 col-lg-3 col-6 mx-auto">
                    <a href="{{ url('file') }}" class="btn btn-outline-danger" type="button">Lihat Buku Lainnya</a>
                </div>
            </a>
        </div>
    </div>

</section><!-- End Buku Section -->

<!-- ======= Video ======= -->
<section id="file" class="file">

    <div class="container" data-aos="fade-up">
        <h4 class="title-home">Video Terbaru</h4>

        <div class="row gy-4">

            @for ($i=1; $i < 7; $i++) <div class="col-lg-2 col-md-3 col-sm-4 col-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card">
                    <div class="card-img">
                        <center>
                            <img src="/assets/perpus/assets/img/coverbuku.png" class="img-fluid" alt="">
                        </center>
                        <div class="social">
                            <a href="#"><i class="ri-video-download-fill"></i></a>
                            <a href="#"><i class="ri-eye-fill"></i></a>
                        </div>
                    </div>
                    <div class="card-info">
                        <h5>Matematika <br>Kelas 1 SMP</h5>
                        <div class="btn-file">
                            <span>Video</span>
                        </div>
                        <div class="stat-content">
                            <a href="#">dilihat 120 kali</a>
                        </div>
                    </div>
                </div>
        </div>
        @endfor

        <a href="/file">
            <div class="d-grid gap-2 col-lg-3 col-6 mx-auto">
                <button class="btn btn-outline-danger" type="button">Lihat Video Lainnya</button>
            </div>
        </a>

    </div>
    </div>

</section><!-- End Video Section -->



</main><!-- End #main -->

@endsection