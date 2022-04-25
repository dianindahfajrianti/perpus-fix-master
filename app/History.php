<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class History extends Model
{
    // use SoftDeletes;
    
    public function books()
    {
        return $this->hasOne(Book::class,'id','file_id');
    }

    public function videos()
    {
        return $this->hasOne(Video::class,'id','file_id');
    }

    // public function getFiles($query)
    // {
    //     $type = $this->type;
    //     return $query->when($type === 'mp4',function($que)
    //     {
    //         return $que->with('videos');
    //     })->
    //     when($type === 'pdf', function($que)
    //     {
    //         return $que->with('books');
    //     });
    // }

    public function scopeTypes($query)
    {
        $type = "$this->type";
        return $query
        ->when($type = "mp4",function($q)
        {
            return $q->with('videos');
        })
        ->when($type = "pdf",function($q)
        {
            return $q->with('books');
        });
    }
}
