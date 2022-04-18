@extends('layouts.main')
@section('ext-css')
<link rel="stylesheet" href="/assets/css/player.css">
@endsection
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

<!-- ======= Video Section ======= -->
<section id="video" class="video">
  <div class="container" data-aos="fade-up">
    <div class="video-player d-flex justify-content-center">
      {{-- <video controls>
        <source src="{{ url('storage/video/'.$video->filename.".".$video->filetype) }}" type="video/{{ $video->filetype }}">
            Your browser does not support the video tag.
      </video>   --}}
      <video id="video_example" class="video-js vjs-default-skin vjs-big-play-centered" controls preload="auto" height="auto" width="1300">
           <source src="/stream/{{ $video->id }}" type="video/{{ $video->filetype }}">
      </video>
    </div>

    <h2 class="entry-title pt-3">
      <a>{{$video->title}}</a>
    </h2>

    <div class="entry-meta">
      <ul>
        <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a>{{$video->author ?? $video->creator}}</a></li>
        {{-- <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a>{{$video->created_at->diffForHumans()}}</a></li> --}}
        <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a>{{$video->created_at}}</a></li>
        <li class="d-flex align-items-center"><i class="bi bi-eye"></i> <a>{{$video->clicked_time}} kali</a></li>
      </ul>
    </div>

    <div class="entry-desc">
      <p>
        {{$video->desc}}  
      </p>
      <div class="unduh-video">
        <a href="{{ url('storage/video/'.$video->filename.".".$video->filetype) }}" download>Unduh Video</a>
      </div>
    </div>
  </div>

</section><!-- End Video Section -->

</main><!-- End #main -->
@endsection
@section('ext-js')
<script src="/assets/js/player.js"></script>
<script type="text/javascript">
var options = {
  controls: true,
  autoplay: false,
  preload: 'auto',
  liveui:true
};
var player = videojs('video_example',options);
player.ready(function () {
  
});
</script>
@endsection