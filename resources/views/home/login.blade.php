<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Perpus</title>
    <meta content="" name="description">

    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="/assets/perpus/assets/img/perpus.png" rel="icon">
    <link href="/assets/perpus/assets/img/perpus.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="/assets/perpus/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/perpus/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/assets/perpus/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href=/assets/perpus/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="/assets/perpus/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="/assets/perpus/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="/assets/perpus/assets/css/style.css" rel="stylesheet">
    @yield('ext-css')

</head>

<body>

@section('container')
    <!-- ======= Header ======= -->
    <header id="headerLogin" class="headerLogin">
        <div class="container d-flex">

            <a href="index.html" class="logo d-flex align-items-center">
                <img src="/assets/perpus/assets/img/logo-perpus.png" class="img-fluid animated" alt="">
            </a>
            <p>Masuk</p>

            <nav class="navbar order-last order-lg-0 d-none">
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <main id="main">

        <!-- ======= About Section ======= -->
        <section id="login" class="login">

            <div class="container" data-aos="fade-up">
                <div class="row gx-0">

                    <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up"
                        data-aos-delay="200">
                        <div class="content">
                            <h2>Masukan username dan Password</h2>
                            <form>
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Username</label>
                                  <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="masukan username">
                                  <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Password</label>
                                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="masukan password">
                                </div>
                                <div class="form-check">
                                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                  <label class="form-check-label" for="exampleCheck1">Ingatkan Saya</label>
                                </div>
                                <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                                <a href="index.html" class="btn-login scrollto">Masuk</a>
                              </form>
                        </div>
                    </div>

                    <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
                        <img src="/assets/perpus/assets/img/login-img.png" class="img-fluid" alt="">
                    </div>

                </div>
            </div>

        </section><!-- End About Section -->

    </main><!-- End #main -->
@endsection

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>Perpustakaan Online</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="/assets/perpus/assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="/assets/perpus/assets/vendor/aos/aos.js"></script>
    <script src="/assets/perpus/assets/vendor/php-email-form/validate.js"></script>
    <script src="/assets/perpus/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="/assets/perpus/assets/vendor/purecounter/purecounter.js"></script>
    <script src="/assets/perpus/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="/assets/perpus/assets/vendor/glightbox/js/glightbox.min.js"></script>

    <!-- Template Main JS File -->
    <script src="/assets/perpus/assets/js/main.js"></script>
    @yield('ext-js')

</body>

</html>