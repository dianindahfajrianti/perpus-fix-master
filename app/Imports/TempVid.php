<?php

namespace App\Imports;

use App\TempVid as AppTempVid;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class TempVid implements ToModel, WithValidation, WithHeadingRow, SkipsOnError
{
    use Importable, SkipsErrors;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new AppTempVid([
            'judul' => @$row['judul'],
            'deskripsi' => @$row['deskripsi'],
            'nama_pembuat' => @$row['nama_pembuat'],
            'thumbnail' => @$row['thumbnail'],
            'jenjang' => @$row['jenjang'],
            'kelas' => @$row['kelas'],
            'jurusan' => @$row['jurusan'],
            'mapel' => @$row['mapel'],
            'nama_file' => @$row['nama_file'],
            'tipe_file' => @$row['tipe_file']
        ]);
    }
    public function rules(): array
    {
        return [
            'judul' => 'required',
            'deskripsi' => '',
            'nama_pembuat' => 'required',
            'thumbnail' => 'required',
            'jenjang' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'mapel' => 'required',
            'nama_file' => 'required',
            'tipe_file' => 'required'
        ];
    }
}
