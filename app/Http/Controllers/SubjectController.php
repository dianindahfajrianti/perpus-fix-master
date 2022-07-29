<?php

namespace App\Http\Controllers;

use App\Book;
use stdClass;
use App\Major;
use App\Video;
use App\School;
use App\Subject;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maj = Major::all();
        return view('subject.index',compact('maj'));
    }
    public function data()
    {
        $model = Subject::with('hasMajor');
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
        return view('subject.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sub = new Subject;
        $res = new stdClass;
        $request->validate([
            'jurusan' => 'required',
            'mapel' => 'required|min:3|unique:subjects,sbj_name'
        ]);

        try {
            $sub->parent_id = $request->jurusan;
            $sub->sbj_name = $request->mapel;
            $sub->save();

            $stat = "success";
            $msg = "$request->mapel berhasil ditambahkan!";
        } catch (\Exception $th) {
            $stat = "error";
            $msg = $th;
        }
        $res->stat = $stat;
        $res->message = $msg;
        return redirect()->route('mapel.index')->with($stat,json_encode($res));
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $mapel)
    {
        $maj = Major::all();
        return view('subject.edit',compact('mapel','maj'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $mapel)
    {
        $res = new stdClass;
        $request->validate([
            'jurusan' => 'required',
            'mapel' => 'required|min:3'
        ]);

        try {
            $mapel->parent_id = $request->jurusan;
            $mapel->sbj_name = $request->mapel;
            $mapel->save();

            $stat = "success";
            $msg = "$request->mapel berhasil diubah!";
        } catch (\Exception $th) {
            $stat = "error";
            $msg = $th;
        }
        $res->stat = $stat;
        $res->message = $msg;
        return redirect()->route('mapel.index')->with($stat,json_encode($res));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $mapel)
    {
        $res = new stdClass;
        $e1 = Book::with('getSubject')->where('sub_id','=',$mapel->id)->first();
        $e2 = Video::with('getSubject')->where('sub_id','=',$mapel->id)->first();

        if (($e1||$e2) != null) {
            $stat = "error";
            $msg = "Mata pelajaran $mapel->name Tidak Boleh Dihapus!";
            $title = "Gagal";
        }else {
            $nama = $mapel->name;
            $mapel->delete();
            $title = "Berhasil";
            
            $stat = "success";
            $msg = "Mata pelajaran $nama berhasil dihapus!";
        }
        
        
        $res->status = $stat;
        $res->title = $title;
        $res->message = $msg;

        return response()->json($res);
    }
    public function check()
    {
        $rel = ['getEdu','getGrade'];
        $th = Video::all();
        dd($th);
        
        // $title = "Gagal";
        // $title = "Berhasil";
        // return compact($buku);
    }
}
