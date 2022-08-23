<?php

namespace App\Http\Controllers;

use App\Book;
use App\User;
use stdClass;
use App\Grade;
use App\Video;
use App\Education;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $edu = Education::all();
        return view('grade.index',compact('edu'));
    }
    public function data()
    {
        $rel = ['getEdu'];
        $model = Grade::all();
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
        $res = new stdClass();

        $request->validate([
            'kelas' => 'required|unique:grades,grade_name|numeric|min:1|max:12',
        ]);
        try {
            $gr->grade_name = $request->kelas;
            $gr->save();

            $stat = "success";
            $msg = "Kelas $gr->grade_name berhasil ditambah!";

        } catch (\Exception $ex) {
            $stat = "error";
            $msg = $ex;
        }
        $res->stat = $stat;
        $res->message = $msg;
        return redirect()->route('grade.index')->with($stat,json_encode($res));
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
            'kelas' => ['required|numeric|min:1|max:12', Rule::unique('grades', 'grade_name')->ignore($grade->id),],
        ]);
        $res = new stdClass();
        try {
            $grade->grade_name = $request->kelas;
            $grade->save();

            $stat = "success";
            $msg = "Kelas $request->grade_name berhasil diubah!";

        } catch (\Exception $ex) {
            $stat = "error";
            $msg = $ex;
        }
        $res->stat = $stat;
        $res->message = $msg;
        return redirect()->route('grade.index')->with($stat,json_encode($res));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grade $grade)
    {
        $res = new stdClass();
        $e1 = Book::where('grade_id','=',$grade->id)->first();
        $e2 = Video::where('grade_id','=',$grade->id)->first();
        $e3 = User::where('grade_id','=',$grade->id)->first();

        if (($e1||$e2||$e3) != null) {
            $stat = "error";
            $msg = "Gagal hapus! Ada File di kelas $grade->grade_name ! ";
            $res->status = $stat;
            $res->message = $msg;
            return response()->json($res);
        }else {
            $nama = $grade->name;
            $grade->delete();

            $stat = "success";
            $msg = "Kelas $grade->grade_name berhasil dihapus!";
            $res->status = $stat;
            $res->message = $msg;
            return response()->json($res);
        }
    }
    public function check(Grade $grade)
    {
        $e1 = Book::where('grade_id','=',$grade->id)->first();
        $e2 = Video::where('grade_id','=',$grade->id)->first();
        $e3 = User::where('grade_id','=',$grade->id)->first();
        $ex = [$e1,$e2,$e3];

        if (($e1||$e2||$e3) != null) {
            return json_encode($ex,false);
        }else {
           return 'delete available';
        }
    }
}
