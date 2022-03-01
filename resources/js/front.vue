<template>
    @php
    function numberToRomanRepresentation($number) {
    $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
    $returnValue = '';
    while ($number > 0) {
    foreach ($map as $roman => $int) {
    if($number >= $int) {
    $number -= $int;
    $returnValue .= $roman;
    break;
    }
    }
    }
    return $returnValue;
    }
    @endphp
    <div class="container" :class="{'loading': loading}">
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
                    <h3 class="sidebar-title">Search</h3>
                    <div class="sidebar-item search-form">
                        <form action="/buku">
                            <input type="text" placeholder="cari judul..." name="search" value="{{ request('search') }}">
                            <button type="submit">
                            <i class="bi bi-search"></i>
                            </button>
                        </form>
                    </div>
                    <!-- End sidebar search form-->
                    <!-- jenjang -->
                    <h3 class="sidebar-title">Jenjang</h3>
                    <div class="sidebar-item filter">
                        <div class="form-check" v-for="(edu, index) in pendidikan">
                            <input value="e.id" class="form-check-input" type="radio" name="jenjang" id="'jenjang'+index" v-model="seleced.pendidikan">
                            <label class="form-check-label" for="'jenjang' + index">
                            {{ $e->edu_name }}
                            </label>
                            </a>
                        </div>
                    </div>
                    <!-- kelas -->
                    <h3 class="sidebar-title">Kelas</h3>
                    <div class="sidebar-item filter">
                        <div class="row">
                            <div class="col-6">
                                @for ($i = 1; $i < 7; $i++) <div class="form-check" v-for="(grade, index) in kelas">
                                    <input value="i" class="form-check-input" type="radio" name="kelas" id="'kelas'+index" v-model="selected.kelas">
                                    <label class="form-check-label" for="'kelas' + index">
                                    {{ numberToRomanRepresentation($i) }}
                                    </label>
                                </div>
                                @endfor
                            </div>
                            <div class="col-6">
                                @for ($i = 7; $i < 13; $i++) <div class="form-check" v-for="(grade, index) in kelas">
                                <input value="i" class="form-check-input" type="radio" name="kelas" id="'kelas'+index" v-model="selected.kelas">
                                <label class="form-check-label" for="'kelas' + index">
                                    {{ numberToRomanRepresentation($i) }}
                                </label>
                                </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <!-- mapel -->
                    <h3 class="sidebar-title" for="mapel">Mata Pelajaran</h3>
                    <div class="sidebar-item filter">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group" v-for="(subject, index) in mapel">
                                <!-- <label class="form-label" for="mapel">Mata Pelajaran</label> -->
                                <div class="input-group">
                                    <select name="mapel" class="form-control select2bs4 @error('mapel'){{ 'is-invalid' }}@enderror" id="'mapel'+index" v-model="selected.mapel" aria-label="">
                                    <option value="">-- Pilih Mata Pelajaran --</option>
                                    @foreach ($sub as $sbj )
                                    <option @if(old('mapel')==$sbj->id){{ 'selected' }}@endif value="{{ $sbj->id }}">{{ $sbj->sbj_name }}</option>
                                    @endforeach
                                    </select>
                                    @error('mapel')
                                    <div class="invalid-feedback">
                                    {{$message}}
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
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                pendidikan: [],
                kelas: [],
                mapel: [],
                files: [],
                loading: true,
                selected: {
                    pendidikan: [],
                    kelas: [],
                    mapel: []
                }
            }
        },

        mounted() {
            this.loadKelas();
            this.loadMapel();
            this.loadPendidikan();
            this.loadFiles();
        },

        watch: {
            selected: {
                handler: function () {
                    this.loadKelas();
                    this.loadMapel();
                    this.loadPendidikan();
                    this.loadFiles();
                },
                deep: true
            }
        },

        methods: {
            loadKelas: function () {
                axios.get('/api/kelas', {
                        params: _.omit(this.selected, 'kelas')
                    })
                    .then((response) => {
                        this.kelas = response.data.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },

            loadFiles: function () {
                axios.get('/api/files', {
                        params: this.selected
                    })
                    .then((response) => {
                        this.files = response.data.data;
                        this.loading = false;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },

            loadMapel: function () {
                axios.get('/api/mapel', {
                        params: _.omit(this.selected, 'mapel')
                    })
                    .then((response) => {
                        this.mapel = response.data.data;
                        this.loading = false;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },

            loadPendidikan: function () {
                axios.get('/pendidikan', {
                        params: _.omit(this.selected, 'pendidikan')
                    })
                    .then((response) => {
                        this.pendidikan = response.data;
                        this.loading = false;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        }
    }
</script>
