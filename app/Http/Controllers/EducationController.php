<?php

namespace App\Http\Controllers;

use App\Book;
use App\Education;
use App\School;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $edu = Education::all();
        return view('edu.index',compact('edu'));
    }
    public function getjson()
    {
        return DTB::of(Education::select("id","edu_name"))
               ->addIndexColumn()
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
        $request->validate([
            'edu_name' => 'required|max:3'
        ]);
        try {
            $edu = new Education;
            $edu->edu_name =  $request->edu_name;
            $edu->save();

            $stat = "success";
            $msg = "Tingkat pendidikan $request->edu_name berhasil ditambahkan!";
            $res = [
                'status' => $stat,
                'data' => $request->edu_name,
                'message' => $msg
            ];
            return redirect()->route('adm-edu')->with($stat,$res);

        } catch (\Exception $ex) {
            $msg = $ex;
            $stat = "success";
            $res = [
                'status' => $stat,
                'data' => $request->edu_name,
                'message' => $msg
            ];
            return redirect()->route('adm-edu')->with($stat,$res);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */

    public function show(Education $education)
    {
        return compact('education');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function edit(Education $education)
    {
        // return compact('education');
        return view('edu.edit',compact('education'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Education $education)
    {
        $request->validate([
            'name' => 'required|max:3'
        ]);
        try {
            $education = new Education;
            $education->edu_name =  $request->name;
            $education->save();

            $stat = "success";
            $msg = "Tingkat pendidikan $request->name berhasil di edit!";
            $res = [
                'status' => $stat,
                'message' => $msg
            ];
            return redirect()->route('adm-edu')->with($stat,$res);
        } catch (\Exception $th) {
            $stat = "error";
            $res = [
                'status' => $stat,
                'message' => $th
            ];
            return redirect()->route('adm-edu')->with($stat,$res);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Education  $education
     * @return \Illuminate\Http\Response
     */
    public function destroy(Education $education)
    {
        $exist1 = School::where('edu_id','=',$education->id)->get();
        $exist2 = Book::where('edu_id','=',$education->id)->get();
        $exist3 = User::where('edu_id','=',$education->id)->get();

        if ($exist1||$exist2||$exist3) {
            $stat = "error";
            $msg = "Tingkat pendidikan $education->name Tidak Boleh Dihapus!";
            $res = [
                'status' => $stat,
                'message' => $msg
            ];

            return response()->json($res);
        }else {
            $nama = $education->name;
            $education->delete();

            $stat = "success";
            $msg = "Tingkat pendidikan $nama berhasil ditambahkan!";
            $res = [
                'status' => $stat,
                'message' => $msg
            ];
            return response()->json($res);
        }
    }

}
