<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    public function book()
    {
        return $this->belongsToMany(Book::class);
    }
    public function video()
    {
        return $this->belongsToMany(Video::class);
    }
    public function user()
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
        return $this->hasOne(Education::class,'id','edu_id');
    }
}
