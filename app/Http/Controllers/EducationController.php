<?php

namespace App\Http\Controllers;

use App\Book;
use App\Education;
use App\School;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use stdClass;
use Yajra\DataTables\DataTables as DTB;

class EducationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('edu.index');
    }
    public function data()
    {
        $model = Education::select("id","edu_name");
        return DTB::of($model)
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
        return view('edu.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $res = new stdClass();
        $request->validate([
            'edu_name' => 'required|max:3'
        ]);
        try {
            $edu = new Education;
            $edu->edu_name =  $request->edu_name;
            $edu->save();

            $stat = "success";
            $msg = "Tingkat pendidikan $request->edu_name berhasil ditambahkan!";
            
            $res->status = $stat;
            $res->data = $request->edu_name;
            $res->message = $msg;
            
            return redirect()->route('pendidikan.index')->with($stat,json_encode($res));

        } catch (\Exception $ex) {
            $msg = $ex;
            $stat = "error";

            $res->status = $stat;
            $res->data = $request->edu_name;
            $res->message = $msg;
            
            return redirect()->route('pendidikan.index')->with($stat,json_encode($res));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */

    public function show(Education $pendidikan)
    {
        $education = $pendidikan;
        return compact('education');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function edit(Education $pendidikan)
    {
        $education = $pendidikan->find($pendidikan->id);
        // return compact('edu');
        return view('edu.edit',compact('education'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Education $pendidikan)
    {
        $request->validate([
            'edu_name' => 'required|max:3'
        ]);
        $education = $pendidikan;
        $oldname = $pendidikan->edu_name;
        $education->edu_name =  $request->edu_name;
        $res = new stdClass();
        try {
            $education->save();

            $stat = "success";
            $msg = "Tingkat pendidikan berhasil di edit! Dari $oldname jadi $request->edu_name !";
            $res->status = $stat;
            $res->message = $msg;
            return redirect()->route('pendidikan.index')->with($stat,json_encode($res));
        } catch (\Exception $th) {
            $stat = "error";
            $res->status = $stat;
            $res->message = $msg;
            return redirect()->route('pendidikan.index')->with($stat,json_encode($res));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function destroy(Education $pendidikan)
    {
        $exist1 = School::where('edu_id','=',$pendidikan->id)->first();
        $exist2 = Book::where('edu_id','=',$pendidikan->id)->first();
        
        $res = new stdClass();
        if (($exist1||$exist2) != null) {
            $stat = "error";
            $msg = "Tingkat pendidikan $pendidikan->name Tidak Boleh Dihapus!";
            $res->status = $stat;
            $res->message = $msg;

            return response()->json($res);
        }else {
            $nama = $pendidikan->name;
            $pendidikan->delete();

            $stat = "success";
            $msg = "Tingkat pendidikan $nama berhasil dihapus!";
            $res->status = $stat;
            $res->url = route('pendidikan.index');
            $res->message = $msg;
            return response()->json($res);
        }
    }
    public function check(Education $edu)
    {
        $exist1 = School::where('edu_id','=',$edu->id)->first();
        $exist2 = Book::where('edu_id','=',$edu->id)->first();
        $ex = [$exist1,$exist2];
        if (($exist1||$exist2) != null) {
            return json_encode($ex,false);
        }else {
           return 'delete available';
        }
    }
}
