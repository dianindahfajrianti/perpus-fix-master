<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Perpus</title>
    <meta content="" name="description" />

    <meta content="" name="keywords" />

    <!-- Favicons -->
    <link href="assets/img/perpus.png" rel="icon" />
    <link href="assets/img/perpus.png" rel="apple-touch-icon" />

    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
      rel="stylesheet"
    />

    <!-- Vendor CSS Files -->
    <link
      href="assets/vendor/bootstrap/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="assets/vendor/bootstrap-icons/bootstrap-icons.css"
      rel="stylesheet"
    />
    <link href="assets/vendor/aos/aos.css" rel="stylesheet" />
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet" />
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />
    <link
      href="assets/vendor/glightbox/css/glightbox.min.css"
      rel="stylesheet"
    />

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet" />
  </head>

  <body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top">
      <div
        class="container-fluid container-xl d-flex align-items-center justify-content-between"
      >
        <a href="index.html" class="logo d-flex align-items-center">
          <img src="assets/img/logoperpus.png" alt="" />
        </a>

        <nav id="navbar" class="navbar">
          <ul>
            <li><a href="buku.html">Buku</a></li>
            <li><a href="multimedia.html">Multimedia</a></li>
            <li><a href="panduan.html">Panduan</a></li>
            <li><a class="getstarted scrollto" href="login.html">Masuk</a></li>
          </ul>
          <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
        <!-- .navbar -->
      </div>
    </header>
    <!-- End Header -->

    <main id="main">
      <!-- ======= Breadcrumbs ======= -->
      <section class="breadcrumbs">
        <div class="container">
          <div class="d-flex justify-content-between align-items-center">
            <h2>Buku</h2>
            <ol>
              <li><a href="index.html">Home</a></li>
              <li>Buku</li>
            </ol>
          </div>
        </div>
      </section>
      <!-- End Breadcrumbs -->

      <!-- ======= Buku Single Section ======= -->
      <section id="file" class="file">
        <div class="container" data-aos="fade-up">
          <div class="content-list" id="file-terbaru">
            <div class="row">
              <!-- Search Sidebar -->
              <aside class="col-lg-4">
                <button type="button" class="btn-lg btn-filter d-lg-none d-block" id="filterbtn">
                  <center>
                    <i class="ri-filter-fill"></i>
                    <span>Filter</span>
                  </center>
                </button>

                <!-- <div class="filter d-lg-none d-block">
                <div class="row">
                  <div class="col-6">
                    <div class="btn-filter" onclick="myFunction()">
                      <i class="ri-filter-fill"></i>
                      <span>Filter</span>
                    </div>
                  </div>
                </div>
               
                <div style="display: none;" id="myDIV">
                  This is my DIV element.
                </div>
              </div> -->

                <div class="sidebar d-lg-block d-none">
                  <h3 class="sidebar-title">Search</h3>
                  <div class="sidebar-item search-form">
                    <form action="">
                      <input type="text" />
                      <button type="submit">
                        <i class="bi bi-search"></i>
                      </button>
                    </form>
                  </div>
                  <!-- End sidebar search formn-->
                  <h3 class="sidebar-title">Jenjang</h3>
                  <div class="sidebar-item filter">
                    <div class="form-check">
                      <input
                        class="form-check-input"
                        type="radio"
                        name="flexRadioDefault"
                        id="flexRadioDefault1"
                      />
                      <label class="form-check-label" for="flexRadioDefault1">
                        SD
                      </label>
                    </div>
                    <div class="form-check">
                      <input
                        class="form-check-input"
                        type="radio"
                        name="flexRadioDefault"
                        id="flexRadioDefault2"
                      />
                      <label class="form-check-label" for="flexRadioDefault2">
                        SMP
                      </label>
                    </div>
                    <div class="form-check">
                      <input
                        class="form-check-input"
                        type="radio"
                        name="flexRadioDefault"
                        id="flexRadioDefault1"
                      />
                      <label class="form-check-label" for="flexRadioDefault1">
                        SMA
                      </label>
                    </div>
                    <div class="form-check">
                      <input
                        class="form-check-input"
                        type="radio"
                        name="flexRadioDefault"
                        id="flexRadioDefault1"
                      />
                      <label class="form-check-label" for="flexRadioDefault1">
                        SMK
                      </label>
                    </div>
                  </div>

                  <h3 class="sidebar-title">Kelas</h3>
                  <div class="sidebar-item filter">
                    <div class="row">
                      <div class="col-6">
                        <div class="form-check">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="flexRadioDefault"
                            id="flexRadioDefault1"
                          />
                          <label
                            class="form-check-label"
                            for="flexRadioDefault1"
                          >
                            I
                          </label>
                        </div>
                        <div class="form-check">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="flexRadioDefault"
                            id="flexRadioDefault2"
                          />
                          <label
                            class="form-check-label"
                            for="flexRadioDefault2"
                          >
                            II
                          </label>
                        </div>
                        <div class="form-check">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="flexRadioDefault"
                            id="flexRadioDefault2"
                          />
                          <label
                            class="form-check-label"
                            for="flexRadioDefault2"
                          >
                            III
                          </label>
                        </div>
                        <div class="form-check">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="flexRadioDefault"
                            id="flexRadioDefault2"
                          />
                          <label
                            class="form-check-label"
                            for="flexRadioDefault2"
                          >
                            IV
                          </label>
                        </div>
                        <div class="form-check">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="flexRadioDefault"
                            id="flexRadioDefault2"
                          />
                          <label
                            class="form-check-label"
                            for="flexRadioDefault2"
                          >
                            V
                          </label>
                        </div>
                        <div class="form-check">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="flexRadioDefault"
                            id="flexRadioDefault2"
                          />
                          <label
                            class="form-check-label"
                            for="flexRadioDefault2"
                          >
                            VI
                          </label>
                        </div>
                      </div>

                      <div class="col-6">
                        <div class="form-check">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="flexRadioDefault"
                            id="flexRadioDefault2"
                          />
                          <label
                            class="form-check-label"
                            for="flexRadioDefault2"
                          >
                            VII
                          </label>
                        </div>
                        <div class="form-check">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="flexRadioDefault"
                            id="flexRadioDefault2"
                          />
                          <label
                            class="form-check-label"
                            for="flexRadioDefault2"
                          >
                            VIII
                          </label>
                        </div>
                        <div class="form-check">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="flexRadioDefault"
                            id="flexRadioDefault2"
                          />
                          <label
                            class="form-check-label"
                            for="flexRadioDefault2"
                          >
                            IX
                          </label>
                        </div>
                        <div class="form-check">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="flexRadioDefault"
                            id="flexRadioDefault2"
                          />
                          <label
                            class="form-check-label"
                            for="flexRadioDefault2"
                          >
                            X
                          </label>
                        </div>
                        <div class="form-check">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="flexRadioDefault"
                            id="flexRadioDefault2"
                          />
                          <label
                            class="form-check-label"
                            for="flexRadioDefault2"
                          >
                            XI
                          </label>
                        </div>
                        <div class="form-check">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="flexRadioDefault"
                            id="flexRadioDefault2"
                          />
                          <label
                            class="form-check-label"
                            for="flexRadioDefault2"
                          >
                            XII
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>

                  <h3 class="sidebar-title">Mata Pelajaran</h3>
                  <div class="sidebar-item filter">
                    <div class="row">
                      <div class="col-6">
                        <div class="form-check">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="flexRadioDefault"
                            id="flexRadioDefault1"
                          />
                          <label
                            class="form-check-label"
                            for="flexRadioDefault1"
                          >
                            IPA
                          </label>
                        </div>
                        <div class="form-check">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="flexRadioDefault"
                            id="flexRadioDefault2"
                          />
                          <label
                            class="form-check-label"
                            for="flexRadioDefault2"
                          >
                            IPS
                          </label>
                        </div>
                        <div class="form-check">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="flexRadioDefault"
                            id="flexRadioDefault2"
                          />
                          <label
                            class="form-check-label"
                            for="flexRadioDefault2"
                          >
                            Bahasa Indonesia
                          </label>
                        </div>
                        <div class="form-check">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="flexRadioDefault"
                            id="flexRadioDefault2"
                          />
                          <label
                            class="form-check-label"
                            for="flexRadioDefault2"
                          >
                            Bahasa Inggris
                          </label>
                        </div>
                        <div class="form-check">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="flexRadioDefault"
                            id="flexRadioDefault2"
                          />
                          <label
                            class="form-check-label"
                            for="flexRadioDefault2"
                          >
                            PJOK
                          </label>
                        </div>
                        <div class="form-check">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="flexRadioDefault"
                            id="flexRadioDefault2"
                          />
                          <label
                            class="form-check-label"
                            for="flexRadioDefault2"
                          >
                            PPKN
                          </label>
                        </div>
                        <div class="form-check">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="flexRadioDefault"
                            id="flexRadioDefault2"
                          />
                          <label
                            class="form-check-label"
                            for="flexRadioDefault2"
                          >
                            Matematika
                          </label>
                        </div>
                        <div class="form-check">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="flexRadioDefault"
                            id="flexRadioDefault2"
                          />
                          <label
                            class="form-check-label"
                            for="flexRadioDefault2"
                          >
                            TIK
                          </label>
                        </div>
                      </div>

                      <div class="col-6">
                        <div class="form-check">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="flexRadioDefault"
                            id="flexRadioDefault1"
                          />
                          <label
                            class="form-check-label"
                            for="flexRadioDefault1"
                          >
                            Prakarya
                          </label>
                        </div>
                        <div class="form-check">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="flexRadioDefault"
                            id="flexRadioDefault2"
                          />
                          <label
                            class="form-check-label"
                            for="flexRadioDefault2"
                          >
                            Seni Budaya
                          </label>
                        </div>
                        <div class="form-check">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="flexRadioDefault"
                            id="flexRadioDefault1"
                          />
                          <label
                            class="form-check-label"
                            for="flexRadioDefault1"
                          >
                            Sejarah
                          </label>
                        </div>
                        <div class="form-check">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="flexRadioDefault"
                            id="flexRadioDefault2"
                          />
                          <label
                            class="form-check-label"
                            for="flexRadioDefault2"
                          >
                            Agama Islam
                          </label>
                        </div>
                        <div class="form-check">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="flexRadioDefault"
                            id="flexRadioDefault2"
                          />
                          <label
                            class="form-check-label"
                            for="flexRadioDefault2"
                          >
                            Agama Kristen
                          </label>
                        </div>
                        <div class="form-check">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="flexRadioDefault"
                            id="flexRadioDefault2"
                          />
                          <label
                            class="form-check-label"
                            for="flexRadioDefault2"
                          >
                            Agama Katolik
                          </label>
                        </div>
                        <div class="form-check">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="flexRadioDefault"
                            id="flexRadioDefault2"
                          />
                          <label
                            class="form-check-label"
                            for="flexRadioDefault2"
                          >
                            Agama Hindu
                          </label>
                        </div>
                        <div class="form-check">
                          <input
                            class="form-check-input"
                            type="radio"
                            name="flexRadioDefault"
                            id="flexRadioDefault2"
                          />
                          <label
                            class="form-check-label"
                            for="flexRadioDefault2"
                          >
                            Agama Khonghucu
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- End sidebar filter-->
                  <div class="row justify-content-center">
                    <div class="col-6">
                      <a class="btn-hapus scrollto" href="#about">
                        <span>Hapus Semua</span>
                      </a>
                    </div>
                  </div>
                </div>
                <!-- End sidebar -->
              </aside>

              <div class="col-lg-8 entries">
                <div class="row">
                  <div class="col-lg-3 col-md-4 col-sm-6 ml-3 mb-3">
                    <div class="member">
                      <div class="member-img">
                        <img
                          src="assets/img/coverbuku.png"
                          class="img-fluid"
                          alt=""
                        />
                        <div class="social">
                          <a href=""><i class="ri-file-download-fill"></i></a>
                          <a href=""><i class="ri-eye-fill"></i></a>
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
                  <div class="col-lg-3 col-md-4 col-sm-6 ml-3 mb-3">
                    <div class="member">
                      <div class="member-img">
                        <img
                          src="assets/img/coverbuku.png"
                          class="img-fluid"
                          alt=""
                        />
                        <div class="social">
                          <a href=""><i class="ri-file-download-fill"></i></a>
                          <a href=""><i class="ri-eye-fill"></i></a>
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
                  <div class="col-lg-3 col-md-4 col-sm-6 ml-3 mb-3">
                    <div class="member">
                      <div class="member-img">
                        <img
                          src="assets/img/coverbuku.png"
                          class="img-fluid"
                          alt=""
                        />
                        <div class="social">
                          <a href=""><i class="ri-file-download-fill"></i></a>
                          <a href=""><i class="ri-eye-fill"></i></a>
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
                  <div class="col-lg-3 col-md-4 col-sm-6 ml-3 mb-3">
                    <div class="member">
                      <div class="member-img">
                        <img
                          src="assets/img/coverbuku.png"
                          class="img-fluid"
                          alt=""
                        />
                        <div class="social">
                          <a href=""><i class="ri-file-download-fill"></i></a>
                          <a href=""><i class="ri-eye-fill"></i></a>
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
                  <div class="col-lg-3 col-md-4 col-sm-6 ml-3 mb-3">
                    <div class="member">
                      <div class="member-img">
                        <img
                          src="assets/img/coverbuku.png"
                          class="img-fluid"
                          alt=""
                        />
                        <div class="social">
                          <a href=""><i class="ri-file-download-fill"></i></a>
                          <a href=""><i class="ri-eye-fill"></i></a>
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
                  <div class="col-lg-3 col-md-4 col-sm-6 ml-3 mb-3">
                    <div class="member">
                      <div class="member-img">
                        <img
                          src="assets/img/coverbuku.png"
                          class="img-fluid"
                          alt=""
                        />
                        <div class="social">
                          <a href=""><i class="ri-file-download-fill"></i></a>
                          <a href=""><i class="ri-eye-fill"></i></a>
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
                  <div class="col-lg-3 col-md-4 col-sm-6 ml-3 mb-3">
                    <div class="member">
                      <div class="member-img">
                        <img
                          src="assets/img/coverbuku.png"
                          class="img-fluid"
                          alt=""
                        />
                        <div class="social">
                          <a href=""><i class="ri-file-download-fill"></i></a>
                          <a href=""><i class="ri-eye-fill"></i></a>
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
                  <div class="col-lg-3 col-md-4 col-sm-6 ml-3 mb-3">
                    <div class="member">
                      <div class="member-img">
                        <img
                          src="assets/img/coverbuku.png"
                          class="img-fluid"
                          alt=""
                        />
                        <div class="social">
                          <a href=""><i class="ri-file-download-fill"></i></a>
                          <a href=""><i class="ri-eye-fill"></i></a>
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

                  <!-- Pagination -->
                  <nav aria-label="...">
                    <ul class="pagination justify-content-center mt-4">
                      <li><a href="#">&laquo;</a></li>
                      <li class="active"><a href="#">1</a></li>
                      <li><a href="#">2</a></li>
                      <li><a href="#">3</a></li>
                      <li><a href="#">&raquo;</a></li>
                    </ul>
                  </nav>
                </div>
                <!-- End row buku entries list -->
              </div>
              <!-- End buku sidebar -->
            </div>
          </div>
        </div>
      </section>
      <!-- End Buku Single Section -->
    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
      <div class="container">
        <div class="copyright">
          &copy; Copyright <strong><span>Perpustakaan Online</span></strong
          >. All Rights Reserved
        </div>
        <div class="credits">
          Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
      </div>
    </footer>
    <!-- End Footer -->
    <a
      href="#"
      class="back-to-top d-flex align-items-center justify-content-center"
      ><i class="bi bi-arrow-up-short"></i
    ></a>

    <!-- Vendor JS Files -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/purecounter/purecounter.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/config.js"></script>
  </body>
</html>
