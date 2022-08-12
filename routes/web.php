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

Route::get('/panduan', 'HomeController@showpanduan')->name('panduan');
Route::middleware('active')->group(function () {
    Route::get('/pdfViewer/{buku}', 'HomeController@viewer');
    Route::get('/pdf/{name}','HomeController@tempPdfView');
    Route::get('/video/{video}', 'HomeController@showvideo');
    Route::get('/buku/{buku}/download', 'HomeController@downloadBook');
    Route::get('/video/{video}/download', 'HomeController@downloadVid');
    Route::get('/stream/{video}', 'HomeController@stream');
    Route::get('/show/{name}','HomeController@pdfPage');
});
Route::get('/pagination', 'HomeController@pagination')->name('pagination');
Route::get('/search', 'HomeController@search')->name('search');

//Admin Back-End
Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/', 'Admin@index');
    Route::get('/storage','StorageController@index');
    Route::delete('/storage/{name}','StorageController@destroy');
    Route::get('gid', 'Admin@getID');
    // CMS
    Route::prefix('buku')->group(function () {
        Route::post('/mass','BookController@mass');
        Route::post('/exceldata','BookController@saveExcel')->name('buku.saveExcel');
        Route::get('/xcl-download', 'BookController@downloadExcel');
        Route::get('/generate', 'BookController@generate')->name('buku.generate');
        Route::get('/dtemp','BookController@dataTemp');
        Route::delete('/temp/{buku}','BookController@delTemp');
    });

    Route::resource('buku', 'BookController');
    Route::get('/buku-import','BookController@imports')->name('buku.import');
    Route::get('/buku-excel','BookController@excel')->name('buku.excel');
    
    Route::resource('user', 'UserController');
    Route::post('user-store', 'UserController@storeOne')->name('user-store');
    Route::resource('grade', 'GradeController');
    Route::resource('jurusan', 'MajorController');
    Route::resource('mapel', 'SubjectController');
    Route::resource('sekolah', 'SchoolController');
    // Route::resource('riwayat', 'HistoryController');
    Route::resource('pendidikan', 'EducationController');
    // Special route with mass upload
    
    // Video CMS
    //Mass Upload
    Route::prefix('video')->group(function () {
        Route::post('/mass','VideoController@mass');
        Route::post('/exceldata','VideoController@saveExcel')->name('video.saveExcel');
        Route::post('/sxcl','VideoController@oneExcel')->name('video.sxcl');
        Route::post('/sgen/{bk}', 'VideoController@singleGenerate')->name('video.sgen');
        Route::get('/xcl-download','VideoController@downloadExcel');
        Route::get('/generate', 'VideoController@generate')->name('video.generate');
        Route::get('/dtemp','VideoController@dataTemp');
        Route::delete('/temp/{video}','VideoController@delTemp');
    });
    
    // -- video Upload File --
    Route::get('/video-import','VideoController@import')->name('video.import');
    Route::get('/video-excel','VideoController@excel')->name('video.excel');
    Route::get('/video/{video}/upload','VideoController@upload')->name('video.upload');
    Route::post('/video/{video}/uploadFile','VideoController@uploadFile')->name('video.uploads');
    Route::get('/video/{video}/edit-file','VideoController@editFile')->name('video.editfile');
    Route::post('/video/{video}/update','VideoController@updateFile')->name('video.updatefile');
    // -- exec FFMPEG --
    Route::get('/video/{video}/thumb','VideoController@thumb');
    // -- Resource Video --
    Route::resource('video', 'VideoController');
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
    //Jurusan
    // Route::get('/akses/{school}/jurusan','PermissionController@showMajor');
    // Route::post('/akses/{school}/jurusan','PermissionController@storeMajor');
    // Route::delete('/akses/{school}/jurusan','PermissionController@destroyMajor');
});
Route::middleware('auth')->group(function () {
    Route::get('/riwayat/{user}', 'HistoryController@show');
    Route::get('/profile', 'UserController@profile');
    Route::post('/reset', 'UserController@reset');
    Route::get('/history', 'HomeController@showhistory')->name('history');
    //DataTable Needs
    Route::get('/user/all', 'UserController@data');
    Route::get('/sekolah/all', 'SchoolController@data');
    Route::get('/pendidikan/all', 'EducationController@data');
    Route::get('/kelas/all','GradeController@data');
    Route::get('/jurusan/all','MajorController@data');
    Route::get('/mapel/all','SubjectController@data');
    Route::get('/buku/all', 'BookController@data');
    Route::get('/getvid/all', 'VideoController@data');
    Route::get('/akses/buku/{school}','PermissionController@dataBook');
    Route::get('/akses/video/{school}','PermissionController@dataVideo');
    Route::get('/akses/video/{school}','PermissionController@dataVideo');
    Route::get('/akses/jurusan/{school}','PermissionController@dataMajor');

    // Datatable Akses
    Route::get('/sekolah/{school}/buku','PermissionController@books');
    Route::get('/sekolah/{school}/video','PermissionController@videos');
});
// return condition for ajax
Route::middleware(['auth', 'admin'])->group(function () {
    //sekolah by jenjang
    Route::get('/sch/{school}','Admin@sch');
    // kelas by jenjang sekolah
    Route::get('/gr/{id}','Admin@gr');
    // all jurusan || pakai if jika perlu
    Route::get('/maj/{edu}','Admin@maj');
    // mapel per jurusan
    Route::get('/sub/{major}','Admin@sub');
});

// if (\App\User::count() > 0) {
    $param = false;
// }else{
//     $param = true;
// };

Auth::routes([
    'register' => $param, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

//Edge Server Needs
Route::prefix('export')->group(function() {
//Export Files & Data
Route::get('/user/{school}','ExportController@user')->name('export.user');
Route::get('/buku/{school}','ExportController@book')->name('export.book');
Route::get('/video/{school}','ExportController@video')->name('export.video');
Route::get('/filter/{school}','ExportController@filter')->name('export.filter');

});
//Sync Files & Data
Route::get('/sync/book/{school}','ExportController@syncBook')->name('sync.book');
Route::get('/sync/book/{school}/zip','ExportController@syncBookzip')->name('sync.bookzip');
Route::get('/sync/book/{school}/part','ExportController@syncBookpart')->name('sync.bookpart');
Route::get('/sync/video/{school}','ExportController@syncVideo')->name('sync.vid');
Route::get('/sync/video/{school}/zip','ExportController@syncVideozip')->name('sync.videozip');
Route::get('/sync/video/{school}/part','ExportController@syncVideopart')->name('sync.videopart');

Route::post('/tiket','HomeController@tiket');

Route::get('/info','HomeController@info');
Route::get('/coba/{id}','HomeController@coba');