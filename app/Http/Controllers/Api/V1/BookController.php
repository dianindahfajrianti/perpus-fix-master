<?php 

namespace App\Http\Controllers\Api\V1;

use App\Book;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\School;
use Illuminate\Http\Request;
use stdClass;

class BookController extends Controller{

    public function index()
    {
        $scope = request('sch_id');
        abort_if(empty($scope),404);
        $book = Book::latest()
            // ->school($scope)
            ->with('education','grades')
            ->whereHas('schools', function ($query) use ($scope) {
                $query->where('id', $scope);
            })->get();
        
        return BookResource::collection($book);
    }

    public function show(Book $book)
    {
        return new BookResource($book);
    }

    public function sync(School $school, Request $request)
    {
        abort_if(empty($request->buku),404);
        $id = $school->id;
        $data = json_decode($request->buku);
        $date = $request->date;
        // return response()->json($data);
        $arr = [];
        foreach($data as $b){
            array_push($arr,$b->filename);
        }
        // return response()->json($arr);
        $book = Book::latest()
        ->whereHas('schools', function ($query) use ($id,$date) {
            $query->where('id', $id)
            ->whereDate('book_school.updated_at','>=',$date);
        })
        ->whereNotIn('filename', $arr)
        ->get();
        $books = BookResource::collection($book);
        if (!$books->isEmpty()) {
            $res = new stdClass;
            $res->book = $books;
            $res->behave = TRUE;
            return response()->json($res);
        }else{
            $rs = [
                'behave' => FALSE,
                'message' => "Nothing to sync on master's bookshelves"
            ];
            return response()->json($rs);
        }
    }
}