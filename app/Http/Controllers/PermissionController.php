<?php

namespace App\Http\Controllers;

use App\Book;
use stdClass;
use App\Major;
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
        if (empty($request->ajax())) {
            $model = Book::latest()
                // ->school($scope)
                ->whereHas('schools', function ($query) use ($scope) {
                    $query->where('id', $scope);
                });
        } else {
            $model = Book::latest()
                ->whereHas('schools', function ($query) use ($scope) {
                    $query->where('id', $scope);
                })
                ->filter($ajax);
        }

        return DataTables::of($model)
            ->addIndexColumn()
            ->setRowId('id')
            ->make(true);
    }

    public function dataBook(School $school,Request $request)
    {
        $id = $school->id;
        $scope = ['id' => $id];
        $ajax = ['ajax' => $request->ajax()];

        if (empty($ajax)) {
            $model = Book::latest()
                // ->school($scope)
                ->whereDoesntHave('schools', function ($query) use ($scope) {
                    $query->where('id', $scope);
                });
        } else {
            $model = Book::latest()
                ->whereDoesntHave('schools', function ($query) use ($scope) {
                    $query->where('id', $scope);
                })
                ->filter(request(['ajax']));
        }

        return DataTables::of($model)
            ->addIndexColumn()
            ->setRowId('id')
            ->make(true);
    }

    public function videos(School $school, Request $request)
    {
        $id = $school->id;
        //get model
        $model = Video::latest()
                ->whereHas('schools', function ($query) use ($id) {
                    $query->where('id', $id);
                });
        // return $model->get();
        return DataTables::eloquent($model)
            ->addIndexColumn()
            ->setRowId('id')
            ->make(true);
    }

    public function dataVideo(School $school, Request $request)
    {
        $id = $school->id;
        $eid = $school->edu_id;
        $scope = ['id' => "$id"];
        
        $model = Video::latest()
            ->whereDoesntHave('schools', function ($query) use ($scope) {
                $query->where('id', $scope);
            })
            ->whereHas('getEdu', function ($query) use ($eid) {
                $query->where('id', $eid);
            })
            ->filter(request(['ajax']));

        return DataTables::of($model)
            ->addIndexColumn()
            ->setRowId('id')
            ->make(true);
    }

    // public function majors(School $school, Request $request)
    // {
    //     $id = $school->id;
    //     $scope = ['id' => "$id"];
    //     $model = Major::latest()
    //             ->whereHas('schools', function ($query) use ($scope) {
    //                 $query->where('id', $scope);
    //             });

    //     // return response()->json($model);
    //     return DataTables::of($model)
    //         ->addIndexColumn()
    //         ->setRowId('id')
    //         ->toJson();
    // }

    // public function dataMajor(School $school, Request $request)
    // {
    //     $id = $school->id;
    //     $scope = ['id' => "$id"];
    //     $ajax = ['ajax' => "$request->ajax()"];
    //     if (empty($ajax)) {
    //         $model = Major::latest()
    //             // ->school($scope)
    //             ->whereDoesntHave('schools', function ($query) use ($scope) {
    //                 $query->where('id', $scope);
    //             });
    //     } else {
    //         $model = Major::latest()
    //             ->whereDoesntHave('schools', function ($query) use ($scope) {
    //                 $query->where('id', $scope);
    //             });
    //     }

    //     return DataTables::of($model)
    //         ->addIndexColumn()
    //         ->setRowId('id')
    //         ->toJson();
    // }

    //View Books per School
    public function showBook(School $school,Request $request)
    {
        return view('permission.book', compact('school'));
    }
    
    public function showVideo(School $school, Request $request)
    {
        return view('permission.video', compact('school'));
    }

    // public function showMajor(School $school,Request $request)
    // {
    //     return view('permission.jurusan', compact('school'));
    // }

    public function storeBook(School $school, Request $request)
    {
        $res = new stdClass;
        $edu = $school->edu_id;
        $book = Book::where('id',$request->id_buku)->first();
        if ($book->edu_id !== $edu) {
            $res->status = "error";
            $res->title = "Gagal";
            $res->message = "Akses buku gagal diberikan!";
        }
        else{
            $result = $school->books()->attach($request->id_buku);
        }
        if ($result != 0) {
            $res->status = "error";
            $res->title = "Gagal";
            $res->message = "Akses buku gagal diberikan!";
        }else{
            $res->status = "success";
            $res->title = "Berhasil";
            $res->message = "Akses buku berhasil diberikan!";
        }
        return response()->json($res);
    }

    public function storeVideo(School $school, Request $request)
    {
        $res = new stdClass;
        $result = $school->videos()->attach($request->id_video);

        if ($result != 0) {
            $res->status = "error";
            $res->title = "Gagal";
            $res->message = "Akses video gagal diberikan!";
            
        }else{
            $res->status = "success";
            $res->title = "Berhasil";
            $res->message = "Akses video berhasil diberikan!";
        }
        return response()->json($res);
    }
    
    // public function storeMajor(School $school,Request $request)
    // {
    //     $res = new stdClass;
    //     $result = $school->majors()->attach($request->id_jurusan);

    //     if ($result != 0) {
    //         $res->status = "success";
    //         $res->title = "Berhasil";
    //         $res->message = "Akses video gagal diberikan!";
    //     }else{
    //         $res->status = "success";
    //         $res->title = "Gagal";
    //         $res->message = "Akses video berhasil diberikan!";
    //     }
    //     return response()->json($res);
    // }

    public function showfilesekolah(School $school)
    {
        $id = $school->id;
        $book = Book::whereHas('schools', function ($query) use ($id) {
                $query
                    ->where('id', $id);
            })
            ->count();
        $vid = Video::whereHas('schools', function ($query) use ($id) {
                $query
                    ->where('id', $id);
            })
            ->count();

        // $jur = Major::whereHas('schools',function($query) use ($id){
        //         $query->where('id',$id);
        //         })
        //         ->count();
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
    
    // public function destroyMajor(School $school, Request $request)
    // {
    //     $major = $request->id_jurusan;
    //     $res = new stdClass;
    //     $del = $school->majors()->detach($major);
    //     if ($del == 0) {
    //         $status = 'error';
    //         $title = 'Gagal';
    //         $msg = 'Hapus akses jurusan gagal.';
    //     }else{
    //         $status = 'success';
    //         $title = 'Berhasil';
    //         $msg = 'Hapus akses jurusan berhasil.';
    //     }
    //     $res->status = $status;
    //     $res->title = $title;
    //     $res->message = $msg;
    //     return response()->json($res);
    // }
}
