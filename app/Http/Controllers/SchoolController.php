<?php

namespace App\Http\Controllers;

use App\Education;
use App\Grade;
use App\School;
use App\User;
use Illuminate\Http\Request;
use stdClass;
use Yajra\DataTables\Facades\DataTables;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */

    public function index()
    {
        $edu = Education::all();
        return view('school.index',compact('edu'));
    }
    public function data()
    {
        $rel = ['hasEdu'];
        $model = School::with($rel)
            ->select('*');
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
            'nama' => 'required|max:100',
            'jenjang' => 'required',
            'alamat' => 'required|min:10',
            'notelp' => 'required'
        ]);
        $res = new stdClass();
        try {
            $sch = new School;
            $sch->edu_id = $request->jenjang;
            $sch->sch_name = $request->nama;
            $sch->address = $request->alamat;
            $sch->phone = $request->notelp;

            $sch->save();
            $stat = "success";
            $msg = "$request->nama berhasil ditambahkan!";
        } catch (\Exception $th) {
            $stat = "error";
            $msg = $th;
        }
        $res->stat = $stat;
        $res->message = $msg;
        return redirect()->route('sekolah.index')->with($stat,json_encode($res));
        
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
    public function edit(School $sekolah)
    {
        $edu = Education::all();
        $sch = $sekolah->first();
        // return compact('school');
        return view('school.edit',compact('sch','edu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, School $sekolah)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'jenjang' => 'required',
            'alamat' => 'required|min:10',
            'notelp' => 'required'
        ]);
        $res = new stdClass();
        try {
            $sch = $sekolah;
            $sch->edu_id = $request->jenjang;
            $sch->sch_name = $request->nama;
            $sch->address = $request->alamat;
            $sch->phone = $request->notelp;

            $sch->save();
            $stat = "success";
            $msg = "Sekolah $request->name berhasil dirubah!";
            
        } catch (\Exception $th) {
            $stat = "error";
            $msg = $th;
        }
        $res->stat = $stat;
        $res->message = $msg;
        return redirect()->route('sekolah.index')->with($stat,json_encode($res));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $sekolah)
    {
        $exist = User::where('school_id','=',$sekolah->id)->first();
        $res= new stdClass();
        if ($exist) {
            $stat = "error";
            $msg = "$sekolah->name tidak boleh dihapus! Karena ada user di $sekolah->name !";
        }else {
            $sekolah->delete();
            $stat = "success";
            $msg = "$sekolah->name berhasil dihapus!";
        }
        $res->status = $stat;
        $res->message = $msg;
        return response()->json($res);
    }
}
