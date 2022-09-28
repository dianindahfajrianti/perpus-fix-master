<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    public function book()
    {
        return $this->belongsTo(Book::class,'grade_id','id');
    }
    public function video()
    {
        return $this->belongsTo(Video::class,'grade_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'grade_id','id');
    }
// tambahan
    protected $fillable = ['grade_name', 'edu_name', 'sbj_name', 'title'];
    
    public function files()
    {
        return $this->hasMany(Files::class);
    }
}
