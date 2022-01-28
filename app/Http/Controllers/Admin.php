<?php

namespace App\Http\Controllers;

use App\Book;
use App\Counter;
use App\School;
use App\User;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Admin extends Controller
{

    public function __construct()
    {
        //Do your magic here
        $this->middleware('auth');
    }

    public function index()
    {

        if (Auth::user()->role < 1) {
            $book = Book::select(DB::raw('COUNT(id) as totidb'))->get();
            $vid = Video::select(DB::raw('COUNT(id) as totidv'))->get();
            $school = School::select(DB::raw('COUNT(id) as totids'))->get();
            $user = User::select(DB::raw('COUNT(id) as totidu'))->get();
            // $view = compact('book','vid','user','school');
            $view = view('admin.index',compact('book','vid','user','school'));
        }else {

            $book = Book::select(DB::raw('COUNT(id) as totidb'))->where('school_id','=',env('SCHOOL_ID'))->get();
            $vid = Video::select(DB::raw('COUNT(id) as totidv'))->where('school_id','=',env('SCHOOL_ID'))->get();
            $user = User::select(DB::raw('COUNT(id) as totidu'))->where('school_id','=',env('SCHOOL_ID'))->get();
            // $view = compact('book','vid','user');
            $view = view('admin.index',compact('book','vid','user'));
        }
        return $view;
    }
}
