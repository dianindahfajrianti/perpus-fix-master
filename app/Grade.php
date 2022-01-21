<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    public function onBook()
    {
        return $this->belongsToMany(Book::class);
    }
    public function onVideo()
    {
        return $this->belongsToMany(Video::class);
    }
    public function onMajor()
    {
        return $this->belongsToMany(Major::class);
    }
    public function onUser()
    {
        return $this->belongsToMany(User::class);
    }
}
