<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempBook extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'judul' ,
        'deskripsi' ,
        'th_terbit' ,
        'penerbit' ,
        'pengarang' ,
        'thumbnail' ,
        'jenjang' ,
        'kelas' ,
        'jurusan' ,
        'mapel' ,
        'nama_file' ,
        'tipe_file' 
    ];
}
