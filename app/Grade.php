<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    public function onBook()
    {
        return $this->belongsTo(Book::class,'grade_id','id');
    }
    public function onVideo()
    {
        return $this->belongsTo(Video::class,'grade_id','id');
    }
    public function onUser()
    {
        return $this->belongsTo(User::class,'grade_id','id');
    }
}
