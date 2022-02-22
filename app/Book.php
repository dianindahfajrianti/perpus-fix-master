<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%')
                         ->orWhere('desc', 'like', '%' . $search . '%');
        });

        $query->when($filters['pendidikan'] ?? false, function($query, $pendidikan) {
            return $query->whereHas('getEdu', function($query) use ($pendidikan) {
                $query->where('edu_name', $pendidikan);
            });
        });

        $query->when($filters['kelas'] ?? false, function($query, $kelas) {
            return $query->whereHas('getGrade', function($query) use ($kelas) {
                $query->where('grade_name', $kelas);
            });
        });

        $query->when($filters['mapel'] ?? false, function($query, $mapel) {
            return $query->whereHas('getSubject', function($query) use ($mapel) {
                $query->where('sbj_name', $mapel);
            });
        });
    }
    
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
