@extends('layouts.main')

@section('container')
    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h2>Buku</h2>
          <ol>
            <li><a href="/">Home</a></li>
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
            <aside class="col-lg-3 mb-1">
              <button type="button" class="btn-lg btn-filter d-lg-none d-block" id="filterbtn">
                <center>
                  <i class="ri-filter-fill"></i>
                  <span>Filter</span>
                </center>
              </button>

              <div class="sidebar d-lg-block d-none mh-75% overflow-auto">
                <h3 class="sidebar-title">Search</h3>
                <div class="sidebar-item search-form">
                  <form action="">
                    <input type="text">
                    <button type="submit">
                      <i class="bi bi-search"></i>
                    </button>
                  </form>
                </div>
                <!-- End sidebar search formn-->
                <h3 class="sidebar-title">Jenjang</h3>
                <div class="sidebar-item filter">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" />
                    <label class="form-check-label" for="flexRadioDefault1">
                      SD
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" />
                    <label class="form-check-label" for="flexRadioDefault2">
                      SMP
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" />
                    <label class="form-check-label" for="flexRadioDefault1">
                      SMA
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" />
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
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" />
                        <label class="form-check-label" for="flexRadioDefault1">
                          I
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" />
                        <label class="form-check-label" for="flexRadioDefault2">
                          II
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" />
                        <label class="form-check-label" for="flexRadioDefault2">
                          III
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" />
                        <label class="form-check-label" for="flexRadioDefault2">
                          IV
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" />
                        <label class="form-check-label" for="flexRadioDefault2">
                          V
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" />
                        <label class="form-check-label" for="flexRadioDefault2">
                          VI
                        </label>
                      </div>
                    </div>

                    <div class="col-6">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" />
                        <label class="form-check-label" for="flexRadioDefault2">
                          VII
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" />
                        <label class="form-check-label" for="flexRadioDefault2">
                          VIII
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" />
                        <label class="form-check-label" for="flexRadioDefault2">
                          IX
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" />
                        <label class="form-check-label" for="flexRadioDefault2">
                          X
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" />
                        <label class="form-check-label" for="flexRadioDefault2">
                          XI
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" />
                        <label class="form-check-label" for="flexRadioDefault2">
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
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" />
                        <label class="form-check-label" for="flexRadioDefault1">
                          IPA
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" />
                        <label class="form-check-label" for="flexRadioDefault2">
                          IPS
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" />
                        <label class="form-check-label" for="flexRadioDefault2">
                          Bahasa Indonesia
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" />
                        <label class="form-check-label" for="flexRadioDefault2">
                          PJOK
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" />
                        <label class="form-check-label" for="flexRadioDefault2">
                          PPKN
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" />
                        <label class="form-check-label" for="flexRadioDefault2">
                          TIK
                        </label>
                      </div>
                    </div>

                    <div class="col-6">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" />
                        <label class="form-check-label" for="flexRadioDefault1">
                          Prakarya
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" />
                        <label class="form-check-label" for="flexRadioDefault2">
                          Seni Budaya
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" />
                        <label class="form-check-label" for="flexRadioDefault1">
                          Sejarah
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" />
                        <label class="form-check-label" for="flexRadioDefault2">
                          Agama
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" />
                        <label class="form-check-label" for="flexRadioDefault2">
                          Matematika
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" />
                        <label class="form-check-label" for="flexRadioDefault2">
                          Inggris
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End sidebar filter-->
                <div class="row justify-content-center">
                  <div class="col-12">
                    <a class="btn-hapus" href="#filterbtn">
                      <span>Terapkan</span>
                    </a>
                    <a class="btn-hapus" href="#filterbtn">
                      <span>Reset</span>
                    </a>
                  </div>
                </div>
              </div>
              <!-- End sidebar -->
            </aside>

            <div class="col-lg-9 entries">
              <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6 ml-3 mb-3">
                  <div class="member">
                    <div class="member-img">
                      <img src="/assets/perpus/assets/img/coverbuku.png" class="img-fluid" alt="" />
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
                      <img src="/assets/perpus/assets/img/coverbuku.png" class="img-fluid" alt="" />
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
                      <img src="/assets/perpus/assets/img/coverbuku.png" class="img-fluid" alt="" />
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
                      <img src="/assets/perpus/assets/img/coverbuku.png" class="img-fluid" alt="" />
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
                      <img src="/assets/perpus/assets/img/coverbuku.png" class="img-fluid" alt="" />
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
                      <img src="/assets/perpus/assets/img/coverbuku.png" class="img-fluid" alt="" />
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
                      <img src="/assets/perpus/assets/img/coverbuku.png" class="img-fluid" alt="" />
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
                      <img src="/assets/perpus/assets/img/coverbuku.png" class="img-fluid" alt="" />
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
@endsection