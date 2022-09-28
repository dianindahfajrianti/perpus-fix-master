<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    
    public function major()
    {
        return $this->hasOne(Major::class,'id','parent_id');
    }
    public function book()
    {
        return $this->belongsTo(Book::class,'sub_id','id');
    }
    public function video()
    {
        return $this->belongsTo(Video::class,'sub_id','id');
    }
}
