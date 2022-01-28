<?php

namespace App\Http\Controllers;

use App\Education;
use App\Grade;
use App\Major;
use App\School;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use stdClass;
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
        $edu = Education::all();
        $sch = School::all();
        $grade = Grade::all();
        $maj = Major::all();
        if (Auth::user()->role < 1) {
            $user = User::all();
        } else {
            $user = User::where('role', '>=', 1)->get();
        }
        return view('user.index', compact('user','edu','sch','grade','maj'));
    }

    public function data()
    {
        $model = User::all();
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
        return view('user.add', compact('sch', 'grade', 'mjr'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'select_file'  => 'required|mimes:xls,xlsx'
        ]);
        $path = $request->file('select_file')->getRealPath();

        $data = Excel::load($path)->get();

        if ($data->count() > 0) {
            foreach ($data->toArray() as $key => $value) {
                foreach ($value as $row) {
                    $fromDB = DB::table('users')->value('id');
                    $wordID = "A";
                    if ($fromDB == null) {
                        $last = (int) "00001";
                    } else {
                        if ($row['role'] < 2) {
                            # code...
                        }
                        $last = substr($fromDB, 1, 5) + 1;
                    }
                    $id = $wordID . sprintf('%05s', $last);
                    $insert_data[] = array(
                        'CustomerName'  => $row['customer_name'],
                        'Gender'   => $row['gender'],
                        'Address'   => $row['address'],
                        'City'    => $row['city'],
                        'PostalCode'  => $row['postal_code'],
                        'Country'   => $row['country']
                    );
                }
            }

            if (!empty($insert_data)) {
                DB::table('tbl_customer')->insert($insert_data);
            }
        }
        return back()->with('success', 'Excel Data Imported successfully.');
    }
    public function storeOne(Request $request)
    {
        $res = new stdClass();
        
        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|email',
            'sekolah' => 'required',
            'jurusan' => 'required',
            'kelas' => 'required',
            'role' => 'required'
        ]);
        
        try {
            $user = new User;
            $fromDB = DB::table('users')->value('id');
            if ($fromDB == null) {
                $last = (int) "00001";
            }else {
                $last = substr($fromDB,1,5)+1;
            }
            if ($request->role <= 2) {
                $wordID = "A";
            }else {
                $wordID = "U";
            }
            $id = $wordID.sprintf('%05s',$last);

            $user->id = $id;
            $user->name = $request->nama;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = Hash::make('123456');
            $user->school_id = $request->sekolah;
            $user->grade_id = $request->kelas;
            $user->major_id = $request->jurusan;
            $user->role = $request->role;
            $user->save();

            $stat = "success";
            $msg = "User $request->nama berhasil ditambahkan!";

            $res->status = $stat;
            $res->message= $msg;

            return redirect()->route('user.index')->with($stat,json_encode($res));

        } catch (\Exception $th) {

            $stat = "error";
            $msg = $th;

            $res->status = $stat;
            $res->message= $msg;
            return redirect()->route('user.index')->with($stat,json_encode($res));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $rel = ['getGrade','getMajor','getSchool'];
        $user = $user->with($rel)
                ->where('id','=',$user->id)
                ->first();
        // return compact('user');
        return view('user.showuser',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // return ;
        return view('user.edit',compact('user'));
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
        $res = new stdClass();
        $request->validate([
            'nama' => 'required',
            'username' => 'required|max:10|numeric',
            'email' => 'required|email',
            'sekolah' => 'required',
            'jenjang' => 'required',
            'kelas' => 'required',
            'role' => 'required'
        ]);
        try {
            $user->nama = $request->nama ;
            $user->username = $request->username ;
            $user->email = $request->email ;
            $user->sekolah = $request->sekolah ;
            $user->jenjang = $request->jenjang ;
            $user->kelas = $request->kelas ;
            $user->role = $request->role ;
            $user->save();
            $stat = "success";
            $msg = "User $request->nama berhasil ditambahkan!";

        } catch (\Exception $th) {
            $stat = "error";
            $msg = $th;
        }
        $res->status = $stat;
        $res->message= $msg;
        return redirect()->route('user.index')->with($stat,json_encode($res));
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
