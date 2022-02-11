@extends('layouts.main')

@section('container')
<!-- ======= Breadcrumbs ======= -->
<section class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Video</h2>
        <ol>
          <li><a href="/">Home</a></li>
          <li><a href="/file">Multimedia</a></li>
          <li>Video</li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs -->

    <!-- ======= Video Player Section ======= -->

        <div class="d-flex justify-content-center">
            <video controls>
                <source src="/assets/perpus/assets/video/movie.mp4" type="video/mp4">
            </video>
        </div>


  </main><!-- End #main -->

@endsection