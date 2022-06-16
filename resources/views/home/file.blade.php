@extends('layouts.main')
@section('ext-css')
    <!-- Select2 -->
    <link rel="stylesheet" href="/assets/adminlte/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="/assets/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endsection
@section('container')
    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2>{{ ucfirst(Request::segment(1)) }}</h2>
                <ol>
                    <li><a href="/">Home</a></li>
                    <li>{{ ucfirst(Request::segment(1)) }}</li>
                </ol>
            </div>
        </div>
    </section>
    <!-- End Breadcrumbs -->

    @php
    function numberToRomanRepresentation($number)
    {
        $map = ['M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1];
        $returnValue = '';
        while ($number > 0) {
            foreach ($map as $roman => $int) {
                if ($number >= $int) {
                    $number -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
    }
    @endphp

    <!-- ======= File Single Section ======= -->
    <section id="file" class="file">
        <div class="container" data-aos="fade-up">
            <div class="content-list" id="file-terbaru">
                <form id="filters" action="/{{Request::segment(1)}}">
                    <div class="row">
                        <!-- Search Sidebar -->
                        <aside class="col-lg-2 mb-1">
                          <button type="button" class="btn-lg btn-filter d-lg-none d-block" id="filterbtn">
                              <center>
                                  <i class="ri-filter-fill"></i>
                                  <span>Filter</span>
                              </center>
                          </button>

                          <div class="sidebar d-lg-block d-none mh-75% overflow-auto">
                              <h3 class="sidebar-title">Cari</h3>
                              <div class="sidebar-item search-form">
                                  <div class="fsrc">
                                      <input type="text" placeholder="cari judul..." name="search" value="{{ request('search') }}">
                                      <button type="submit">
                                          <i class="bi bi-search"></i>
                                      </button>
                                  </div>
                              </div>
                              <!-- End sidebar search formn-->

                              <!-- jenjang -->
                              <h3 class="sidebar-title">Jenjang</h3>
                              <div class="sidebar-item filter">
                                  @foreach ($edu as $e)
                                      <div class="form-check">
                                          <input value="{{ old('jenjang', $e->edu_name) }}" class="form-check-input"
                                              type="radio" name="jenjang" id="jenjang" />
                                          <label class="form-check-label" for="jenjang">
                                              {{ $e->edu_name }}
                                          </label>
                                      </div>
                                  @endforeach
                              </div>
                              <!-- Kelas -->
                              <h3 class="sidebar-title">Kelas</h3>
                              <div class="sidebar-item filter">
                                  <div class="row">
                                      <div class="col-6">
                                          @for ($i = 1; $i < 7; $i++)
                                              <div class="form-check">
                                                  <input value="{{ $i }}" class="form-check-input" type="radio" name="kelas" id="kelas" />
                                                  <label class="form-check-label" for="kelas">
                                                      {{ numberToRomanRepresentation($i) }}
                                                  </label>
                                              </div>
                                          @endfor
                                      </div>
                                      <div class="col-6">
                                          @for ($i = 7; $i < 13; $i++)
                                              <div class="form-check">
                                                  <input value="{{ $i }}" class="form-check-input" type="radio" name="kelas" id="kelas" />
                                                  <label class="form-check-label" for="kelas">
                                                      {{ numberToRomanRepresentation($i) }}
                                                  </label>
                                              </div>
                                          @endfor
                                      </div>
                                  </div>
                              </div>    
                              {{-- <h3 class="sidebar-title">Kelas</h3>
                              <div class="sidebar-item filter">
                                    @foreach ($kls as $k)
                                        <div class="form-check">
                                            <input value="{{ old('kelas', $k->grade_name) }}" class="form-check-input"
                                                type="radio" name="kelas" id="kelas" />
                                            <label class="form-check-label" for="kelas">
                                                {{ $k->grade_name }}
                                            </label>
                                        </div>
                                    @endforeach
                              </div> --}}
                              <!-- Jurusan -->
                              <h3 class="sidebar-title" for="jurusan">Jurusan</h3>
                              <div class="sidebar-item filter">
                                  <div class="row">
                                      <div class="col-12">
                                          <div class="form-group">
                                              <div class="input-group">
                                                  <select name="jurusan" class="form-control select2bs4 @error('jurusan') {{ 'is-invalid' }} @enderror" id="jurusan" aria-label="">
                                                      <option value="">-- Pilih Jurusan --</option>
                                                      @foreach ($maj as $mjr)
                                                          <option
                                                              @if (old('jurusan') == $mjr->maj_name) {{ 'selected' }} @endif
                                                              value="{{ $mjr->maj_name }}">
                                                              {{ $mjr->maj_name }}</option>
                                                      @endforeach
                                                  </select>
                                                  @error('jurusan')
                                                      <div class="invalid-feedback">
                                                          {{ $message }}
                                                      </div>
                                                  @enderror
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>   
                              <!-- Mapel -->
                              <h3 class="sidebar-title" for="mapel">Mata Pelajaran</h3>
                              <div class="sidebar-item filter">
                                  <div class="row">
                                      <div class="col-12">
                                          <div class="form-group">
                                              <div class="input-group">
                                                  <select name="mapel" class="form-control select2bs4 @error('mapel') {{ 'is-invalid' }} @enderror" id="mapel" aria-label="">
                                                      <option value="">-- Pilih Mata Pelajaran --</option>
                                                      @foreach ($sub as $sbj)
                                                          <option
                                                              @if (old('mapel') == $sbj->sbj_name) {{ 'selected' }} @endif
                                                              value="{{ $sbj->sbj_name }}">
                                                              {{ $sbj->sbj_name }}</option>
                                                      @endforeach
                                                  </select>
                                                  @error('mapel')
                                                      <div class="invalid-feedback">
                                                          {{ $message }}
                                                      </div>
                                                  @enderror
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>   

                            <!-- End sidebar filter-->
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <button type="submit" class="btn-hapus">
                                        <span>Terapkan</span>
                                    </button>
                                    <button id="resetbtn" class="btn-hapus">
                                        <span>Reset</span>
                                    </button>
                                </div>
                            </div>
                          </div>
                        </aside>
                </form>

                <!-- End sidebar -->
                <div class="col-lg-10 entries">
                    <div class="row gy g-4">

                        <!-- File -->
                        @forelse ($file as $b)
                            <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-2">
                                <div class="card">
                                    @php
                                        if(Request::segment(1) == 'buku'){
                                            $link = 'pdf';
                                            $name = $b->filename;
                                        }else{
                                            $link = 'video';
                                            $name = "$b->filename.$b->filetype";
                                        };
                                        $name1 = $b->thumb;
                                        $ori = public_path("storage/thumb/".$link."/");
                                        $path = "/storage/thumb/".$link."/";
                                        $path1 = $ori.$name1;
                                        if ( !file_exists($path1) || empty($name1) ) {
                                            $path1 = $path."default.png";
                                        }else {
                                            $path1 = $path.$name1;
                                        };
                                    @endphp
                                    <div class="card-img">
                                        <center>
                                                <img src="{{ $path1 }}" class="img-fluid" alt="">
                                        </center>
                                    </div>
                                    <div class="social">
                                        <a href="{{ Storage::url('public/').$link.'/'.$name }}" download><i class="ri-@if(Request::segment(1) == 'buku'){{'file'}}@else{{'video'}}@endif-download-fill"></i></a>
                                        <a href="@if(Request::segment(1) == 'buku'){{ '/pdfViewer/'.$b->id }}@else{{'/video/'.$b->id}}@endif"><i class="ri-eye-fill"></i></a>
                                    </div>
                                    <div class="card-info">
                                        {{-- <h5>{{ substr($b->title, 0, 16) . '...' }}</h5> --}}
                                        <h1 data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $b->title }}">
                                            {{ $b->title }}
                                        </h1>
                                        <h6>
                                            @empty ($b->getGrade || $b->getEdu)
                                            
                                            @else
                                            {{ 'Kelas ' . $b->getGrade->grade_name . ' ' . $b->getEdu->edu_name }}
                                            @endif
                                        </h6>
                                        <div class="btn-file">
                                            <span>{{ strtoupper($b->filetype) }}</span>
                                        </div>
                                        <div class="stat-content">
                                            <a href="" class="">dilihat {{ $b->clicked_time }} kali</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                        <center>
                            <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                            <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_mk6o3c37.json"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop  autoplay></lottie-player>
                        </center>
                            <div class="not-found">Tidak Ada File</div>
                        @endforelse

                        <!-- Pagination -->
                        <div class="pagination d-flex justify-content-center mt-3">
                            {{ $file->appends(request()->query())->links() }}
                        </div>
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
@section('ext-js')
    <script src="/assets/adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script src="/assets/adminlte/plugins/select2/js/select2.min.js"></script>
    <script type="text/javascript">
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
        $("#mapel").select2({
            dropdownCssClass: "myFont"
        });
        $("#jurusan").select2({
            dropdownCssClass: "myFont"
        });
        $("#resetbtn").on('click', function(e) {
            e.preventDefault();
            $("#filters").trigger("reset");
        });
    </script>
@endsection
