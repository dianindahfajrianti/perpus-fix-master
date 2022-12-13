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
                                <div class="row">
                                    <div class="col-12">
                                        @foreach ($edu as $ed => $e)
                                            <div class="form-check">
                                                <input value="{{ old('jenjang', $e->id) }}" class="form-check-input d-inline" type="radio" name="jenjang1" id="jenjang1-{{ $ed }}"/>
                                                <label class="form-check-label" for="jenjang1-{{ $ed }}">{{ $e->edu_name }}</label>
                                            </div>
                                        @endforeach
                                        <input type="hidden" name="jenjang" id="jenjang" hidden />
                                    </div>
                                </div>
                              </div>
                              <!-- Kelas -->
                              <h3 class="sidebar-title">Kelas</h3>
                              <div class="sidebar-item filter">
                                  <div class="row">
                                      <div class="col-12 col-kelas">
                                        <div class="form-check">
                                            {{-- <input value="" class="form-check-input" type="radio" name="kelas1" id="kelas1" />
                                            <label class="form-check-label" for="kelas1"></label> --}}
                                        </div>
                                      </div>
                                    <input type="hidden" name="kelas" id="kelas" hidden />
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
                              <h3 class="sidebar-title" for="jurusan1">Jurusan</h3>
                              <div class="sidebar-item filter">
                                  <div class="row">
                                      <div class="col-12">
                                          <div class="form-group">
                                              <div class="input-group">
                                                  <select name="jurusan1" class="form-control select2bs4 @error('jurusan') {{ 'is-invalid' }} @enderror" id="jurusan1" aria-label="">
                                                      <option value="">-- Pilih Jurusan --</option>
                                                      @foreach ($maj as $mjr)
                                                          <option @if (old('jurusan') == $mjr->maj_name) {{ 'selected' }} @endif value="{{ $mjr->id }}">{{ $mjr->maj_name }}</option>
                                                      @endforeach
                                                  </select>
                                                  @error('jurusan')
                                                      <div class="invalid-feedback">
                                                          {{ $message }}
                                                      </div>
                                                  @enderror
                                              </div>
                                            <input type="hidden" name="jurusan" id="jurusan" hidden>
                                          </div>
                                      </div>
                                  </div>
                              </div>   
                              <!-- Mapel -->
                              <h3 class="sidebar-title" for="mapel1">Mata Pelajaran</h3>
                              <div class="sidebar-item filter">
                                  <div class="row">
                                      <div class="col-12">
                                          <div class="form-group">
                                              <div class="input-group">
                                                  <select name="mapel1" class="form-control select2bs4 @error('mapel') {{ 'is-invalid' }} @enderror" id="mapel1" aria-label="">
                                                      <option value="">-- Pilih Mata Pelajaran -</option>
                                                      {{-- @foreach ($sub as $sbj)
                                                          <option @if (old('mapel') == $sbj->sbj_name) {{ 'selected' }} @endif value="{{ $sbj->sbj_name }}">{{ $sbj->sbj_name }}</option>
                                                      @endforeach --}}
                                                  </select>
                                                  @error('mapel')
                                                      <div class="invalid-feedback">
                                                          {{ $message }}
                                                      </div>
                                                  @enderror
                                              </div>
                                            <input type="hidden" name="mapel" id="mapel">
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
                                    <a href="@if(Request::segment(1) == 'buku'){{ '/pdfViewer/'.$b->id }}@else{{'/video/'.$b->id}}@endif">
                                        <div class="card-img">
                                            <center>
                                                    <img src="{{ $path1 }}" class="img-fluid" alt="">
                                            </center>
                                        </div>
                                    </a>
                                    <div class="social">
                                        <a href="/buku/{{ $b->id }}/download" download><i class="ri-@if(Request::segment(1) == 'buku'){{'file'}}@else{{'video'}}@endif-download-fill"></i></a>
                                        <a href="@if(Request::segment(1) == 'buku'){{ '/pdfViewer/'.$b->id }}@else{{'/video/'.$b->id}}@endif"><i class="ri-eye-fill"></i></a>
                                    </div>
                                    <div class="card-info">
                                        {{-- <h5>{{ substr($b->title, 0, 16) . '...' }}</h5> --}}
                                        <h1 data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $b->title }}">
                                            {{ $b->title }}
                                        </h1>
                                        <h6>
                                            @if($b->grades !== null || $b->education !== null)
                                            {{ "Kelas ".$b->grades->grade_name." ".$b->education->edu_name}}
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
        $(document).ready(function() {
            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });
            $("#mapel1").select2({
                dropdownCssClass: "myFont"
            });
            $("#jurusan1").select2({
                dropdownCssClass: "myFont"
            });
            $("#resetbtn").on('click', function(e) {
                e.preventDefault();
                $("#filters").trigger("reset");
                $('#jurusan').select2('val','All');
                $('#mapel').select2('val','All');
            });

            $('input[name=jenjang1]').on('change',function(e) {
                e.preventDefault();
                var eduID = $(this).val();
                var name = $('label[for="' + this.id + '"]').text();
                $('#jenjang').val(name);
                $.ajax({
                    url: '/gr/'+eduID,
                    type: "GET",
                    // success:function(data){
                    //     console.log(data);
                    // },error:function(data){
                    //     console.log(data);
                    // }
                    success:function(data)
                    {
                        if(data){
                        console.log(data);
                        $('.col-kelas').empty();
                        $.each(data, function(id, kelas){
                            var formCheck = $('<div></div>');
                            formCheck.addClass('form-check');
                            $('.col-kelas').append(formCheck);
                            formCheck.append('<input value="'+ id +'" class="form-check-input" type="radio" name="kelas1" id="kelas1-'+id+'" />');
                            formCheck.append('<label class="form-check-label" for="kelas1-'+id+'">' + kelas.grade_name+ '</label>');
                        });
                    }else{
                        $('.col-kelas').empty();
                    }
                    }
                });
            });

            $('input[name=kelas1]').on('change',function(e) {
                e.preventDefault();
                var name = $('label[for="' + this.id + '"]').text();
                $('#kelas').val(name);
            })

            $('#jurusan1').on('change', function() {
                var jurusanID = $(this).val();
                var jurname = $('#jurusan1 option:selected').text();
                $('#jurusan').val(jurname);

                if(jurusanID) {
                    console.log(jurname);
                    $.ajax({
                        url: '/sub/'+jurusanID,
                        type: "GET",
                        data : {"_token":"{{ csrf_token() }}"},
                        dataType: "json",
                        success:function(data)
                        {
                            if(data){
                            console.log(data);
                            $('#mapel1').empty();
                            $('#mapel1').append('<option value="" hidden>-- Pilih Mata Pelajaran -</option>'); 
                            $.each(data, function(id, mapel){
                                $('select[name="mapel1"]').append('<option value="'+ id +'">' + mapel.sbj_name+ '</option>');
                            });
                        }else{
                            $('#mapel').empty();
                        }
                        }
                    });
                }else{
                    $('#mapel').empty();
                }
            });
            // $('input').change(function() {
            //     if (this.checked) {
            //         var response = $('label[for="' + this.id + '"]').html();
            //     }
            // });
            const urlSearchParams = new URLSearchParams(window.location.search);
            const params = Object.fromEntries(urlSearchParams.entries());
            if (params) {
                let edu = $("input[name=jenjang1]:checked");
                let eduv = edu.attr("value");
                console.log(`${params.jenjang1}
                ${eduv}`);
                let grade = $("input[name=kelas1]:checked");
                let gradev = grade.attr("value");
                let maj = $("input[name=jurusan1]:checked");
                let majval = maj.attr("value");
                let sub = $("input[name=mapel1]:checked");
                let subval= sub.attr("value");
                if (params.jenjang1 = eduv) {
                    edu.attr("checked",true);
                }
            }
        });
    </script>
@endsection
