<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function hasMajor()
    {
        return $this->hasOne(Major::class,'id','parent_id');
    }
    public function onBook()
    {
        return $this->belongsTo(Book::class,'sub_id','id');
    }
    public function onVideo()
    {
        return $this->belongsTo(Video::class,'sub_id','id');
    }
}
