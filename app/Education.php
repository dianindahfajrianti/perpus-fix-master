<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    public function onBook()
    {
        return $this->belongsTo(Education::class,'edu_id','id');
    }
    public function onMedia()
    {
        return $this->belongsTo(Video::class,'edu_id','id');
    }
    public function onSchool()
    {
        return $this->belongsTo(School::class,'edu_id','id');
    }
}
