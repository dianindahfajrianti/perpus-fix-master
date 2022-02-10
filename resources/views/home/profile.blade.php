@extends('layouts.main')

@section('container')

<!-- ======= Profile Section ======= -->
<section id="profile" class="profile">
  <div class="container" data-aos="fade-up">

    <div class="photo">
      <img src="/assets/perpus/assets/img/profile-img.png" class="rounded-circle" height="200" width="200" alt="">
      <p>{{ Auth::user()->name }}</p>
    </div>
    <div class="d-flex justify-content-center">

      <div class="col-lg-8">

        <div class="entry">

          <div class="entry-history">
            <div class="row" data-aos="fade-up">
              <h3>Riwayat</h3>

              <div class="row">

                <div class="row align-self-center gy-2">

                  @forelse($riwayat as $r)
                    <div class="col-md-6 icon-box">
                      <i class="ri-radio-button-line"></i>
                      <div>
                        <h4>Ppppppppppp ppppppppp ppppppp ppppp.</h4>
                        <p>dibuka pada tanggal 09 agustus 2021</p>
                      </div>
                    </div>
                  @empty
                    <h4 class="text-center">Belum ada riwayat baca</h4>
                  @endforelse

                </div>

              </div>

            </div><!-- End Feature Icons -->
          </div>

        </div><!-- End profile entry -->

        <div class="entry">

          <div class="d-flex justify-content-center">
            <div class="col-lg-11" data-aos="fade-up">
              <h3>Detail Profil</h3>
                @foreach($user as $u)
                  <fieldset disabled>
                    <div class="form-group">
                      <label for="disabledTextInput">Username</label>
                      <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ $u->username }}">
                    </div>
                    <div class="form-group">
                      <label for="disabledTextInput">Email</label>
                      <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ $u->email}}">
                    </div>
                    @if ($u->school_id !== null)
                    <div class="form-group">
                      <label for="disabledTextInput">Asal Sekolah</label>
                      <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ $u->getSchool->sch_name }}">
                    </div>
                    <div class="form-group">
                      <label for="disabledTextInput">Jenjang</label>
                      <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ $u->getGrade->grade_name }}">
                    </div>
                    <div class="form-group">
                      <label for="disabledTextInput">Tingkatan</label>
                      <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ $u->getMajor->maj_name }}">
                    </div>
                    @endif
                  </fieldset>
                @endforeach
            </div>
          </div>

        </div><!-- End profile entry -->

      </div>
    </div>

  </div>
</section>

</main><!-- End #main -->
@endsection