<?php

namespace App\Http\Controllers;

use App\Book;
use App\Education;
use App\Grade;
use App\Major;
use App\Subject;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
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
        // $request->validate([
        //     'filebook' => 'required|file',
        //     'jenjang' => 'required',
        //     'kelas' => 'required',
        //     'jurusan' => 'required',
        //     'mapel' => '',
        //     'judul' => 'required',
        //     'desc' => '',
        //     'tahun' => 'required',
        //     'penerbit' => 'required',
        //     'pengarang' => 'required'
        // ]);
        $file = $request->file('filebook');
        $img = $request->get('img');
        if ($file != null) {
            
            if (preg_match('/data:image\/(gif|jpeg|png);base64,(.*)/i', $img, $matches)) {
                $thumbname = "$request->judul.png";
                $filename = "$request->judul-$request->pengarang-$request->tahun";
                //Image attr declaration
                $imageType = $matches[1];
                $imageData = base64_decode($matches[2]);
                //saving image
                $image = Image::make($imageData);
                $ss = $image->move('assets/images/', $thumbname);
                if ($ss) {

                    $book = new Book;
                    $book->title = $request->judul;
                    $book->desc = $request->desc;
                    $book->filename = $filename;
                    $book->filetype = $file->getClientOriginalExtension();
                    $book->published_year = $request->tahun;
                    $book->publisher = $request->penerbit;
                    $book->author = $request->pengarang;
                    $book->save();

                    $res->status = "success";
                    $res->title = "Berhasil";
                    $res->message = "Gambar berhasil ditambahkan";
                    return redirect()->route('pendidikan.index')->with($res->status,json_encode($res));
                } else {
                    $res->status = "error";
                    $res->title = "Gagal";
                    $res->message = 'Could not save the file.';
                    return redirect()->route('pendidikan.index')->with($res->status,json_encode($res));
                }
            } else {
                $res->status = "error";
                $res->title = "Gagal";
                $res->message = 'Invalid data URL.';
                return redirect()->route('pendidikan.index')->with($res->status,json_encode($res));
            }
        }else {
            $res->status = "error";
            $res->title = "Gagal";
            $res->message = 'File tidak ter-upload.';
            return response()->json($res);
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
        //
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
        //
    }
}
