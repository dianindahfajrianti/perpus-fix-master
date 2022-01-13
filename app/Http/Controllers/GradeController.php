<?php

namespace App\Http\Controllers;

use App\Book;
use App\Grade;
use App\User;
use App\Video;
use Illuminate\Http\Request;

class GradeController extends Controller
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
         $this->url = "admin/kelas";
     }

    public function index()
    {
        $gr = Grade::all();
        return view('grade.index',compact('gr'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('grade.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $gr = new Grade;
        $request->validate([
            'jenjang' => 'required',
            'kelas' => 'required',
        ]);
        try {
            $gr->parent_id = $request->jenjang;
            $gr->grade_name = $request->kelas;
            $gr->save();

            $this->stat = "success";
            $this->msg = "Kelas $gr->grade_name berhasil ditambah!";

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
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function show(Grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function edit(Grade $grade)
    {
        return view('grade.edit',compact('grade'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grade $grade)
    {
        $request->validate([
            'jenjang' => 'required',
            'kelas' => 'required',
        ]);
        try {
            $grade->parent_id = $request->jenjang;
            $grade->grade_name = $request->kelas;
            $grade->save();

            $this->stat = "success";
            $this->msg = "Kelas $grade->grade_name berhasil diubah!";

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
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grade $grade)
    {
        $e1 = Book::where('grade_id','=',$grade->id)->get();
        $e2 = Video::where('grade_id','=',$grade->id)->get();
        $e3 = User::where('grade_id','=',$grade->id)->get();

        if ($e1||$e2||$e3) {
            $this->stat = "error";
            $this->msg = "Gagal hapus! Ada File di kelas $grade->grade_name! ";
        }else {
            $this->stat = "success";
            $this->msg = "Kelas $grade->grade_name berhasil dihapus!";
        }
        $res = [
            'status' => $this->stat,
            'message' => $this->msg,
            'url' => $this->url
        ];
        return response()->json($res);
    }
}
