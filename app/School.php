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
    public function books()
    {
        return $this->belongsToMany(Book::class,'book_school','school_id','book_id')
        ->withTimestamps();
    }
    public function videos()
    {
        return $this->belongsToMany(Video::class,'school_video','school_id','video_id','id','id')
        ->withTimestamps();
    }
}
