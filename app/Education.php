<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    public function onBook()
    {
        return $this->belongsTo(Education::class,'id','edu_id');
    }
    public function onVideo()
    {
        return $this->belongsTo(Video::class,'id','edu_id');
    }
    public function onSchool()
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
        return $this->belongsTo(Majors::class,'edu_id','id');
    }
}
