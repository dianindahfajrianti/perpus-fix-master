<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    public function onBook()
    {
        return $this->belongsToMany(Book::class);
    }
    public function onVideo()
    {
        return $this->belongsToMany(Video::class);
    }
    public function onUser()
    {
        return $this->belongsToMany(User::class);
    }
    public function schools()
    {
        return $this->belongsToMany(School::class,'major_school','major_id','school_id','maj_code','id')
        ->withTimestamps();
    }
    public function educations()
    {
        return $this->hasMany(Education::class,'id','edu_id');
    }
}
