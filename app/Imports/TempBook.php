<?php

namespace App\Imports;

use Illuminate\Validation\Rule;
use App\TempBook as AppTempBook;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class TempBook implements ToModel, WithValidation, WithHeadingRow, SkipsOnError
{
    use Importable, SkipsErrors;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new AppTempBook([
            'judul' => @$row['judul'],
            'deskripsi' => @$row['deskripsi'],
            'th_terbit' => @$row['th_terbit'],
            'penerbit' => @$row['penerbit'],
            'pengarang' => @$row['pengarang'],
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
            'th_terbit' => 'required',
            'penerbit' => 'required',
            'pengarang' => 'required',
            'jenjang' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'mapel' => 'required',
            'nama_file' => 'required',
            'tipe_file' => 'required'
        ];
    }
}
