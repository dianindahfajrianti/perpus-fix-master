<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Major;
use App\School;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role < 1) {
            $user = User::all();
        }else {
            $user = User::where('role','>=',1)->get();
        }
        return view('user.index',compact('user'));
    }

    public function data(Request $request)
    {
        if ($request != null) {
            $model = User::select('id','title','desc','clicked_time','published_year','publisher','author','id');
        }else{
            $rel = ['getEdu','getGrade'];
            $model = User::with($rel)
                        ->select('id','title','desc','clicked_time','published_year','publisher','author','id');
        }
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
        //
        $sch = School::all();
        $grade = Grade::all();
        $mjr = Major::all();
        return view('user.add',compact('sch','grade','mjr'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }
    public function storeOne(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:3',
            'username' => 'required|min:3|max:16|unique:users',
            'email'=> 'required|unique:users',
            'school' => 'required',
            'school' => 'required',
            'school' => 'required'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function profile()
    {

    }
}
