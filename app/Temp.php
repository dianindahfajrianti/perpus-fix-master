<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Temp extends Model
{
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'name',
        'username',
        'email',
        'sekolah',
        'role',
        'kelas',
        'jurusan',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
    ];
}
