<?php

namespace App\Imports;

use App\Temp;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class TempImport implements ToModel, WithValidation, WithHeadingRow, SkipsOnError
{
    use Importable, SkipsErrors;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        
        return new Temp([
            'name' => @$row['name'],
            'username' => @$row['username'],
            'email' => @$row['email'],
            'role' => @$row['role'],
            'sekolah' => @$row['sekolah'],
            'kelas' => @$row['kelas'],
            'jurusan' => @$row['jurusan']
        ]);
    }
    public function rules(): array
    {
        return [
            'name' => 'required',
            'username' => 'required|digits_between:6,15|unique:users,username',
            'email' => 'required|unique:users,email|email',
            'role' => 'required',
            'sekolah' => 'required|exists:schools,sch_name',
            'kelas' => '',
            'jurusan' => '',
        ];
    }
}
