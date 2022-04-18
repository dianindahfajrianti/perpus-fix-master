<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%')
                         ->orWhere('desc', 'like', '%' . $search . '%')
                         ->orWhere('creator', 'like', '%' . $search . '%');
        });

        $query->when($filters['ajax'] ?? false, function($query, $ajax) {
            return $query->where('title', 'like', '%' . $ajax . '%')
                         ->orWhere('desc', 'like', '%' . $ajax . '%')
                         ->orWhere('creator', 'like', '%' . $ajax . '%');
        });

        $query->when($filters['jenjang'] ?? false, function($query, $jenjang) {
            return $query->whereHas('getEdu', function($query) use ($jenjang) {
                $query->where('edu_name', $jenjang);
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
        return $this->hasOne(Subject::class,'id','sub_id');
    }
    protected $fillable = [
        'title','desc','filename','filetype','thumb','clicked_time',
        'school_id',
        'edu_id',
        'grade_id',
        'major_id',
        'sub_id',
        'creator'
    ];
    public function schools()
    {
        return $this->belongsToMany(School::class,'school_video','video_id','school_id')
        ->withTimestamps();
    }
    public function getUploadDateAttribute()
    {
        $date = new DateTime($this->created_at);
        return $date->format('Y-m-d');
        //Carbon::createFromFormat('Y-m-d H:i:s',)->format('Y-m-d');
    }
}
