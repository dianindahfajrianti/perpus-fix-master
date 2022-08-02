<?php

namespace App\Http\Controllers;

use App\Book;
use App\User;
use stdClass;
use App\Major;
use App\Video;
use App\Education;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $edu = Education::all();
        return view('major.index', compact('edu'));
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
            'jurusan' => 'required|unique:majors,maj_name',
            'jenjang' => 'required'
        ]);

        try {
            $mj->maj_name = $request->jurusan;
            $mj->edu_id = $request->jenjang;
            $mj->save();

            $stat = "success";
            $msg = "Jurusan $request->jurusan berhasil ditambahkan!";
        } catch (\Exception $ex) {
            $stat = "error";
            $msg = $ex;
        }
        $res->status = $stat;
        $res->data = $request->jurusan;
        $res->message = $msg;
        return redirect()->route('jurusan.index')->with($stat,json_encode($res));

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
    public function edit(Major $jurusan)
    {
        $edu = Education::all();
        return view('major.edit',compact('jurusan','edu'));
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
            'jurusan' => 'required',
            'jenjang' => 'required'
        ]);

        try {
            $jurusan->maj_name = $request->jurusan;
            $jurusan->edu_id = $request->jenjang;
            $jurusan->save();

            $stat = "success";
            $msg = "Jurusan $request->jurusan berhasil diubah!";
        } catch (\Exception $ex) {
            $stat = "error";
            $msg = $ex;
        }
        $res->status = $stat;
        $res->data = $request->jurusan;
        $res->message = $msg;
        return redirect()->route('jurusan.index')->with($stat,json_encode($res));
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
        $e1 = Book::where('major_id','=',$jurusan->id)->first();
        $e2 = Video::where('major_id','=',$jurusan->id)->first();
        $e3 = User::where('major_id','=',$jurusan->id)->first();

        if (($e1||$e2||$e3) != null) {
            $stat = "error";
            $title= "Gagal";
            $msg = "Gagal hapus! Ada File di jurusan $jurusan->maj_name! ";
        }else {
            $jurusan->delete();
            $stat = "success";
            $title = "Berhasil";
            $msg = "Jurusan $jurusan->maj_name berhasil dihapus!";
        }
            $res->status = $stat;
            $res->title = $title;
            $res->message = $msg;
            return response()->json($res);
    }

    public function check(Major $jurusan)
    {
        $e1 = Book::where('grade_id','=',$jurusan->id)->first();
        $e2 = Video::where('grade_id','=',$jurusan->id)->first();
        $e3 = User::where('grade_id','=',$jurusan->id)->first();
        $ex = [$e1,$e2,$e3];

        if (($e1||$e2||$e3) != null) {
            return json_encode($ex,false);
        }else {
           return 'delete available';
        }
    }
}
