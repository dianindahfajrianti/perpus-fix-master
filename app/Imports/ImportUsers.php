<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportUsers implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (@$row[3] == 'Guru') {
            $role = 2;
        }elseif (@$row[3] == 'Murid') {
            $role = 3;
        }else{
            $role = 3;
        }
        $grade = DB::table('grades')->where('grade_name','=',@$row[4])->value('id');
        $major = DB::table('majors')->where('maj_name','=',@$row[5])->value('id');
        $sch = (!empty(env('SCHOOL_ID'))) ? env('SCHOOL_ID') : null ;
        $pass = Hash::make(123456);
        //get each filter ID for this DB
        if ($role <= 2) {
            $wordID = "A";
        }else {
            $wordID = "U";
        }
        $fromDB = DB::table('users')->where('id','like',$wordID."%")->orderBy('id', 'DESC')->value('id');
        if ($fromDB == null) {
            $last = (int) "00001";
        } else {
            $last = substr($fromDB, 1, 5) + 1;
        }
        
        $id = $wordID . sprintf('%05s', $last);
        return new User([
            'id' => $id,
            'name' => @$row[0],
            'username' => @$row[1], 
            'email' => @$row[2],
            'role' => $role,
            'school_id' => $sch,
            'grade_id' => $grade,
            'major_id' => $major,
            'password' => $pass
        ]);
    }
}
