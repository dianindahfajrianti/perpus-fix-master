@extends('layouts.main')
@section('ext-css')
  
@endsection
@section('container')

<!-- ======= Breadcrumbs ======= -->
<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Riwayat</h2>
            <ol>
                <li><a href="/">Home</a></li>
                <li>Riwayat</li>
            </ol>
        </div>
    </div>
</section>
<!-- End Breadcrumbs -->

<!-- ======= History Section ======= -->
<section id="history" class="history">
  <div class="container" data-aos="fade-up">
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

            </div><!-- End Feature Icons -->
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