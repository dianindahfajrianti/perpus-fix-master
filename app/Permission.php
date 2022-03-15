<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Permission extends Pivot
{
    public function books()
    {
        return $this->belongsTo(Book::class,'book_id');
    }
    public function schools()
    {
        return $this->belongsTo(School::class,'school_id');
    }
}
