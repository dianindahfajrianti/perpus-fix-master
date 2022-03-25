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
Route::get('/pdfViewer/{buku}', 'HomeController@viewer');
Route::get('/videoplayer/{video}', 'HomeController@videoplayer')->name('videoplayer');
Route::get('/pagination', 'HomeController@pagination')->name('pagination');
Route::get('/search', 'HomeController@search')->name('search');


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
        // Video CMS
        Route::resource('video', 'VideoController');
        // -- video Upload File --
        Route::get('/video/{video}/upload','VideoController@upload')->name('video.upload');
        Route::post('/video/{video}/uploadFile','VideoController@uploadFile')->name('video.uploads');
        Route::get('/video/{video}/edit-file','VideoController@editFile')->name('video.editfile');
        Route::post('/video/{video}/update','VideoController@updateFile')->name('video.updatefile');
        // Akses || Permissions
        Route::get('/akses','PermissionController@index');
        // Pilih Sekolah
       Route::get('/akses/{school}', 'PermissionController@showfilesekolah');
         // Buku
        Route::get('/akses/{school}/buku','PermissionController@showBook');
        Route::post('/akses/{school}/buku','PermissionController@storeBook');
        Route::delete('/akses/{school}/buku','PermissionController@destroyBook');
        // Video
        Route::get('/akses/{school}/video','PermissionController@showVideo');
        Route::post('/akses/{school}/video','PermissionController@storeVideo');
        Route::delete('/akses/{school}/video','PermissionController@destroyVideo');
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
Route::get('/akses/buku/{school}','PermissionController@dataBook');
Route::get('/akses/video/{school}','PermissionController@dataVideo');
Route::get('/video/all', 'VideoController@data');

// Datatable Akses
Route::get('/sekolah/{school}/buku','PermissionController@books');
Route::get('/sekolah/{school}/video','PermissionController@videos');

//Edge Server Needs

Route::get('/user/{school}','UserController@export')->name('export.user');
Route::get('/buku/{school}','BookController@export')->name('export.book');
Route::get('/video/{school}','VideoController@export')->name('export.video');
Route::get('/filter/{school}','HomeController@export')->name('export.filter');