<?php

namespace App\Http\Controllers;

use App\Book;
use App\Video;
use App\Education;
use App\Grade;
use Illuminate\Http\Request;
use App\Singlepage;
use App\Subject;
use App\Video;

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
        $book = Book::latest()->limit('6')->get();
        $video = Video::latest()->limit('6')->get();
        return view('home.index',compact('book','video'));
    }
    public function info()
    {
        return phpinfo();
    }
    public function showfile()
    {
        $sub = Subject::all();
        $edu = Education::all();
        $book = Book::where('desc','=',null)->get();

        return view('home.file', compact('sub', 'edu','book'));
    }
    public function showprofile()
    {
        return view('home.profile');
    }
    public function showpanduan()
    {
        return view('home.panduan');
    }
    public function showpdf(Book $book)
    {
        return view('home.showpdf',compact('book'));
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
        return view('home.videoplayer',compact('video'));
    }
}
