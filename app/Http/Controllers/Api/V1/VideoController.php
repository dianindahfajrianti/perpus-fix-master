<?php 
namespace App\Http\Controllers\Api\V1;

use stdClass;
use App\Video;
use App\School;
use App\Http\Controllers\Controller;
use App\Http\Resources\VideoResource;
use Illuminate\Http\Request;

class VideoController extends Controller
{

    public function index()
    {
        $scope = request('sch_id');
        abort_if(empty($scope),404);
        $video = Video::latest()
            // ->school($scope)
            ->with('education','grades')
            ->whereHas('schools', function ($query) use ($scope) {
                $query->where('id', $scope);
            })->get();
        
        return VideoResource::collection($video);
    }

    public function show(Video $video)
    {
        return new VideoResource($video);
    }

    public function sync(School $school, Request $request)
    {
        abort_if(empty($request->video),404);
        $id = $school->id;
        $data = json_decode($request->video);
        $date = $request->date;
        $arr = [];
        foreach($data as $b){
            array_push($arr,$b->filename);
        }
        $video = Video::latest()
        ->whereHas('schools', function ($query) use ($id,$date) {
            $query->where('id', $id)
            ->whereDate('school_video.updated_at','>',$date);
        })
        ->whereNotIn('filename', $arr)
        ->get();
        $videos = VideoResource::collection($video);
        if (!$videos->isEmpty()) {
            $res = new stdClass;
            $res->video = $videos;
            $res->behave = TRUE;
            return response()->json($res);
        }else{
            $rs = [
                'behave' => FALSE,
                'message' => "Nothing to sync on master's gallery"
            ];
            return response()->json($rs);
        }
    }

}