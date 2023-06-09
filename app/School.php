<?php

namespace App;

use DateTime;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{

    public function education()
    {
        return $this->hasOne(Education::class,'id','edu_id');
    }
    public function book()
    {
        return $this->belongsTo(Book::class,'school_id','id');
    }
    public function video()
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
        return $this->belongsToMany(Video::class,'school_video','school_id','video_id')
        ->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class,'school_id','id');
    }

    // public function majors()
    // {
    //     return $this->belongsToMany(Major::class,'major_school','school_id','major_id','id','maj_code')
    //     ->withTimestamps();
    // }

    public function getUploadDateAttribute()
    {
        $date = new DateTime($this->created_at);
        return $date->format('Y-m-d');
    }
}
