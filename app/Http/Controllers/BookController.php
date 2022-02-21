<?php

namespace App\Http\Controllers;

use App\Book;
use App\Education;
use App\Grade;
use App\Major;
use App\Permission;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Org_Heigl\Ghostscript\Ghostscript;
use Spatie\PdfToImage\Pdf;
use stdClass;
use Yajra\DataTables\Facades\DataTables;

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
        return view('book.index',compact('edu','maj','sub'));
    }

    public function data()
    {
        $rel = ['getEdu', 'getGrade'];
        $model = Book::with($rel)
            ->select('id', 'title', 'desc', 'clicked_time', 'published_year', 'publisher', 'author')
            ->orderBy('updated_at','desc');
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
            $filename = Str::slug("$request->judul-$request->pengarang-$request->tahun");
            $fixname = "$filename.".$file->getClientOriginalExtension();
            $thumbname = "$filename.png";
            $ss = $file->storeAs('public\pdf',$fixname);
            if ($ss) {
                Ghostscript::setGsPath("");
                $pdf = new Pdf(public_path('storage/pdf/'.$fixname));
                $saved = $pdf->saveImage('assets/images/thumbs/'.$thumbname);
                if ($saved) {
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
                //   savetoImg($fixname,$thumbname);
                    $res->status = "success";
                    $res->title = "Berhasil";
                    $res->message = "Gambar berhasil ditambahkan";
                }else {
                    $res->status = "error";
                    $res->title = "Gagal";
                    $res->message = "Gambar gagal ditambah";
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
    function savetoImg($fixname,$thumbname)
    {
        
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
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        // $e1 = Permission::where('')
    }
}
