<?php

namespace App\Http\Controllers;

use App\Book;
use stdClass;
use App\Grade;
use App\Major;
use App\Subject;
use App\TempBook;
use App\Education;
use App\Exports\TempBook as ExportsTempBook;
use App\Imports\TempBook as ImportsTempBook;
use Spatie\PdfToImage\Pdf;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Org_Heigl\Ghostscript\Ghostscript;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $edu = Education::all();
        $maj = Major::all();
        $sub = Subject::all();
        $kls = Grade::all();
        return view('book.index',compact('edu','maj','sub', 'kls'));
    }

    public function data()
    {
        $rl = Auth::user()->role;
        $scale = [
            'id' => Auth::user()->school_id
        ];
        if ($rl < 1) {
            $model = Book::with(['getEdu', 'getGrade'])
            ->orderBy('updated_at','desc');
        }else{
            $model = Book::with(['getEdu', 'getGrade'])
            ->whereHas('schools',function($query) use ($scale){
                $query->where($scale);
            })
            ->orderBy('updated_at','desc');
        }
        return DataTables::of($model)
            ->addIndexColumn()
            ->setRowId('id')
            ->toJson();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $res = new stdClass;
        $request->validate([
            'filebook' => 'required|file',
            'jenjang' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'mapel' => '',
            'judul' => 'required',
            'desc' => '',
            'tahun' => 'required',
            'penerbit' => 'required',
            'pengarang' => 'required'
        ]);
        $file = $request->file('filebook');
        if ($file != null) {
            $filename = Str::slug($request->judul." ".$request->pengarang." ".$request->tahun,"-");
            $fixname = "$filename.".$file->getClientOriginalExtension();
            $thumbname = "$filename.png";
            $ss = $file->storeAs('public\pdf',$fixname);
            if ($ss) {
                // if (str_contains(PHP_OS, 'WIN')) {
                //     Ghostscript::setGsPath(public_path('gs/win/bin/gswin64c.exe'));
                // }else{
                //     Ghostscript::setGsPath(public_path('gs/lin/gs-9561-linux-x86_64'));
                // }   
                $pdf = new Pdf(storage_path('app/public/pdf/'.$fixname));
                $saved = $pdf->saveImage(storage_path('app/public/thumb/pdf/').$thumbname);
                if ($saved) {
                    $imgman = new ImageManager(['driver'=> 'imagick']);
                    $imgman->make(storage_path('app/public/thumb/pdf/').$thumbname)->resize(144,208)->save();
                    $book = new Book;
                    $book->title = $request->judul;
                    $book->desc = $request->desc;
                    $book->filename = $fixname;
                    $book->thumb = $thumbname;
                    $book->filetype = $file->getClientOriginalExtension();
                    $book->clicked_time = 0;
                    $book->edu_id= $request->jenjang;
                    $book->grade_id= $request->kelas;
                    $book->major_id= $request->jurusan;
                    $book->sub_id= $request->mapel;
                    $book->published_year = $request->tahun;
                    $book->publisher = $request->penerbit;
                    $book->author = $request->pengarang;
                    $book->save();
                    
                    $res->status = "success";
                    $res->title = "Berhasil";
                    $res->message = "Buku berhasil ditambahkan";
                }else {
                    $res->status = "error";
                    $res->title = "Gagal";
                    $res->message = "Buku gagal ditambah";
                }
                return redirect()->route('buku.index')->with($res->status,json_encode($res));
            } else {
                $res->status = "error";
                $res->title = "Gagal";
                $res->message = 'Gagal menyimpan file';
                return redirect()->route('buku.index')->with($res->status,json_encode($res,400));
            }
        }else {
            $res->status = "error";
            $res->title = "Gagal";
            $res->message = 'File tidak ter-upload.';
            return redirect()->route('buku.index')->with($res->status,json_encode($res,404));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $buku)
    {
        $edu = Education::all();
        $maj = Major::all();
        $sub = Subject::all();
        $kls = Grade::all();

        return view('book.edit',compact('edu','maj','sub','buku', 'kls'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $buku)
    {
        $res = new stdClass;
        $request->validate([
            'jenjang' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'mapel' => '',
            'judul' => 'required',
            'desc' => '',
            'tahun' => 'required',
            'penerbit' => 'required',
            'pengarang' => 'required'
        ]);

        $title = $request->judul;
        $author = $request->pengarang;
        $year = $request->tahun;
        
        $filename = Str::slug("$title-$author-$year");
        $file = $request->file('filebook');
        
        if ($file != null) {
            $fixname = "$filename.".$file->getClientOriginalExtension();
            $thumbname = $filename.".png";
            
            $opfile = 'public/pdf/'.$buku->filename;
            $op = 'public/thumb/pdf/'.$buku->thumb;
            
            $npfile = 'public/pdf/'.$fixname;
            $np = 'public/thumb/pdf/'.$thumbname;
            $statepdf = file_exists(storage_path($opfile));
            $statethumb = file_exists(storage_path($op));

            if (($title != $buku->title) || ($author != $buku->author) || ($year != $buku->published_year)) {
                Storage::delete($opfile);
                Storage::delete($op);
            }
            
            $sv = $file->storeAs('public\pdf',$fixname);
            if ($sv) {
                $pdf = new Pdf(public_path('storage/pdf/'.$fixname));
                $pdfdir = storage_path('app/public/thumb/pdf/').$thumbname;
                $pdf->saveImage($pdfdir);

                $imgman = new ImageManager(['driver'=> 'imagick']);
                $img = $imgman->make(storage_path('app/public/thumb/pdf/').$thumbname)->resize(144,208)->save();
                $buku->title = $request->judul;
                $buku->desc = $request->desc;
                $buku->filename = $fixname;
                $buku->thumb = $thumbname;
                $buku->edu_id= $request->jenjang;
                $buku->grade_id= $request->kelas;
                $buku->major_id= $request->jurusan;
                $buku->sub_id= $request->mapel;
                $buku->published_year = $request->tahun;
                $buku->publisher = $request->penerbit;
                $buku->author = $request->pengarang;
                $buku->save();

                $res->status = "success";
                $res->title = "Berhasil";
                $res->message = "Buku berhasil di edit";
                return redirect()->route('buku.index')->with($res->status,json_encode($res));
            }else{
                $res->status = "error";
                $res->title = "Gagal";
                $res->message = "Buku gagal di upload";
                return redirect()->route('buku.index')->with($res->status,json_encode($res));
            }
        }else {
            $fixname = $filename.".pdf";
            $opfile = 'public/pdf/'.$buku->filename;
            $op = 'public/thumb/pdf/'.$buku->thumb;
            $thumbname = $filename.".png";
            $npfile = 'public/pdf/'.$fixname;
            $np = 'public/thumb/pdf/'.$thumbname;
            if (($title != $buku->title) || ($author != $buku->author) || ($year != $buku->published_year)) {
                $buku->filename = $fixname;
                $buku->thumb = $thumbname;
                Storage::move($opfile,$npfile);
                Storage::move($op,$np);
            }
            $buku->title = $request->judul;
            $buku->desc = $request->desc;
            
            $buku->edu_id= $request->jenjang;
            $buku->grade_id= $request->kelas;
            $buku->major_id= $request->jurusan;
            $buku->sub_id= $request->mapel;
            $buku->published_year = $request->tahun;
            $buku->publisher = $request->penerbit;
            $buku->author = $request->pengarang;
            $buku->save();

            $res->status = "success";
            $res->title = "Berhasil";
            $res->message = "Buku berhasil di edit";
            return redirect()->route('buku.index')->with($res->status,json_encode($res));
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $buku)
    {
        $res = new stdClass;
        $ex = file_exists(storage_path("public/pdf/")."$buku->filename.$buku->filetype");
        $ex = file_exists(storage_path("public/thumb/pdf/")."$buku->thumb");
        if ($ex) {
            Storage::delete('public/pdf/'.$buku->filename);
        }
        if ($et) {
            Storage::delete('public/thumb/pdf/'.$buku->thumb);
        }
        $buku->delete();
        
        $status = 'success';
        $title = 'Berhasil';
        $msg = 'Hapus buku berhasil.';
        
        $res->status = $status;
        $res->title = $title;
        $res->message = $msg;
        return response()->json($res);
    }

    public function imports()
    {
        return view('book.import');
    }
    public function excel()
    {
        return view('book.excel');
    }

    public function mass(Request $request)
    {
        
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));
        
        if (!$receiver->isUploaded()) {

            // file not uploaded

            throw new UploadMissingFileException();

        }

        $fileReceived = $receiver->receive(); // receive file

        if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded

            $file = $fileReceived->getFile(); // get file

            $extension = $file->getClientOriginalExtension();

            
            $buku = new TempBook;
            $fileName = $file->getClientOriginalName().".".$extension; // a unique file name
            
            $path = "public/temp/pdf/";

            $disk = Storage::disk(config('filesystems.default'));

            $disk->putFileAs($path,$file,$fileName);

            unlink($file->getPathname());
            
            $buku->filename = str_replace('.mp4','',$file->getClientOriginalName());
            $buku->filetype = $extension;

            $buku->save();

            return [
                'path' => 'pdf/temp'
            ];

        }
        // otherwise return percentage information
        $handler = $fileReceived->handler();
        return [
            'done' => $handler->getPercentageDone(),
            'status' => true
        ];
    }
    public function downloadExcel()
    {
        return (new ExportsTempBook())->download('bukulist.xlsx');
    }

    public function saveExcel(Request $request)
    {
        set_time_limit(0);
        $res = new stdClass;
        $request->validate([
            'xcl' => 'required|mimes:xls,xlsx'
        ]);
        try {
            TempBook::truncate();
            $file = $request->file('xcl');

            $imp = (new ImportsTempBook);
            $imp->import($file);
            // return $imp->toArray($file);
            $temp = TempBook::all();
            $totbk = TempBook::count();
            $save = 0;


            foreach ($temp as $bk) {
                $filename = Str::slug($bk->judul." ".$bk->pengarang." ".$bk->th_terbit,'-');
            
                $book = new Book;
                $book->filename = $filename;
                $book->filetype = $bk->tipe_file;
                
                $op = 'public/temp/pdf/'."$bk->nama_file.$bk->tipe_file";
                $np = 'public/pdf/'."$filename.$book->filetype";
                $path = storage_path('app/'.$op);
                $opthumb = 'public/temp/pdf/'."$filename.jpg";
                $npthumb = 'public/thumb/pdf/'."$filename.jpg";
                $path2 = storage_path('app/'.$npthumb);
                
                if (file_exists($path)) {
                    $pdf = new Pdf($path);
                    $saved = $pdf->saveImage($path2);
                    $imgman = new ImageManager(['driver'=> 'imagick']);
                    $imgman->make($path2)->resize(144,208)->save();
                    Storage::move($op,$np);
                }
                
                $edu = Education::where('edu_name','=',$bk->jenjang)->first();
                $grade = Grade::where('grade_name','=',$bk->kelas)->first();
                $mjr = Major::where('maj_name','=',$bk->jurusan)->first();
                $sub = Subject::where('sbj_name','=',$bk->mapel)->first();

                if (empty($edu)) {
                    $ed = null;
                }else{
                    $ed = $edu->id;
                }
                if (empty($grade)) {
                    $gr = null;
                }else{
                    $gr = $grade->id;
                }
                if (empty($mjr)) {
                    $mj = null;
                }else {
                    $mj = $mjr->id;
                }
                if (empty($sub)) {
                    $su = null;
                }else {
                    $su = $sub->id;
                }

                $book->title = $bk->judul;
                $book->desc = $bk->deskripsi;
                $book->edu_id = $ed;
                $book->grade_id= $gr;
                $book->major_id= $mj;
                $book->sub_id= $su;
                $book->published_year = $bk->th_terbit;
                $book->publisher = $bk->penerbit;
                $book->author = $bk->pengarang;
                $book->thumb = "$filename.jpg";
                $book->clicked_time = 0;
                if ($book->save()) {
                    $save++;
                };
            }
            if ($save == $totbk) {
                TempBook::truncate();
                
                $res->status = 'success';
                $res->title = 'Berhasil';
                $res->message = 'Buku berhasil di import.';
                
                return redirect()->route('buku.index')->with($res->status, json_encode($res));
            }else{
                $res->status = 'error';
                $res->title = 'Gagal';
                $res->message = 'Gagal import buku. Row terakhir '.$save;
        
                return redirect()->route('buku.index')->with($res->status, json_encode($res));
            }
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            
            foreach ($failures as $key => $val) {
                $val->row(); // row that went wrong
                $val->attribute(); // either heading key (if using heading row concern) or column index
                $val->errors(); // Actual error messages from Laravel validator
                $val->values(); // The values of the row that has failed.
                
                $res->message[$key] = $val->errors();
            }
            $res->status = 'error';

            return redirect()->route('video.index')->with($res->status, json_encode($res));
        }
    }
}
