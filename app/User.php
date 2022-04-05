<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'name',
        'username',
        'email',
        'role',
        'edu_id',
        'grade_id',
        'major_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getSchool()
    {
        return $this->hasOne(School::class,'id','school_id');
    }
    public function getGrade()
    {
        return $this->hasOne(Grade::class,'id','grade_id');
    }
    public function getMajor()
    {
        return $this->hasOne(Major::class,'id','major_id');
    }
    public function onHistory()
    {
        return $this->belongsTo(History::class,'userid','id');
    }
}
