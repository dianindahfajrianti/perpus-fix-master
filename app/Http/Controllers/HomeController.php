<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Singlepage;


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
        return view('home.file');
    }
}
