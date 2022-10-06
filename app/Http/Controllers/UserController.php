<?php

namespace App\Http\Controllers;

use App\Temp;
use App\User;
use stdClass;
use App\Grade;
use App\Major;
use App\School;
use App\History;
use App\Imports\TempImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Filesystem\Filesystem;
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
        $res = new stdClass;
        $request->validate([
            'xcl'  => 'required|mimes:xls,xlsx'
        ]);
        
        try {
            $file = $request->file('xcl');

            // $path = 'public/temp';
            // $filename = $file->getClientOriginalName();
            // $file->storeAs($path,$filename);
            
            $imp = (new TempImport);
            $imp->import($file);

            $temps = Temp::all();
            foreach ($temps as $temp) {
                
                $user = new User;
                if ($temp->role == 'Sekolah') {
                    $role = 1;
                }elseif ($temp->role == 'Guru') {
                    $role = 2;
                }else{
                    $role = 3;
                };
                if ($role <= 2) {
                    $wordID = "A";
                }else {
                    $wordID = "U";
                };

                $fromDB = DB::table('users')->where('id','like',$wordID."%")->orderBy('id','DESC')->value('id');

                if ($fromDB == null) {
                    $last = (int) "00001";
                }else {
                    $last = substr($fromDB,1,5)+1;
                }
                $id = $wordID.sprintf('%05s',$last);
                
                $sch = School::where('sch_name','=',$temp->sekolah)->first();
                $grade = Grade::where('grade_name','=',$temp->kelas)->first();
                $mjr = Major::where('maj_name','=',$temp->jurusan)->first();
                if (empty($grade)) {
                    $gr = null;
                }else{
                    $gr = $grade->id;
                }
                if (empty($mjr)) {
                    $mj = null;
                }else {
                    $mj = $mjr->id;
                }
                
                $user->id = $id;
                $user->name = $temp->name;
                $user->username = $temp->username;
                $user->email = $temp->email;
                $user->password = Hash::make(123456);
                $user->role = $role;
                $user->school_id = $sch->id;
                $user->grade_id = $gr;
                $user->major_id = $mj;
                $save = $user->save();
            }
            
            if ($save) {
                Temp::truncate();
                
                $res->status = 'success';
                $res->message = 'Users imported successfully.';
                
                return redirect()->route('user.index')->with($res->status, json_encode($res));
            }else{
                $res->status = 'error';
                $res->message = 'Failed to import users.';
        
                return redirect()->route('user.index')->with($res->status, json_encode($res));
            }
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            
            foreach ($failures as $key => $val) {
                $val->row(); // row that went wrong
                $val->attribute(); // either heading key (if using heading row concern) or column index
                $val->errors(); // Actual error messages from Laravel validator
                $val->values(); // The values of the row that has failed.
                
                $res->message[$key] = $val->errors();
            }
            $res->status = 'error';

            return redirect()->route('user.index')->with($res->status, json_encode($res));
        }
    }
    public function import(Request $request)
    {
        $this->validate($request, [
            'xcl'  => 'required|mimes:xls,xlsx'
        ]);

        $path = $request->file('xcl')->getRealPath();

        $data = Excel::load($path)->get();

        if ($data->count() > 0) {
            foreach ($data->toArray() as $key => $value) {
                foreach ($value as $row) {
                    if ($row['role'] < 2) {
                        $wordID = "A";
                    }else {
                        $wordID = "U";
                    }
                    $fromDB = DB::table('users')->where('id','like',$wordID)->orderBy('id','DESC')->value('id');
                    if ($fromDB == null) {
                        $last = (int) "00001";
                    } else {
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
        if ($request->role < 1) {
            $sch = '';
            $murid ='';
            $val = 'required|alpha_num|min:6|max:19';
        }else{
            if ($request->role == 3) {
                $murid = 'required';
            }else{
                $murid ='';
            }
            $sch = 'required';
            $val = "required|digits_between:6,19|unique:users,username";
        };
        $request->validate([
            'nama' => 'required',
            'username' => $val,
            'email' => 'required|email',
            'sekolah' => $sch,
            'kelas' => $murid,
            'jurusan' => $murid,
            'role' => 'required|digits_between:0,3'
        ]);
        
        try {
            $user = new User;
            $role = $request->role;
            if ($request->role <= 2) {
                $wordID = "A";
            }else {
                $wordID = "U";
            }
            $fromDB = DB::table('users')->where('id','like',$wordID."%")->orderBy('id','DESC')->value('id');
            if ($fromDB == null) {
                $last = (int) "00001";
            }else {
                $last = substr($fromDB,1,5)+1;
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
            $user->role = $role;
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
        $rel = ['grades','majors','schools'];
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
        if ($request->role < 1) {
            $sch = '';
            $murid ='';
            $val = 'required|alpha_num|min:6|max:19';
        }else{
            if ($request->role == 3) {
                $murid = 'required';
            }else{
                $murid ='';
            }
            $sch = 'required';
            $val = "required|digits_between:6,19";
        }
        $request->validate([
            'nama' => 'required',
            'username' => $val,
            'email' => 'required|email',
            'sekolah' => $sch,
            'kelas' => $murid,
            'jurusan' => $murid,
            'role' => 'required|digits_between:0,3'
        ]);
        try {
            $user->name = $request->nama ;
            $user->username = $request->username ;
            $user->email = $request->email ;
            $user->school_id = $request->sekolah;
            $user->grade_id = $request->kelas;
            $user->major_id = $request->jurusan;
            $user->role = $request->role;
            if (!empty($request->pass)) {
                $user->password = Hash::make($request->pass);
            };
            $user->save();
            $stat = "success";
            $msg = "User $request->nama berhasil diubah!";

            $res->status = $stat;
            $res->message= $msg;
            return redirect()->route('user.index')->with($stat,json_encode($res));
        } catch (\Exception $th) {
            $stat = "error";
            $msg = $th;
            $res->status = $stat;
            $res->message= $msg;
            return redirect()->back()->with($stat,json_encode($res));
        }
        if (!empty($request->password)) {
            # code...
        }
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

    public function profile()
    {
        $uid = auth()->user()->id;
        $attr = ['schools','grades','majors'];
        $nosch = ['grades','majors'];
        $us = User::with($attr)->findOrFail($uid);
        
        if ($us !== null ) {
            $user = $us;
        }else {
            $user = User::findOrFail($uid)->with($nosch);
        }
        // return $user;
        $riwayat = History::where('userid','=',$uid)->types()->limit(6)->get();
        // return $riwayat;
        return view('home.profile',compact('user','riwayat'));
    }

    public function changePass(Request $request)
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
            
            return redirect('/profile')->with($res->status,json_encode($res));
            
        }else{
            $res->status = 'error';
            $res->message = 'Password Salah';
            
            return redirect('/profile')->with($res->status,json_encode($res));
            
        }
    }
}
