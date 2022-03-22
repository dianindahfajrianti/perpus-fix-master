<?php

namespace App\Http\Controllers;

use App\User;
use stdClass;
use App\Grade;
use App\Major;
use App\School;
use App\History;
use App\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sch = School::all();
        $grade = Grade::all();
        $maj = Major::all();
        return view('user.index', compact('sch','grade','maj'));
    }

    public function data(Request $request)
    {
        if (empty($request->ajax())) {
            $model = User::all();
        }else{
            if (Auth::check()) {
                $sch = Auth::user()->school_id;
            }else{
                if (empty(env('SCHOOL_ID'))) {
                    return redirect('login');
                }else{
                    $sch = env('SCHOOL_ID');
                }
            }
            if (Auth::user()->role < 1) {
                $model = User::all();
            } else {
                $model = User::where('role', '>=', 1)->where('school_id','=',$sch);
            }
        }
        
        return DataTables::of($model)
            ->addIndexColumn()
            ->setRowId('id')
            ->toJson();
    }

    public function export(School $school)
    {
        $id = $school->id;
        $user = User::where('school_id',$id)->get()->makeVisible('password');
        $super = User::where('role',0)->get()->makeVisible(['password']);
        $users = $user->concat($super);
        if (empty($user)|| empty($super)) {
            return response()->json([],404);
        } else {
            return response()->json($users,200);
        }
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
            'xcl'  => 'required|mimes:xls,xlsx'
        ]);
        $path = $request->file('xcl')->getRealPath();

        $data = Excel::load($path)->get();

        if ($data->count() > 0) {
            foreach ($data->toArray() as $key => $value) {
                foreach ($value as $row) {
                    $fromDB = DB::table('users')->value('id');
                    if ($fromDB == null) {
                        $last = (int) "00001";
                    } else {
                        if ($row['role'] < 2) {
                            $wordID = "A";
                        }else {
                            $wordID = "U";
                        }
                        $last = substr($fromDB, 1, 5) + 1;
                    }
                    $id = $wordID . sprintf('%05s', $last);
                    $insert_data[] = array(
                        'id' => $id,
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
            'username' => 'required|unique:users,username|alpha_num|min:6|max:15',
            'email' => 'required|email',
            'sekolah' => 'required',
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
            if ($user->save()) {
                $stat = "success";
                $msg = "User $request->nama berhasil ditambahkan!";
            } else {
                $stat = "error";
                $msg = "User $request->nama gagal ditambahkan!";
            }

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
        $sch = School::all();
        $grade = Grade::all();
        $maj = Major::all();

        return view('user.edit',compact('user','sch','grade','maj'));
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
            $user->name = $request->nama ;
            $user->username = $request->username ;
            $user->email = $request->email ;
            $user->school_id = $request->sekolah;
            $user->grade_id = $request->kelas;
            $user->major_id = $request->jurusan;
            $user->role = $request->role;
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
        $res = new stdClass();
        $nama = $user->name;
        try {
            if ($user->id == Auth::user()->id) {
                $stat = "error";
                $msg = "Error, please contact Super Admin!";
            }else {
                $del = $user->delete();
            }
            if ($del) {
                $stat = "success";
                $msg = "User $nama berhasil dihapus!";
            }else{
                $stat = "error";
                $msg = "Error, please contact Super Admin!";
            }
            $res->status = $stat;
            $res->url = route('user.index');
            $res->message = $msg;

            return response()->json($res);
        } catch (\Exception $ex) {
            $stat = "error";
            $msg = $ex;
            $res->status = $stat;
            $res->url = route('user.index');
            $res->message = $msg;

            return response()->json($res);
            
        }
    }

    public function profile(User $user)
    {
        $riwayat = [];
        if ($user->with('getSchool')->get() != null ) {
            $user = $user->where('id','=',$user->id)->with('getSchool','getGrade','getMajor')->get();
        }else {
            $user = $user->where('id','=',$user->id)->get();
        }
        // $riwayat = History::where('user_id','=',$user->id)->get();
        return view('home.profile',compact('user','riwayat'));
    }

    public function reset(Request $request)
    {
        $res = new stdClass;
        $uid= Auth::user()->id;
        $user = User::findOrFail($uid);
        $hauth = Auth::user()->password;
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:6|alpha_num|max:16',
            'konfirmasi_password' => 'required|same:password_baru'
        ]);
        
        $hpass = Hash::make($request->password_baru);

        if (Hash::check($request->password_lama,$hauth)) {
            $user->password = $hpass;
            $user->save();

            $res->status = 'success';
            $res->message = 'Password berhasil diubah';
            
            return redirect('/profile/'.$uid)->with($res->status,json_encode($res));
            
        }else{
            $res->status = 'error';
            $res->message = 'Password Salah';
            
            return redirect('/profile/'.$uid)->with($res->status,json_encode($res));
            
        }
    }
}
