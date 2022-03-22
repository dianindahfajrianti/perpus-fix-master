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
        $school = School::with('hasEdu')->get();

        return view('permission.index', compact('school'));
    }
    //DataTables Needs
    public function books(School $school, Request $request)
    {
        $id = $school->id;
        $scope = ['id' => "$id"];
        $ajax = ['ajax' => $request->ajax()];
        if (empty($ajax)) {
            $model = Book::latest()
                // ->school($scope)
                ->with(['schools' => function ($query) use ($scope) {
                    $query->where('id', $scope);
                }])
                ->whereHas('schools', function ($query) use ($scope) {
                    $query->where('id', $scope);
                });
        } else {
            $model = Book::latest()
                ->whereHas('schools', function ($query) use ($scope) {
                    $query->where('id', $scope);
                })
                ->with(['schools' => function ($query) use ($scope) {
                    $query->where('id', $scope);
                }])
                ->filter($ajax);
        }

        return DataTables::of($model)
            ->addIndexColumn()
            ->setRowId('id')
            ->toJson();
    }

    public function dataBook(School $school,Request $request)
    {
        $id = $school->id;
        $scope = ['id' => "$id"];
        $ajax = ['ajax' => "$request->ajax()"];
        if (empty($ajax)) {
            $model = Book::latest()
                // ->school($scope)
                ->with(['schools' => function ($query) use ($scope) {
                    $query->where('id', $scope);
                }])
                ->whereDoesntHave('schools', function ($query) use ($scope) {
                    $query->where('id', $scope);
                });
        } else {
            $model = Book::latest()
                ->whereDoesntHave('schools', function ($query) use ($scope) {
                    $query->where('id', $scope);
                })
                ->with(['schools' => function ($query) use ($scope) {
                    $query->where('id', $scope);
                }])->filter(request(['ajax']));
        }

        return DataTables::of($model)
            ->addIndexColumn()
            ->setRowId('id')
            ->toJson();
    }

    public function videos(School $school, Request $request)
    {
        $id = $school->id;
        $scope = ['id' => "$id"];
        $model = Video::latest();
        if (empty($request->ajax())) {
            $model
                // ->school($scope)
                ->with(['schools' => function ($query) use ($scope) {
                    $query->whereIn('id', $scope);
                }])
                ->whereHas('schools', function ($query) use ($scope) {
                    $query->whereIn('id', $scope);
                })->get();
        } else {
            $model
                ->whereHas('schools', function ($query) use ($scope) {
                    $query->whereIn('id', $scope);
                })
                ->with(['schools' => function ($query) use ($scope) {
                    $query->whereIn('id', $scope);
                }])
                ->orWhere('title', 'like', '%' . $request->ajax() . '%')
                ->orWhere('desc', 'like', '%' . $request->ajax() . '%')
                ->orWhere('creator', 'like', '%' . $request->ajax() . '%')
                ->get();
        }

        return DataTables::of($model)
            ->addIndexColumn()
            ->setRowId('id')
            ->toJson();
    }

    public function dataVideo(School $school, Request $request)
    {
        $id = $school->id;
        $scope = ['id' => "$id"];
        $model = Video::latest();
        if (empty($request->ajax())) {
            $model
                // ->school($scope)
                ->with(['schools' => function ($query) use ($scope) {
                    $query->whereIn('id', $scope);
                }])
                ->whereDoesntHave('schools', function ($query) use ($scope) {
                    $query->whereIn('id', $scope);
                })->get();
        } else {
            $model
                ->whereDoesntHave('schools', function ($query) use ($scope) {
                    $query->whereIn('id', $scope);
                })
                ->with(['schools' => function ($query) use ($scope) {
                    $query->whereIn('id', $scope);
                }])
                ->orWhere('title', 'like', '%' . $request->ajax() . '%')
                ->orWhere('desc', 'like', '%' . $request->ajax() . '%')
                ->orWhere('creator', 'like', '%' . $request->ajax() . '%')
                ->get();
        }

        return DataTables::of($model)
            ->addIndexColumn()
            ->setRowId('id')
            ->toJson();
    }

    //View Books per School
    public function showBook(School $school,Request $request)
    {
        $id = $school->id;
        if (empty($request->ajax())) {
            $book = Book::latest()->limit(3)->get();
        }else {
            $filter = ['search' => $request->ajax()];
            $book = Book::latest()->filter($filter)->get();
        }
        return view('permission.book', compact('school', 'book'));
    }
    
    public function showVideo(School $school, Request $request)
    {
        $id = $school->id;
        if (empty($request->ajax())) {
            $video = Video::latest()->limit(3)->get();
        }else {
            $filter = ['search' => $request->ajax()];
            $video = Video::latest()->filter($filter)->get();
        }
        $video = Video::latest()->filter(request(['search']))->get();
        return view('permission.video', compact('school', 'video'));
    }

    public function storeBook(School $school, Request $request)
    {
        $res = new stdClass;
        $result = $school->books()->attach($request->id_buku);

        if ($result != 0) {
            $res->status = "success";
            $res->title = "Berhasil";
            $res->message = "Akses buku gagal diberikan!";
            
        }else{
            $res->status = "success";
            $res->title = "Gagal";
            $res->message = "Akses buku berhasil diberikan!";
        }
        return response()->json($res);
    }

    public function storeVideo(School $school, Request $request)
    {
        $res = new stdClass;
        $result = $school->videos()->attach($request->id_video);

        if ($result != 0) {
            $res->status = "success";
            $res->title = "Berhasil";
            $res->message = "Akses video gagal diberikan!";
            
        }else{
            $res->status = "success";
            $res->title = "Gagal";
            $res->message = "Akses video berhasil diberikan!";
        }
        return response()->json($res);
    }

    public function video()
    {
        $video = Video::all();
    }

    public function showfilesekolah(School $school)
    {
        $id = $school->id;
        $book = Book::select(DB::raw('COUNT(id) as totidb'))
            ->whereHas('schools', function ($query) use ($id) {
                $query
                    ->where('id', $id);
            })
            ->get();
        $vid = Video::select(DB::raw('COUNT(id) as totidv'))
            ->whereHas('schools', function ($query) use ($id) {
                $query
                    ->where('id', $id);
            })
            ->get();

        return view('permission.filesekolah', compact('book', 'vid', 'school'));
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroyBook(School $school, Request $request)
    {
        $id = $school->id;
        $book = $request->id_buku;
        $res = new stdClass;
        $del = $school->books()->detach($book);
        if ($del == 0) {
            $status = 'error';
            $title = 'Gagal';
            $msg = 'Hapus akses buku gagal.';
        }else{
            $status = 'success';
            $title = 'Berhasil';
            $msg = 'Hapus akses buku berhasil.';
        }
        $res->status = $status;
        $res->title = $title;
        $res->message = $msg;
        return response()->json($res);
    }
    public function destroyVideo(School $school, Request $request)
    {
        $id = $school->id;
        $video = $request->id_video;
        $res = new stdClass;
        $del = $school->videos()->detach($video);
        if ($del == 0) {
            $status = 'error';
            $title = 'Gagal';
            $msg = 'Hapus akses video gagal.';
        }else{
            $status = 'success';
            $title = 'Berhasil';
            $msg = 'Hapus akses video berhasil.';
        }
        $res->status = $status;
        $res->title = $title;
        $res->message = $msg;
        return response()->json($res);
    }
}
