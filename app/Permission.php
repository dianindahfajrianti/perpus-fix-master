<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public function schools()
    {
        return $this->hasMany(School::class,'id','school_id');
    }
}
