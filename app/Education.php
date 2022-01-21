<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    public function onBook()
    {
        return $this->belongsToMany(Education::class);
    }
    public function onMedia()
    {
        return $this->belongsToMany(Video::class);
    }
    public function onSchool()
    {
        return $this->belongsToMany(School::class);
    }
}
