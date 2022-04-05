@extends('layouts.main')

@section('container')

<!-- ======= Breadcrumbs ======= -->
<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Panduan</h2>
            <ol>
                <li><a href="/">Home</a></li>
                <li>Panduan</li>
            </ol>
        </div>
    </div>
</section>
<!-- End Breadcrumbs -->

<!-- ======= Panduan ======= -->
<section id="panduan" class="panduan">

    <div class="container" data-aos="fade-up">
        <h1>Super Admin</h1>
        <div class="row">
            <div class="col-lg-5 d-flex align-items-center justify-content-center">
                <img src="/assets/perpus/assets/img/super-admin.png" alt="">
            </div>
            <div class="col-lg-7 d-flex align-items-center">
                <p>Super Admin untuk Dinas Profinsi/Dinas Kota, dimana super admin dapat menambahkan sekolah, menambahkan buku dan menambahkan multimedia tiap sekolah.</p>
            </div>
        </div>
    </div>

    <div class="container" data-aos="fade-up">
        <h1>Sekolah</h1>
        <div class="row">
            <div class="col-lg-7 d-flex align-items-center">
                <p>Jika sekolah belum terdaftar di aplikasi online ini, dapat mendaftar terlebih dahulu dengan menghubungi super admin. Dimana setelah sekolah terdaftar, sekolah akan mendapatkan username dan password. Setelah masuk, sekolah dapat menambahkan user (guru dan murid), buku dan multimedia. Sebelum menambahkan user, sekolah harus melengkapi data jurusan terlebih dahulu dengan menginputnya dibagian admin pada menu jurusan.</p>
            </div>
            <div class="col-lg-5 d-flex align-items-center justify-content-center">
                <img src="/assets/perpus/assets/img/sekolah.png" alt="">
            </div>
        </div>
    </div>

    <div class="container" data-aos="fade-up">
        <h1>Guru</h1>
        <div class="row">
            <div class="col-lg-5 d-flex align-items-center justify-content-center">
                <img src="/assets/perpus/assets/img/guru.png" alt="">
            </div>
            <div class="col-lg-7 d-flex align-items-center">
                <p>Jika Bapak/Ibu guru sudah di daftarkan oleh sekolah, disarankan untuk masuk akun dengan menggunakan username dan password yang sudah di berikan oleh pihak sekolah. Setelah masuk, guru dapat menambahkan buku atau multimedia dan menambahkan siswa sesuai sekolah yang terdaftar.</p>
            </div>
        </div>
    </div>

    <div class="container" data-aos="fade-up">
        <h1>Siswa</h1>
        <div class="row">
            <div class="col-lg-7 d-flex align-items-center">
                <p>Jika siswa SD, SMP, SMA ataupun SMK sudah di daftarkan oleh sekolah/guru, disarankan untuk masuk akun dengan menggunakan username dan password yang sudah di berikan oleh pihak sekolah/guru. Dengan begitu siswa dapat mengakses (memilih, membaca, dan mengunduh) buku dan multimedia yang terdapat di sekolah masing-masing, sehingga dapat memudahkan proses pembelajaran.</p>
            </div>
            <div class="col-lg-5 d-flex align-items-center justify-content-center">
                <img src="/assets/perpus/assets/img/murid.png" alt="">
            </div>
        </div>
    </div>

    <div class="container" data-aos="fade-up">
        <h1>Umum</h1>
        <div class="row">
            <div class="col-lg-5 d-flex align-items-center justify-content-center">
                <img src="/assets/perpus/assets/img/umum.png" alt="">
            </div>
            <div class="col-lg-7 d-flex align-items-center">
                <p>Jika anda belum memiliki akun, anda tetap dapat mengakses buku dan multimedia dengan status umum.</p>
            </div>
        </div>
    </div>
</section><!-- End Buku Section -->

<main id="main">
@endsection