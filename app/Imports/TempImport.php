<?php

namespace App\Imports;

use App\Temp;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;

class TempImport implements ToModel, SkipsOnError
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
            'name' => @$row[0],
            'username' => @$row[1],
            'email' => @$row[2],
            'role' => @$row[3],
            'sekolah' => @$row[4],
            'kelas' => @$row[5],
            'jurusan' => @$row[6]
        ]);
    }
}
