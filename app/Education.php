<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    public function fromBook()
    {
        return $this->belongsToMany(Education::class,'id','edu_id');
    }
}
