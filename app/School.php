<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    public function hasEdu()
    {
        return $this->hasOne(Education::class,'id','edu_id');
    }
    public function onBook()
    {
        return $this->belongsTo(Book::class,'school_id','id');
    }
    public function onVideo()
    {
        return $this->belongsTo(Video::class,'school_id','id');
    }
}
