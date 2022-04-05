<?php

namespace App\Http\Controllers;

use App\Book;
use stdClass;
use App\Video;
use App\Subject;
use App\Education;
use App\Grade;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $rel = ['getEdu','getGrade'];
        $book = Book::latest()->with($rel)->limit('6')->get();
        $video = Video::latest()->with($rel)->limit('6')->get();
        return view('home.index',compact('book','video'));
    }
    public function info()
    {
        return phpinfo();
    }
    public function book()
    {
        $req = request('search');
        $res = ['getGrade','getEdu'];
        $file = Book::latest();
        // if($req) {
        //     $file->where('title', 'like', '%' . $req . '%')
        //          ->orWhere('desc', 'like', '%' . $req . '%');
        // }
        $file = $file->with($res)->filter(request(['search', 'jenjang', 'kelas', 'mapel']))->paginate(12);
        $sub = Subject::all();
        $edu = Education::all();
        $kls = Grade::all();

        return view('home.file', compact('sub', 'edu', 'file', 'kls'));
    }
    public function video()
    {
        $req = request('search');
        $res = ['getGrade','getEdu'];
        $file = Video::latest();
        // if($req) {
        //     $file->where('title', 'like', '%' . $req . '%')
        //          ->orWhere('desc', 'like', '%' . $req . '%');
        // }
        $file = $file->with($res)->filter(request(['search', 'jenjang', 'kelas', 'mapel']))->paginate(18);
        $sub = Subject::all();
        $edu = Education::all();
        $kls = Grade::all();

        return view('home.file', compact('sub', 'edu', 'file', 'kls'));
    }
    public function showprofile()
    {
        return view('home.profile');
    }
    public function showpanduan()
    {
        return view('home.panduan');
    }
    public function viewer(Book $buku)
    {
        $buku->clicked_time = $buku->clicked_time + 1;
        $buku->save();
        // return compact('buku');

        return redirect('/laraview/#../storage/pdf/'.$buku->filename);
    }
    // public function file(string $filename)
    // {

    //     return 
    // }
    public function videoplayer(Video $video)
    {
        $video->clicked_time = $video->clicked_time+1;
        $video->save();
        return view('home.videoplayer',compact('video'));
    }
    public function search()
    {
        $req = request('search');
        $res = ['getGrade','getEdu'];

        $file = Book::latest();

        $file = $file->with($res)->filter(request(['search', 'jenjang', 'kelas', 'mapel']))->get();
        $sub = Subject::all();
        $edu = Education::all();

        $vids = Video::latest();
        $vids = $vids->with($res)->filter(request(['search', 'jenjang', 'kelas', 'mapel']))->get();
        $file = $file->concat($vids);
        return view('home.searchpage', compact('sub', 'edu','file'));
    }

    public function tiket()
    {
        $res = new stdClass;
        $now = request('now')+1;
        $res->status = "success";
        $res->nomor = $now;
        return response()->json($res);
    }
}
