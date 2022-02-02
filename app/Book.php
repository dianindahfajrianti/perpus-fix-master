<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    public function getEdu()
    {
        return $this->hasOne(Education::class,'id','edu_id');
    }
    public function getGrade()
    {
        return $this->hasOne(Grade::class,'id','grade_id');
    }
    public function getMajor()
    {
        return $this->hasOne(Major::class,'id','major_id');
    }
    public function getSubject()
    {
        return $this->hasOne(Subject::class,'id','subject_id');
    }
    
    protected $fillable = [
        'title',
        'desc',
        'filename',
        'filetype',
        'clicked_time',
        'school_id',
        'edu_id',
        'grade_id',
        'major_id',
        'sub_id',
        'published_year',
        'publisher',
        'author'
    ];
}
