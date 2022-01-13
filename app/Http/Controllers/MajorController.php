<?php

namespace App\Http\Controllers;

use App\Book;
use App\Major;
use App\User;
use App\Video;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        //Do your magic here
        $this->stat = "";
        $this->msg = "";
        $this->url = "admin/jurusan";
    }

    public function index()
    {
        $mj = Major::all();
        return view('major.index',compact('mj'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('major.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mj = new Major;
        $request->validate([
            'kelas' => 'required',
            'jurusan' => 'required'
        ]);


        try {
            $mj->parent_id = $request->kelas;
            $mj->maj_name = $request->jurusan;
            $mj->save();

            $this->stat = "success";
            $this->msg = "Jurusan $request->jurusan berhasil ditambahkan!";
        } catch (\Exception $ex) {
            $this->stat = "error";
            $this->msg = $ex;
        }
        $res = [
            'status' => $this->stat,
            'message' => $this->msg,
            'url' => $this->url
        ];
        return response()->json($res);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function show(Major $major)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function edit(Major $major)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Major $major)
    {
        $request->validate([
            'kelas' => 'required',
            'jurusan' => 'required'
        ]);


        try {
            $major->parent_id = $request->kelas;
            $major->maj_name = $request->jurusan;
            $major->save();

            $this->stat = "success";
            $this->msg = "Jurusan $request->jurusan berhasil ditambahkan!";
        } catch (\Exception $ex) {
            $this->stat = "error";
            $this->msg = $ex;
        }
        $res = [
            'status' => $this->stat,
            'message' => $this->msg,
            'url' => $this->url
        ];
        return response()->json($res);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function destroy(Major $major)
    {
        $e1 = Book::where('major_id','=',$major->id)->get();
        $e2 = Video::where('major_id','=',$major->id)->get();
        $e3 = User::where('major_id','=',$major->id)->get();

        if ($e1||$e2||$e3) {
            $this->stat = "error";
            $this->msg = "Gagal hapus! Ada File di jurusan $major->maj_name! ";
        }else {
            $this->stat = "success";
            $this->msg = "Jurusan $major->maj_name berhasil dihapus!";
        }
        $res = [
            'status' => $this->stat,
            'message' => $this->msg,
            'url' => $this->url
        ];
        return response()->json($res);
    }
}
