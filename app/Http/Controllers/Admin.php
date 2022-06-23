<?php

namespace App\Http\Controllers;

use App\Book;
use App\User;
use App\Grade;
use App\Major;
use App\Video;
use App\School;
use App\Education;
use App\Subject;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use stdClass;

class Admin extends Controller
{

    public function __construct()
    {
        //Do your magic here
        $this->middleware('auth');
    }

    public function index()
    {
        $res = new stdClass;
        if (Auth::user()->role < 1) {
            $book = Book::count();
            $vid = Video::count();
            $school = School::count();
            $user = User::select(DB::raw('COUNT(id) as totidu'))->get();
            // $view = compact('book','vid','user','school');
            $view = view('admin.index',compact('book','vid','user','school'));
        }else {
            //get edu_id
            $edu = DB::table('schools')->where('id','=',Auth::user()->school_id)->value('edu_id');
            $sch = Auth::user()->school_id;
            $scale = [
                'id' => $sch
            ];
            $book = Book::whereHas('schools',function($query) use ($scale){
                $query->where('id',$scale);
            })->count();
            $vid = Video::whereHas('schools',function($query) use ($scale){
                $query->where('id',$scale);
            })->count();
            $user = User::select(DB::raw('COUNT(id) as totidu'))->where('school_id','=',Auth::user()->school_id)->get();

            // $view = compact('book','vid','user');
            $view = view('admin.index',compact('book','vid','user'));
        }
        return $view;
    }
    public function getID()
    {
        $role = request('r');
        if ($role <= 2) {
            $wordID = "A";
        }else {
            $wordID = "U";
        }
        $fromDB = DB::table('users')->where('id','like',$wordID."%")->orderBy('id', 'DESC')->value('id');
        
        if ($fromDB == null) {
            $last = (int) "00001";
        } else {
            $last = substr($fromDB, 1, 5) + 1;
        }
        
        $id = $wordID . sprintf('%05s', $last);
        return $id;
    }

    public function sch(Education $edu)
    {
        $scale = [
            'id' => $edu->id
        ];
        $model = School::whereHas('hasEdu',function($query) use ($scale){
            $query->where($scale);
        })->get();
        return $model;
    }
    public function gr(School $school)
    {
        $edu = Education::where('id',$school->edu_id)->first();
        $name = $edu->edu_name;
        if($name === 'SD' || $name === 'MI'){
            $kls = Grade::where('grade_name','<=',6)->get();
        }
        if($name === 'SMP' || $name === 'Mts'){
            $kls = Grade::where('grade_name','>=',7)
            ->where('grade_name','<=',9)->get();
        }
        if($name === 'SMA' || $name === 'SMK' || $name === 'MA'){
            $kls = Grade::where('grade_name','>=',10)
            ->where('grade_name','<=',12)
            ->get();
        };
        return $kls;
    }

    public function maj()
    {
        return Major::all();
    }
    public function sub(Major $major)
    {
        $scale = [
            'id' => $major->id
        ];
        $model = Subject::whereHas('hasMajor',function($query) use ($scale){
            $query->where($scale);
        })->get();
        return $model;
    }
}
