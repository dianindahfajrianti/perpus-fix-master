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
use Maatwebsite\Excel\Facades\Excel;
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
        $mjr = Major::all();
        if (Auth::user()->role < 1) {
            $user = User::all();
        } else {
            $user = User::where('role', '>=', 1)->get();
        }
        return view('user.index', compact('user','edu','sch','grade','mjr'));
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
        $request->validate([
            'nama' => 'required',
            'username' => 'required|max:10|numeric',
            'email' => 'required|email',
            'sekolah' => 'required',
            'jenjang' => 'required',
            'kelas' => 'required',
            'role' => 'required'
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
