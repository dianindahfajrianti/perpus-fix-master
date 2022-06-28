<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempVid extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'judul',
        'deskripsi',
        'nama_pembuat',
        'thumbnail',
        'jenjang',
        'kelas',
        'jurusan',
        'mapel',
        'nama_file',
        'tipe_file'
    ];
}
