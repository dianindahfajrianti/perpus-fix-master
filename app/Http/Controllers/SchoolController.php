<?php

namespace App\Http\Controllers;

use App\School;
use App\User;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */

    public function index(Request $request)
    {
        $sch = School::paginate(10);
        // return compact('sch');
        return view('school.index',compact('sch'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('school.add');
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
            'jenjang' => 'required',
            'nama' => 'required|max:100',
            'alamat' => 'required',
            'telp' => 'required'
        ]);
        try {
            $sch = new School;
            $sch->edu_id = $request->jenjang;
            $sch->address = $request->name;
            $sch->phone = $request->telp;

            $sch->save();
            $stat = "success";
            $msg = "Sekolah $request->name berhasil ditambahkan!";
            $res = [
                'status' => $stat,
                'message' => $msg
            ];

            return response()->json($res);
        } catch (\Exception $th) {

            return response()->json($th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */

    public function show(School $school)
    {
        return view('school.show',compact('school'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function edit(School $school)
    {
        return view('school.edit',compact('school'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, School $school)
    {
        $request->validate([
            'jenjang' => 'required',
            'nama' => 'required|max:100',
            'alamat' => 'required',
            'telp' => 'required'
        ]);
        try {
            $sch = $school;
            $sch->edu_id = $request->jenjang;
            $sch->address = $request->name;
            $sch->phone = $request->telp;

            $sch->save();
            $stat = "success";
            $msg = "Sekolah $request->name berhasil dirubah!";
            $res = [
                'status' => $stat,
                'message' => $msg
            ];
            return response()->json($res);
        } catch (\Exception $th) {
            return response()->json($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        $exist = User::where('school_id','=',$school->id)->first();

        if ($exist) {
            $stat = "error";
            $msg = "$school->name tidak boleh dihapus! Karena ada user di $school->name";
            $res = [
                'status' => $stat,
                'message' => $msg
            ];
            return response()->json($res);
        }else {
            $school->delete();
            $stat = "success";
            $msg = "$school->name berhasil dihapus!";
            $res = [
                'status' => $stat,
                'message' => $msg
            ];
            return response()->json($res);
        }
    }
}
