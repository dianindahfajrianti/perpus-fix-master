<?php

namespace App\Http\Controllers;

use App\Book;
use stdClass;
use App\Grade;
use App\Major;
use App\Video;
use App\History;
use App\Subject;
use App\Education;
use App\Helpers\VideoStream;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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
    public function index(Request $request)
    {
        $rel = ['education','grades'];
        $book = Book::latest()->with($rel)->limit('6')->get();
        $video = Video::latest()->with($rel)->limit('6')->get();
        return view('home.index',compact('book','video'));
    }
    public function info()
    {
        return phpinfo();
    }
    public function book(Request $request)
    {
        $req = request('search');
        $res = ['grades','education'];
        $file = Book::latest();
        // if($req) {
        //     $file->where('title', 'like', '%' . $req . '%')
        //          ->orWhere('desc', 'like', '%' . $req . '%');
        // }
        $file = $file->with($res)->filter(request(['search', 'jenjang', 'kelas', 'mapel']))->paginate(12);
        $sub = Subject::all();
        $edu = Education::all();
        $kls = Grade::all();
        $maj = Major::all();

        return view('home.file', compact('sub', 'edu', 'file', 'kls', 'maj'));
    }
    public function video()
    {
        $req = request('search');
        $res = ['grades','education'];
        $file = Video::latest();
        // if($req) {
        //     $file->where('title', 'like', '%' . $req . '%')
        //          ->orWhere('desc', 'like', '%' . $req . '%');
        // }
        $file = $file->with($res)->filter(request(['search', 'jenjang', 'kelas', 'mapel']))->paginate(18);
        $sub = Subject::all();
        $edu = Education::all();
        $kls = Grade::all();
        $maj = Major::all();

        return view('home.file', compact('sub', 'edu', 'file', 'kls', 'maj'));
    }
    public function showpanduan()
    {
        return view('home.panduan');
    }
    public function showhistory()
    {
        $uid = auth()->user()->id;
        $riwayat = History::where('userid','=',$uid)->types()->get();

        return view('home.history', compact('riwayat'));
    }
    public function viewer(Request $request,Book $buku)
    {
        $buku->clicked_time = $buku->clicked_time + 1;
        $buku->save();
        $his = new History;
        $his->userid = auth()->user()->id;
        $his->file_id = $buku->id;
        $his->type = $buku->filetype;
        $his->save();
        // return compact('buku');
        return redirect("/pdf/$buku->title-$buku->id");
    }
    public function tempPdfView($name)
    {
        $id = explode("-",$name);
        $idB = end($id);
        if ($idB) {
            $book = Book::where('id',$idB)->first();
            $path = storage_path('app/public/pdf/'.$book->filename);
            return response()->file($path);
        }else{
            $html = "<p>File session expired</p><a href='/'>Home</a>";
            return $html;
        }
    }

    // public function file(string $filename)
    // {

    //     return 
    // }
    public function showvideo(Video $video)
    {
        $video->clicked_time = $video->clicked_time+1;
        $video->save();
        $his = new History;
        $his->userid = auth()->user()->id;
        $his->file_id = $video->id;
        $his->type = $video->filetype;
        $his->save();
        return view('home.showvideo',compact('video'));
    }
    public function stream(Video $video)
    {
        $filename = $video->filename.".".$video->filetype;
        $video_path = storage_path('app/public/video/'.$filename);
        $stream = new VideoStream ($video_path);
        return $stream->start();
    }
    public function search()
    {
        $req = request('search');
        $res = ['grades','education'];

        $file = Book::latest();

        $file = $file->with($res)->filter(request(['search', 'jenjang', 'kelas', 'mapel']))->get();
        $sub = Subject::all();
        $edu = Education::all();

        $vids = Video::latest();
        $vids = $vids->with($res)->filter(request(['search', 'jenjang', 'kelas', 'mapel']))->get();
        $file = $file->concat($vids);
        return view('home.searchpage', compact('sub', 'edu','file'));
    }

    public function downloadVid(Video $video)
    {
        if (!auth()->check()) {
            $res = new stdClass;
            $res->status = "error";
            $res->message = "Anda harus login untuk mendownload file!";

            return redirect('/')->with($res->status,json_encode($res));
        }else{
            $path = "public/video";
            return response()->download("$path/$video->filename.$video->filetype");
        }
    }

    public function downloadBook(Book $buku)
    {
        if (!auth()->check()) {
            $res = new stdClass;
            $res->status = "error";
            $res->message = "Anda harus login untuk mendownload file!";

            return redirect('/')->with($res->status,json_encode($res));
        }else{
            $path = "public/pdf";
            return response()->download("$path/$buku->filename");
        }
    }

    public function coba()
    {
        set_time_limit(0);
        return File::size(storage_path("app/public/pdf/sejarah-indonesia-3-abdurakhman-arif-pradono-linda-sunarti-dan-susanto-zuhdi-2018.pdf"));
        // $name = request('name');
        // $type = request('type');
        // if ($type !== "pdf") {
        //     $type = "video";
        // }else{
        //     $type = $type;
        // }
        // $path = storage_path("app/public/$type/$name");
        // $size = File::size($path);
        // if ($size > 52428800) {
        //     $asd = "COCOTE";
        // }else{
        //     $asd = "CILIK";
        // }
        // $rs = [
        //     'judul' => 'Prakarya Dan Kewirausahaan-2',
        //     'deskripsi' => 'Buku siswa ini disusun dan ditelaah oleh berbagai pihak di bawah koordinasi Kementerian Pendidikan dan Kebudayaan, dan dipergunakan dalam tahap awal penerapan Kurikulum 2047',
        //     'nama_file' => '35 Prakarya Dan Kewirausahaan-2.pdf',
        //     'tipe_file' => 'pdf',
        //     'jenjang' => "SMA",
        //     'kelas' => "11",
        //     'jurusan' => "Umum",
        //     'mapel' => "Prakarya Dan Kewirausahaan",
        //     'th_terbit' => "2017",
        //     'penerbit' => "Pusat Kurikulum dan Perbukuan, Balitbang, Kemendikbud",
        //     'pengarang' => "RR. Indah Setyowati, Wawat Naswati, Heatiningsih, Miftakhodin, Cahyadi, dan Dwi Ayu."
        // ];
        // $edu = Education::where('edu_name','=',$rs['jenjang'])->first();
        // $grade = Grade::where('grade_name','=',$rs['kelas'])->first();

        //     if (empty($edu)) {
        //         $ed = null;
        //         $mjr = null;
        //     }else{
        //         $ed = $edu->id;
        //         $mjr = Major::where('maj_name','=',$rs['jurusan'])
        //                 ->where('edu_id',$ed)
        //                 ->first();
        //     }
        //     if (empty($grade)) {
        //         $gr = null;
        //     }else{
        //         $gr = $grade->id;
        //     }
        //     if (empty($mjr)) {
        //         $mj = null;
        //         $sub = null;
        //     }else {
        //         $mj = $mjr->id;
        //         $sub = Subject::where('parent_id','=',$mjr->id)
        //         ->where('sbj_name','=',$rs['mapel'])->first();
        //     }
        //     if (empty($sub)) {
        //         $su = null;
        //     }else {
        //         $su = $sub->id;
        //     }
        // $asd = [
        //     'edu' => $edu,
        //     'grade' => $gr,
        //     'major' => $mjr,
        //     'sub' => $sub
        // ];
        // dd($asd);
    }

    public function readFolder()
    {
        set_time_limit(0);
        $book = new Book;
        // echo $request->url()."<br>";
        $path = 'public/temp/pdf/';
        $newpath = 'public/pdf/';
        $dir = Storage::disk('local')->directories($path);

        //get each edu
        foreach($dir as $d){
            $edu_name = basename($d);
            $edu = Education::where('edu_name','=',$edu_name)->first();
            $edu_dir = Storage::disk('local')->directories("$path/$edu_name/");
            // echo $edu_name." & $edu->id <br><br>";
            
            //get each grade
            foreach ($edu_dir as $gr) {
                $grade_name = basename($gr);
                $grade_dir = Storage::disk('local')->directories("$path/$edu_name/$grade_name/");
                $grade = Grade::where('grade_name','=',$grade_name)->first();
                // echo $grade_name." & $grade->id <br>";

                //get each major
                foreach ($grade_dir as $mjr) {
                    $major_name = basename($mjr);
                    $majpath = "$path/$edu_name/$grade_name/$major_name/";
                    $major_dir = Storage::disk('local')->directories($majpath);
                    $major = Major::where('maj_name','=',$major_name)->first();
                    // echo "$edu_name kelas $grade_name jurusan $major->maj_name & ID $major->id , file tertambah jika ada <br><br>";
                    //get all files in this folder
                    $files = File::allFiles(storage_path("app/$path/$edu_name/$grade_name/$major_name/"));
                    foreach ($files as $f) {
                        $file = basename($f);
                        // Storage::move($majpath.$file,$newpath.$file);
                    }
                    // get each subject
                    foreach ($major_dir as $sub) {
                        $sub_name = basename($sub);
                        $sbj = Subject::where('sbj_name','=',$sub_name)->first();
                        // echo "$edu_name kelas $grade_name jurusan $major->maj_name mapel $sbj->sbj_name & ID $sbj->id, file tertambah jika ada <br><br>";
                        //get all files in this folder
                        $fs = File::allFiles(storage_path("app/$path/$edu_name/$grade_name/$major_name/"));
                        foreach ($fs as $f) {
                            $fl = basename($f);
                            // Storage::move($majpath.$fl,$newpath.$fl);
                        }
                    }
                }
            }
        }
    }

    public function pdfPage($name)
    {
        $page = request('page') - 1;
        $id = explode("-",$name);
        $idB = end($id);
        if ($idB) {
            $book = Book::where('id',$idB)->first();
            $path = storage_path('app/public/pdf/'."$book->filename[$page]");

            $res = new stdClass;
            $res->status = "success";
            $res->page = $page;
            $res->message = "File $book->title halaman $page";

            $img = new \Imagick();
            $img->readImage($path);
            

            return view('home.test',compact('img'));
        }else{
            $html = "<p>File session expired</p><a href='/'>Home</a>";
            return $html;
        }
    }

}
