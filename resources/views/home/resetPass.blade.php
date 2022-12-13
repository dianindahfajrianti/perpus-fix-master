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

        <!-- ======= Login Section ======= -->
        <section id="login" class="login">

            <div class="container" data-aos="fade-up">
                <div class="row gx-0">

                    <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up"
                        data-aos-delay="200">
                        <div class="content">
                            <h2>Masukan username dan Email</h2>
                            <form action="{{ route('login') }}" method="post">
                                @csrf
                                <div class="form-group">
                                  <label for="username">Username</label>
                                  <input type="text" name="username" class="form-control @error('username'){{ 'is-invalid' }}@enderror" id="username" aria-describedby="emailHelp" placeholder="masukan username">
                                  @error('username')
                                      <div class="invalid-feedback">
                                          {{ $message }}
                                      </div>
                                  @enderror
                                  <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                </div>
                                <div class="form-group">
                                  <label for="email">Email</label>
                                  <input type="email" name="email" class="form-control @error('email'){{ 'is-invalid' }}@enderror" id="email" placeholder="masukan email">
                                  @error('email')
                                      {{ $message }}
                                  @enderror
                                </div>
                                <button type="submit" class="btn-login">Reset</button>
                              </form>
                        </div>
                    </div>

                    <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
                        <img src="/assets/perpus/assets/img/resetPass.png" class="img-fluid" alt="">
                    </div>

                </div>
            </div>

        </section><!-- End Login Section -->

    </main><!-- End #main -->
@endsection