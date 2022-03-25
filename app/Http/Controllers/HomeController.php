<?php

namespace App\Http\Controllers;

use App\Book;
use App\Grade;
use App\Major;
use App\Video;
use App\School;
use App\Subject;
use App\Education;
use Illuminate\Support\Facades\DB;

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

        return view('home.file', compact('sub', 'edu','file'));
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

        return view('home.file', compact('sub', 'edu','file'));
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

    public function export(School $school)
    {
        $id = $school->edu_id;
        $sid = $school->id;
        $edu = Education::where('id',$id)->get();
        $eduname = DB::table('education')->where('id',$id)->value('edu_name');
        if ($eduname == 'SD') {
            $gr = Grade::where('grade_name','<','7')->get();
        }elseif ($eduname == 'SMP') {
            $gr = Grade::
                    where('grade_name','>=','7')
                    ->where('grade_name','<=','9')
                    ->get();
        }elseif ($eduname == 'SMA') {
            $gr = Grade::
                  where('grade_name','>=','10')
                  ->where('grade_name','<=','12')
                  ->get();
        }
        $maj = Major::where('maj_name','Umum')->get();
        $maj_id = DB::table('majors')->where('maj_name','Umum')->value('id');
        $sub = Subject::where('parent_id',$maj_id)->get();
        $sch = School::where('id',$sid)->get();
        $filters = [
            'edu' => $edu,
            'grade' => $gr,
            'jur' => $maj,
            'sub' => $sub,
            'school' => $sch
        ];
        return response()->json($filters);
    }
}
