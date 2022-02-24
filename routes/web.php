<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Perpus Front - End
Route::get('/', 'HomeController@index');
Route::get('/buku', 'HomeController@book')->name('buku');
Route::get('/video', 'HomeController@video')->name('video');
Route::get('/profile', 'HomeController@showprofile')->name('profile');
Route::get('/panduan', 'HomeController@showpanduan')->name('panduan');
Route::get('/showpdf/{book}', 'HomeController@showpdf')->name('showpdf');
Route::get('/videoplayer', 'HomeController@videoplayer')->name('videoplayer');
Route::get('/pagination', 'HomeController@pagination')->name('pagination');

//Admin Back-End
Route::middleware('auth')->group(function () {
    Route::prefix('admin')->middleware('admin')->group(function () {
        Route::get('/', 'Admin@index');
        // CMS
        Route::resource('buku', 'BookController');
        Route::resource('user', 'UserController');
        Route::post('user-store', 'UserController@storeOne')->name('user-store');
        Route::resource('grade', 'GradeController');
        Route::resource('jurusan', 'MajorController');
        Route::resource('mapel', 'SubjectController');
        Route::resource('sekolah', 'SchoolController');
        // Route::resource('riwayat', 'HistoryController');
        Route::resource('pendidikan', 'EducationController');
        Route::resource('permission', 'PermissionController');
        // Video CMS
        Route::resource('video', 'VideoController');
        // -- video Upload File --
        Route::get('/video/{video}/upload','VideoController@upload')->name('video.upload');
        Route::post('/video/{video}/uploadFile','VideoController@uploadFile')->name('video.uploads');
        Route::get('/video/{video}/edit-file','VideoController@editFile')->name('video.editfile');
        Route::put('/video/{video}/update','VideoController@updateFile')->name('video.updatefile');

    });
    Route::get('/riwayat/{user}', 'HistoryController@show');
    Route::get('/profile/{user}', 'UserController@profile');
    Route::post('/reset', 'UserController@reset');
});
Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);
//DataTable Needs
Route::get('/user/all', 'UserController@data');
Route::get('/sekolah/all', 'SchoolController@data');
Route::get('/pendidikan/all', 'EducationController@data');
Route::get('/kelas/all','GradeController@data');
Route::get('/jurusan/all','MajorController@data');
Route::get('/mapel/all','SubjectController@data');
Route::get('/buku/all', 'BookController@data');
Route::get('/video/all', 'VideoController@data');
Route::get('/akses/{school}','PermissionController@data');
Route::get('/cek/{buku}','SubjectController@check');
// Route::get('/pdfViewer?file={buku}','HomeController@viewer');
Route::get('/pdfViewer/{buku}', 'HomeController@viewer');
Route::get('/file/{buku}', 'HomeController@file');
Route::get('/gs', 'BookController@trial');
