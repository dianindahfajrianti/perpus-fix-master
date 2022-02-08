<?php

namespace App\Http\Controllers;

use App\Book;
use App\Education;
use App\Grade;
use App\Major;
use App\Permission;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
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
            ->orderBy('updated_at');
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
        $validator = Validator::make($request->all(),[
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

        if ($validator->fails()) {
            $res->status = "error";
            $res->title = "Gagal";
            $res->message = $validator->errors();
            return response()->json($res);
        } else {
            $file = $request->file('filebook');
            $img = $request->get('img');
            if ($file != null) {
                
                if (preg_match('/data:image\/(gif|jpeg|png);base64,(.*)/i', $img, $matches)) {
                    
                    $filename = Str::slug("$request->judul-$request->pengarang-$request->tahun");
                    $thumbname = "$filename.png";
                    //Image attr declaration
                    $imageType = $matches[1];
                    $imageData = base64_decode($matches[2]);
                    //saving image
                    $image = Image::make($imageData);
                    $ss = $image->save(public_path('assets/images/thumbs/').$thumbname);
                    if ($ss) {
                        $file->storeAs('pdf',"$filename.".$file->getClientOriginalExtension());
                        $book = new Book;
                        $book->title = $request->judul;
                        $book->desc = $request->desc;
                        $book->filename = "$filename.".$file->getClientOriginalExtension();
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
                        $res->message = "Gambar berhasil ditambahkan";
                        return response()->json($res);
                    } else {
                        $res->status = "error";
                        $res->title = "Gagal";
                        $res->message = 'Could not save the file.';
                        return response()->json($res,400);
                    }
                } else {
                    $res->status = "error";
                    $res->title = "Gagal";
                    $res->message = 'Invalid data URL.';
                    return response()->json($res,400);
                }
            }else {
                $res->status = "error";
                $res->title = "Gagal";
                $res->message = 'File tidak ter-upload.';
                return response()->json($res,404);
            }
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
        $e1 = Permission::where('')
    }
}
