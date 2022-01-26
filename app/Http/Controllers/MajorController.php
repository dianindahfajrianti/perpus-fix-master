<?php

namespace App\Http\Controllers;

use App\Book;
use App\Major;
use App\User;
use App\Video;
use Illuminate\Http\Request;
use stdClass;
use Yajra\DataTables\Facades\DataTables;

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
        $this->url = "/admin/jurusan";
    }

    public function index()
    {
        return view('major.index');
    }
    public function data()
    {
        $model = Major::all();
        return DataTables::of($model)
               ->addIndexColumn()
               ->setRowId('id')
               ->make(true);
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
        $res = new stdClass();

        $request->validate([
            'jurusan' => 'required'
        ]);


        try {
            $mj->maj_name = $request->jurusan;
            $mj->save();

            $this->stat = "success";
            $this->msg = "Jurusan $request->jurusan berhasil ditambahkan!";
        } catch (\Exception $ex) {
            $this->stat = "error";
            $this->msg = $ex;
        }
        $res->status = $this->stat;
        $res->data = $request->jurusan;
        $res->message = $this->msg;
        return redirect()->route('pendidikan.index')->with($this->stat,json_encode($res));

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
    public function update(Request $request, Major $jurusan)
    {
        $res = new stdClass();
        $request->validate([
            'jurusan' => 'required'
        ]);


        try {
            $jurusan->maj_name = $request->jurusan;
            $jurusan->save();

            $this->stat = "success";
            $this->msg = "Jurusan $request->jurusan berhasil ditambahkan!";
        } catch (\Exception $ex) {
            $this->stat = "error";
            $this->msg = $ex;
        }
        $res->status = $this->stat;
        $res->data = $request->jurusan;
        $res->message = $this->msg;
        return redirect()->route('pendidikan.index')->with($this->stat,json_encode($res));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function destroy(Major $jurusan)
    {
        $res = new stdClass();
        $e1 = Book::where('major_id','=',$jurusan->id)->get();
        $e2 = Video::where('major_id','=',$jurusan->id)->get();
        $e3 = User::where('major_id','=',$jurusan->id)->get();

        if ($e1||$e2||$e3) {
            $this->stat = "error";
            $this->msg = "Gagal hapus! Ada File di jurusan $jurusan->maj_name! ";
        }else {
            $this->stat = "success";
            $this->msg = "Jurusan $jurusan->maj_name berhasil dihapus!";
        }
        $res->status = $this->stat;
        $res->url = $this->url;
        $res->message = $this->msg;
        return response()->json($res);
    }
}
