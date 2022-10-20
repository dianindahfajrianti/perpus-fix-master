<?php 

namespace App\Http\Controllers\Api\V1;

use App\Book;
use stdClass;
use App\Video;
use App\School;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\GrantBook;
use App\Http\Resources\GrantVideo;

class PermissionApi extends Controller{

    public function book(School $school)
    {
        $sID = $school->id;
        $book = Book::whereHas('schools',function($query) use ($sID){
            $query->where('id',$sID)
            ->oldest('book_school.created_at');
        })
        ->first();
        return new GrantBook($book);
    }
    public function video(School $school)
    {
        $sID = $school->id;
        $vid = Video::whereHas('schools',function($query) use ($sID){
            $query->where('id',$sID)
            ->oldest('school_video.created_at');
        })
        ->first();
        return new GrantVideo($vid);
    }
}