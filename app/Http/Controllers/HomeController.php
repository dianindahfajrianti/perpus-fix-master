<?php

namespace App\Http\Controllers;

use App\Education;
use App\Grade;
use Illuminate\Http\Request;
use App\Singlepage;
use App\Subject;

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
        return view('home.index');
    }
    public function info()
    {
        return phpinfo();
    }
    public function showfile()
    {
        $sub = Subject::all();
        $edu = Education::all();

        return view('home.file', compact('sub', 'edu'));
    }
    public function showprofile()
    {
        return view('home.profile');
    }
    public function showpanduan()
    {
        return view('home.panduan');
    }
    public function showpdf()
    {
        return view('home.showpdf');
    }
}
