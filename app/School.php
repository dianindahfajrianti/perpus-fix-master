<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    //
    public function hasEdu()
    {
        return $this->hasOne(Education::class,'id','edu_id');
    }
}
