@extends('layouts.main')

@section('container')
    <!-- ======= Header ======= -->
    <header id="headerLogin" class="headerLogin">
        <div class="container d-flex">

            <a href="/" class="logo d-flex align-items-center">
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
                            <form action="{{ route('login') }}" method="post">
                                @csrf
                                <div class="form-group">
                                  <label for="username">Username</label>
                                  <input type="text" name="username" class="form-control" id="username" aria-describedby="emailHelp" placeholder="masukan username">
                                  <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                </div>
                                <div class="form-group">
                                  <label for="pass">Password</label>
                                  <input type="password" name="password" class="form-control" id="pass" placeholder="masukan password">
                                </div>
                                {{-- <div class="form-check">
                                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                  <label class="form-check-label" for="exampleCheck1">Ingatkan Saya</label>
                                </div> --}}
                                <button type="submit" class="btn-login">Masuk</button>
                                {{-- <a href="/" class="btn-login scrollto">Masuk</a> --}}
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