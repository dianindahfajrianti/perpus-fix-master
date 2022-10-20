<?php

namespace App;

use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%')
                         ->orWhere('desc', 'like', '%' . $search . '%')
                         ->orWhere('published_year', 'like', '%' . $search . '%')
                         ->orWhere('publisher', 'like', '%' . $search . '%')
                         ->orWhere('author', 'like', '%' . $search . '%');
        });

        $query->when($filters['ajax'] ?? false, function($query, $ajax) {
            return $query->where('title', 'like', '%' . $ajax . '%')
                         ->orWhere('desc', 'like', '%' . $ajax . '%')
                         ->orWhere('published_year', 'like', '%' . $ajax . '%')
                         ->orWhere('publisher', 'like', '%' . $ajax . '%')
                         ->orWhere('author', 'like', '%' . $ajax . '%');
        });

        $query->when($filters['jenjang'] ?? false, function($query, $jenjang) {
            return $query->whereHas('education', function($query) use ($jenjang) {
                $query->where('edu_name', $jenjang);
            });
        });

        $query->when($filters['kelas'] ?? false, function($query, $kelas) {
            return $query->whereHas('grades', function($query) use ($kelas) {
                $query->where('grade_name', $kelas);
            });
        });

        $query->when($filters['mapel'] ?? false, function($query, $mapel) {
            return $query->whereHas('subjects', function($query) use ($mapel) {
                $query->where('sbj_name', $mapel);
            });
        });

        $query->when($filters['jurusan'] ?? false, function($query, $mapel) {
            return $query->whereHas('majors', function($query) use ($mapel) {
                $query->where('sbj_name', $mapel);
            });
        });
    }

    public function schools()
    {
        return $this->belongsToMany(School::class,'book_school','book_id','school_id')
        ->withTimestamps();
    }
    
    //
    public function education()
    {
        return $this->hasOne(Education::class,'id','edu_id');
    }
    public function grades()
    {
        return $this->hasOne(Grade::class,'id','grade_id');
    }
    public function majors()
    {
        return $this->hasOne(Major::class,'id','major_id');
    }
    public function subjects()
    {
        return $this->hasOne(Subject::class,'id','sub_id');
    }
    public function histories()
    {
        return $this->belongsTo(History::class,'file_id','id');
    }
    public function getSizeAttribute()
    {
        $file = $this->filename;
        $path = storage_path("app/public/pdf");
        return File::size("$path/$file");
    }
    protected $fillable = [
        'title',
        'desc',
        'filename',
        'filetype',
        'clicked_time',
        'edu_id',
        'grade_id',
        'major_id',
        'sub_id',
        'published_year',
        'publisher',
        'author'
    ];
    public function getUploadedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }

    public function getUploadTimeAttribute()
    {
        $date = new DateTime($this->created_at);
        return $date->format('Y-m-d');
        //Carbon::createFromFormat('Y-m-d H:i:s',)->format('Y-m-d');
    }
}
