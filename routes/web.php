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
Route::get('/file', 'HomeController@showfile')->name('file');
Route::get('/profile', 'HomeController@showprofile')->name('profile');

//Admin Back-End
Route::get('admin', 'Admin@index');
Route::middleware('auth')->group(function () {
    Route::prefix('admin')->group(function () {
        // CMS
        Route::resource('buku', 'BookController');
        Route::resource('user', 'UserController');
        Route::resource('kelas', 'GradeController');
        Route::resource('video', 'VideoController');
        Route::resource('jurusan', 'MajorController');
        Route::resource('mapel', 'SubjectController');
        Route::resource('sekolah', 'SchoolController');
        Route::resource('riwayat', 'HistoryController');
        Route::resource('pendidikan', 'EducationController');
        Route::post('user/storeOne', 'UserController@storeOne');
        
    });
    Route::get('riwayat/{user}', 'HistoryController@show');
    Route::get('profile/{user}', 'UserController@profile');
});
Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);
//DataTables get
Route::get('/buku/all','BookController@data');
Route::get('/user/all', 'UserController@data');
Route::get('/sekolah/all', 'SchoolController@data');
Route::get('/buku/all','BookController@data');
Route::get('/pendidikan/all', 'EducationController@data');
Route::get('/sekolah/all', 'SchoolController@data');