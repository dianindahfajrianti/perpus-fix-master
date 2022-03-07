@extends('layouts.main')

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
                                <form action="/buku">
                                    <input type="text" placeholder="Cari judul..." name="search" value="{{ request('search') }}">
                                    <button type="submit"><i class="bi bi-search"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                <img src="/assets/perpus/assets/img/hero-img.png" class="img-fluid animated" alt="">
            </div>
        </div>
    </div>

</section><!-- End Hero -->

<main id="main">
    <!-- ======= Jenjang Section ======= -->
    <section id="jenjang" class="jenjang">

        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-12 col-sm-6 cent" style>
                    <img class="mx-auto img img-responsive" src="/assets/perpus/assets/img/SD-img.png" alt="Responsive image" style="width: auto; margin-top: 10px;">
                    <h4>SD</h4>
                </div>
                <div class="col-lg-3 col-12 col-sm-6 cent" style>
                    <img class="mx-auto img img-responsive" src="/assets/perpus/assets/img/SMP-img.png" alt="Responsive image" style="width: auto; margin-top: 10px;">
                    <h4>SMP</h4>
                </div>
                <div class="col-lg-3 col-12 col-sm-6 cent" style>
                    <img class="mx-auto img img-responsive" src="/assets/perpus/assets/img/SMA-img.png" alt="Responsive image" style="width: auto; margin-top: 10px;">
                    <h4>SMA</h4>
                </div>
                <div class="col-lg-3 col-12 col-sm-6 cent" style>
                    <img class="mx-auto img img-responsive" src="/assets/perpus/assets/img/SMA-img.png" alt="Responsive image" style="width: auto; margin-top: 10px;">
                    <h4>SMK</h4>
                </div>
            </div>
        </div>

    </section><!-- End Jenjang Section -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">

        <div class="container" data-aos="fade-up">
            <div class="row gx-0">

                <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
                    <img src="/assets/perpus/assets/img/tujuan-img.png" class="img-fluid" alt="">
                </div>

                <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="content">
                        <h2>Tujuan Kami di Perpus Online</h2>
                        <p>
                            ppppppppp pppppppp ppppp pppppppp ppppppppp ppppp pppppppp pppp ppppppppp ppppp pppp
                            pppp pppp ppppp pppppppp ppppp pppppppp ppppppppp ppppp pppppppp pppp ppppppppp ppppp
                            pppp pppp ppppppppp pppppppp ppppp pppppppp ppppppppp ppppp pppppppp pppp ppppppppp
                            ppppp pppp pppp.
                        </p>
                    </div>
                </div>

            </div>
        </div>

    </section><!-- End About Section -->

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
                                <a href="#">dilihat {{ $b->clicked_time }} kali</a>
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

                @forelse($video as $v)
                <div class="col-lg-2 col-md-3 col-sm-4 col-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="card">
                        <div class="card-img">
                            <center>
                                <img src="/assets/perpus/assets/img/coverbuku.png" class="img-fluid" alt="">
                            </center>
                            <div class="social">
                                <a href="#"><i class="ri-video-download-fill"></i></a>
                                <a href="/videoplayer/'.$v->id"><i class="ri-eye-fill"></i></a>
                            </div>
                        </div>
                        <div class="card-info">
                            <h5>{{substr($v->title,0,25)."..."}}</h5>
                            <h6>
                                @if(($v->getGrade || $v->getEdu) !== null)
                                {{ "Kelas ".$v->getGrade->grade_name." ".$v->getEdu->edu_name}}
                                @endif
                            </h6>
                            <div class="btn-file">
                                <span>{{ strtoupper($v->filetype) }}</span>
                            </div>
                            <div class="stat-content">
                                <a href="#">dilihat {{ $v->clicked_time }} kali</a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-6 text-center"><b>Belum ada buku terbaru</b></div>
                @endforelse
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