<?php

namespace App\Imports;

use App\Temp;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TempImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Temp([
            'name' => $row['name'],
            'username' => $row['username'],
            'email' => $row['email'],
            'role' => $row['role'],
            'sekolah' => $row['sekolah'],
            'kelas' => $row['kelas'],
            'jurusan' => $row['jurusan']
        ]);
    }
}
