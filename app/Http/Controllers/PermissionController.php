<?php

namespace App\Http\Controllers;

use App\Book;
use stdClass;
use App\Video;
use App\School;
use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $book = Book::select(DB::raw('COUNT(id) as totidb'))->get();
        $vid = Video::select(DB::raw('COUNT(id) as totidv'))->get();
        
        return view('permission.index',compact('book','vid'));
    }

    public function buku(School $school)
    {
        $id = request('id');

        $schools = $school->find('id',$school);
        dd($schools);
            // ->latest()
            // ->whereHas('books',function ($query) use($id) {
            //     $query->where('id', $id);
            // })
            // ->limit(5)->get();
        return view('permission.test',compact('schools'));
    }
    public function books(Request $request)
    {

        if (empty($request->ajax())) {
            $model = Book::all();
        }else{
            $books = Book::with('schools')
            ->orWhere('title','like', '%'.$request->ajax.'%')
            ->latest()->limit(5)->get();
        }
        
        return DataTables::of($model)
            ->addIndexColumn()
            ->setRowId('id')
            ->toJson();
    }
    public function showBook(School $school)
    {
        $id = $school->id;
        $schools = Book::latest()
            ->whereHas('schools',function ($query) use($id) {
                $query->where('id', $id);
            })->get();
        dd($schools);
        return view('permission.test',compact('schools'));
    }
    public function storeBook(Request $request)
    {
        $request->validate([
            'id_buku' => 'required|exists:books,id',
            'id_sekolah' => 'required|exists:schools,id'
        ]);
        $res = new stdClass;
        $rel = Book::findOrFail($request->id_buku);
        $result = $rel->schools()->attach($request->id_sekolah);

        if ($result) {
            return redirect()->with($res->status,$res);
        }
    }
    public function video()
    {
        $video = Video::all();
    }

    public function data(School $school)
    {
        $book = DB::table('permissions')
                ->where('school_id','=',$school->id)
                ->value('idfile');
        $collect = explode(",",$book);
        $books = new stdClass;
        $bks = Book::where('id','=',$collect)->get();
        foreach ($collect as $c => $val) {
            $books->$c = Book::where('id','=',$val)->get('id');
        };
        return compact('books');
        // view('permission.test',);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        //
    }
}
