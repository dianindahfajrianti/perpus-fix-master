<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    public function book()
    {
        return $this->belongsTo(Book::class,'id','edu_id');
    }
    public function video()
    {
        return $this->belongsTo(Video::class,'id','edu_id');
    }
    public function school()
    {
        return $this->belongsTo(School::class,'id','edu_id');
    }
    // tambahan
    protected $fillable = ['grade_name', 'edu_name', 'sbj_name', 'title'];
    
    public function files()
    {
        return $this->hasMany(Files::class);
    }

    public function majors()
    {
        return $this->belongsTo(Major::class,'edu_id','id');
    }
}
