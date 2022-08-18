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
                      @if ($r->type == 'pdf')
                      <h4>
                        <a href="/pdfViewer/{{ $r->file_id }}">
                          <b>{{ substr($r->books->title, 0, 30) . '' }}</b>
                          <br><span class="btn-file">PDF</span>
                          <br><p>dibuka {{ $r->created_at->diffForHumans() }}</p>
                      </a>
                      </h4>
                      @elseif ($r->type == 'mp4') 
                      <h4>
                        <a href="/video/{{ $r->file_id }}">
                          <b>{{ substr($r->videos->title, 0, 30) . '' }}</b>
                          <br><span class="btn-file">MP4</span>
                          <br><p>dibuka {{ $r->created_at->diffForHumans() }}</p>
                      </a>
                      </h4>
                      @endif
                    </div>
                  </div>
                  @empty
                  <h4 class="text-center">Belum ada riwayat baca</h4>
                  @endforelse

                </div>
              </div>
              
              <a href="/history"><h1>Lihat Riwayat ...</h1></a>

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
              
              <fieldset disabled>
                <div class="form-group">
                  <label for="disabledTextInput">Username</label>
                  <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ $user->username }}">
                </div>
                <div class="form-group">
                  <label for="disabledTextInput">Email</label>
                  <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ $user->email}}">
                </div>
                @if ($user->edu_id !== null)
                <div class="form-group">
                  <label for="disabledTextInput">Asal Sekolah</label>
                  <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ $user->getSchool->sch_name }}">
                </div>
                <div class="form-group">
                  <label for="disabledTextInput">Jenjang</label>
                  <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ $user->getGrade->grade_name }}">
                </div>
                <div class="form-group">
                  <label for="disabledTextInput">Tingkatan</label>
                  <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ $user->getMajor->maj_name }}">
                </div>
                @endif
              </fieldset>
              <br>
              <h3>Ganti Password</h3>
              <form action="/cache" method="post">
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
                  <label for="confirm">Konfirmasi Password Baru</label>
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