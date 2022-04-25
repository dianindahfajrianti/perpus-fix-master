@extends('layouts.main')
@section('ext-css')
  
@endsection
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
                      {{-- @php
                          if(Request::segment(1) == 'buku'){
                              $link = 'pdf';
                              $name = $r->filename;
                          }else{
                              $link = 'video';
                              $name = "$r->filename.$r->filetype";
                          };
                      @endphp --}}
                      <h4>{{ substr($r->title, 0, 16) . '...' }}</h4>
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
              @if (session('success'))
              <div class="alert alert-success" role="alert">
                <h5><i class="ri-check-fill"></i> Berhasil !</h5>
                <div class="val"></div>
              </div>
              @endif
              @if (session('error'))
              <div class="alert alert-danger" role="alert">
                <h5><i class="ri-error-warning-line"></i> Error !</h5>
                <div class="val"></div>
              </div>
              @endif
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
                @if ($u->edu_id !== null)
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
              <br>
              <h3>Ganti Password</h3>
              <form action="/reset" method="post">
                <div class="form-group">
                  <label for="oldpass">Password Lama</label>
                  @csrf
                  <input type="password" name="password_lama" id="oldpass" class="form-control @error('password_lama'){{ 'is-invalid' }}@enderror">
                  @error('password_lama')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="pass">Password Baru</label>
                  <input type="password" name="password_baru" id="pass" class="form-control @error('password_baru'){{ 'is-invalid' }}@enderror">
                  @error('password_baru')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="confirm">Konfirmasi Password</label>
                  <input type="password" name="konfirmasi_password" id="confirm" class="form-control @error('konfirmasi_password'){{ 'is-invalid' }}@enderror">
                  @error('konfirmasi_password')
                    <div class="invalid-feedback">
                      {{$message}}
                    </div>
                  @enderror
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-center">
                  <button type="submit" class="btn btn-profile">Simpan</button>
                </div>
              </form>
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
@section('ext-js')
@if (session('success'))
<script type="text/javascript">
    $(document).ready(function(e) {
        e.preventDefault;
        var data = '<?= session("success") ?>';
        var js = JSON.parse(data);
        $('.val').text(js.message);
    });
</script>
@endif
@if (session('error'))
<script type="text/javascript">
    $(document).ready(function(e) {
        e.preventDefault;
        var data = '<?= session("error"); ?>';
        var js = JSON.parse(data);
        $('.val').text(js.message);
    });
</script>
@endif
@endsection