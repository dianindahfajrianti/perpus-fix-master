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
                                <form action="">
                                    <input type="text" placeholder="Cari Buku/Multimedia">
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

                @for ($i=1; $i < 7; $i++) 
                <div class="col-lg-2 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                    <div class="member">
                        <div class="member-img">
                            <img src="/assets/perpus/assets/img/coverbuku.png" class="img-fluid" alt="" />
                            <div class="social">
                                <a href=""><i class="ri-file-download-fill"></i></a>
                                <a href="/laraview/#../assets/pdf/{{ $b->filename }}"><i class="ri-eye-fill"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h5>Matematika <br />Kelas 1 SMP</h5>
                            <div class="btn-file">
                                <span>PDF</span>
                            </div>
                            <p>
                                Deskripsi Buku Deskripsi Buku Deskripsi Buku Deskripsi
                                Buku
                            </p>
                            <div class="stat-content">
                                <a href="#">dilihat 120 kali</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endfor

            <a href="/file">
                <div class="d-grid gap-2 col-lg-3 col-6 mx-auto">
                    <button class="btn btn-outline-danger" type="button">Lihat Buku Lainnya</button>
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

                @for ($i=1; $i < 7; $i++) 
                <div class="col-lg-2 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                    <div class="member">
                        <div class="member-img">
                            <img src="/assets/perpus/assets/img/thumbnailvideo.png" class="img-fluid" alt="">
                            <div class="social">
                                <a href="#"><i class="ri-video-download-fill"></i></a>
                                <a href="#"><i class="ri-eye-fill"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h5>Matematika <br>Kelas 1 SMP</h5>
                            <div class="btn-file">
                                <span>Video</span>
                            </div>
                            <p>Deskripsi Video Deskripsi Video Deskripsi Video Deskripsi Video</p>
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