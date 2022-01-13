<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    protected $fillable = [
        'name',
        'edu_id',
        'grade_id',
        'maj_id',
        'sub_id',
        'total'
    ];
}
