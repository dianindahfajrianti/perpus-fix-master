<?php

namespace App\Http\Controllers;

use App\Book;
use App\User;
use stdClass;
use App\Grade;
use App\Major;
use App\Video;
use App\Export;
use App\School;
use ZipArchive;
use App\Subject;
use App\Education;
use MultipartCompress;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Request;

class ExportController extends Controller
{
    public function user(School $school)
    {
        $id = $school->id;
        $user = User::with(['schools','grades','majors'])
                ->where('school_id',$id)->get()->makeVisible('password');
        $super = User::with(['schools','grades','majors'])
                ->where('role',0)->get()->makeVisible(['password']);
        $users = $user->concat($super);
        if (empty($user)|| empty($super)) {
            return response()->json([],404);
        } else {
            $ex = new Export;
            $ex->type = "user";
            $ex->sch_id = $id;
            $ex->save();

            return response()->json($users,200);
        }
    }
    
    public function filter(School $school)
    {
        try {
            $id = $school->edu_id;
            $sid = $school->id;
            $edu = Education::where('id',$id)->get();
            $eduname = DB::table('education')->where('id',$id)->value('edu_name');
            $gr = new stdClass;
            $sd = str_contains($eduname,'SD');
            $smp = str_contains($eduname,'SMP');
            $sma = str_contains($eduname,'SMA');
            $smk = str_contains($eduname,'SMK');
            $mi = str_contains($eduname,'MI');
            $mts = str_contains($eduname,'Mts');
            $ma = str_contains($eduname,'MA');
            if ($sd || $mi) {
                $gr = Grade::where('grade_name','<','7')->get();
            }
            if ($smp || $mts) {
                $gr = Grade::where('grade_name','>=','7')
                        ->where('grade_name','<=','9')
                        ->get();
            }
            if ($sma || $smk || $ma) {
                $gr = Grade::where('grade_name','>=','10')
                      ->where('grade_name','<=','12')
                      ->get();
            }
            $scope = ['id' => $sid];
            $scopeEdu = ['id' => $id];
            $maj = Major::whereHas('educations',function($query) use ($scopeEdu){
                        $query->where('id',$scopeEdu);
                    })
                    ->get();
            $mj = Major::where('maj_name','Umum')
                    ->whereHas('educations',function($query) use ($scopeEdu){
                        $query->where('id',$scopeEdu);
                    })
                    ->first();
            $maj_id = $mj->id;
            $sub = Subject::where('parent_id',$maj_id)->get();
            $sch = School::where('id',$sid)->get();
            $filters = [
                'edu' => $edu,
                'grade' => $gr,
                'jur' => $maj,
                'sub' => $sub,
                'school' => $sch
            ];
            $ex = new Export;
            $ex->type = "filter";
            $ex->sch_id = $id;
            $ex->save();

            return response()->json($filters);   
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function book(School $school)
    {
        set_time_limit(0);
        //get data
        $id = $school->id;
        $path = storage_path("app/public/pdf/");
        $thumbpath = storage_path("app/public/thumb/pdf/");
        $tempFolder = $path."tmp/$id/";
        $tempThumb = $thumbpath."tmp/$id/";
        
        $fileName = 'pdf-'.$id.".zip";
        $fileThumb = 'pdf-'.$id.".zip";
        $fileName2 = 'part-'.$id.".zip";
        $fileThumb2 = 'part-'.$id.".zip";
        $fileName = 'pdf-'.$id.".zip";
        $fileThumb = 'pdf-'.$id.".zip";


        if (!is_dir($tempFolder)) {
            mkdir($tempFolder);
        }
        if (!is_dir($tempThumb)) {
            mkdir($tempThumb);
        }
        //clear path
        $file = new Filesystem;
        $file->cleanDirectory($tempFolder);
        $fil = new Filesystem;
        $fil->cleanDirectory($tempThumb);

        $book = Book::latest()
                ->with('education','grades','majors','subjects')
                ->whereHas('schools', function ($query) use ($id) {
                    $query->where('id', $id);
                })->get();
        
        //copy file to temp
        foreach($book as $b){
            copy($path.$b->filename,$tempFolder.$b->filename);
            copy($thumbpath.$b->thumb,$tempThumb.$b->thumb);
        };

        //zip all pdf file
        $zip = new ZipArchive;
        if ($zip->open($tempFolder.$fileName, ZipArchive::CREATE) === TRUE)
        {
            $files = File::files($tempFolder);
            
            foreach ($files as $key => $value) {
                $relativeNameInZipFile = basename($value);
                $zip->addFile($value, $relativeNameInZipFile);
            }
            $zip->close();
        }
        //zip thumbnail
        $zips = new ZipArchive;
        if ($zips->open($tempThumb.$fileThumb, ZipArchive::CREATE) === TRUE)
        {
            $files = File::files($tempThumb);
            foreach ($files as $key => $value) {
                $relativeNameInZipFile = basename($value);

                $zips->addFile($value, $relativeNameInZipFile);
            }
            
            $zips->close();
        }

        //split zip thumbnail
        $s = 150 * 1024 * 1024;
        $partZips = MultipartCompress::zip($tempThumb.$fileThumb,$tempThumb.$fileThumb2,$s);
        //delete original thumbnail zip
        File::delete($tempThumb.$fileThumb);

        // delete original files
        foreach($book as $v){
            File::delete($tempFolder.$v->filename);
            File::delete($tempThumb.$v->thumb);
        }

        //split zip pdf
        $partZip = MultipartCompress::zip($tempFolder.$fileName,$tempFolder.$fileName2,$s);
        //delete original zip
        File::delete($tempFolder.$fileName);
        $books = [
            'book' => $book,
            'pdf' => $partZip,
            'thumb' => $partZips
        ];
        $ex = new Export;
        $ex->type = "buku";
        $ex->sch_id = $id;
        $ex->save();

        return response()->json($books);

    }

    public function video(School $school)
    {
        //get data
        $id = $school->id;
        $path = public_path("storage/video/");
        $thumbpath = public_path("storage/thumb/video/");
        $tempFolder = $path."tmp/$id/";
        $tempThumb = $thumbpath."tmp/$id/";

        if (!is_dir($tempFolder)) {
            mkdir($tempFolder);
        }
        if (!is_dir($tempThumb)) {
            mkdir($tempThumb);
        }
        //clear path
        $file = new Filesystem;
        $file->cleanDirectory($tempFolder);
        $fil = new Filesystem;
        $fil->cleanDirectory($tempThumb);

        //declare file name
        $fileName = 'video-'.$id.".zip";
        $fileName2 = 'part-'.$id.".zip";
        $fileThumb = 'thumbvideo-'.$id.".zip";
        $fileThumb2 = 'part-'.$id.".zip";

        $video = Video::latest()
                ->with('education','grades','majors','subjects')
                ->whereHas('schools', function ($query) use ($id) {
                    $query->where('id', $id);
                })->get();
        
        //copy file to temp
        foreach($video as $b){
            copy($path.$b->filename.".".$b->filetype,$tempFolder.$b->filename.".".$b->filetype);
            copy($thumbpath.$b->thumb,$tempThumb.$b->thumb);
        };

        //zip all pdf file
        $zip = new ZipArchive;
        if ($zip->open($tempFolder.$fileName, ZipArchive::CREATE) === TRUE)
        {
            $files = File::files($tempFolder);
            foreach ($files as $key => $value) {
                $relativeNameInZipFile = basename($value);
                $zip->addFile($value, $relativeNameInZipFile);
            }
            $zip->close();
        }
        //zip thumbnail
        $zips = new ZipArchive;
        if ($zips->open($tempThumb.$fileThumb, ZipArchive::CREATE) === TRUE)
        {
            $files = File::files($tempThumb);
            foreach ($files as $key => $value) {
                $relativeNameInZipFile = basename($value);

                $zips->addFile($value, $relativeNameInZipFile);
            }
            
            $zips->close();
        }
        //split zip thumbnail
        $s = 150 * 1024 * 1024;
        $partZips = MultipartCompress::zip($tempThumb.$fileThumb,$tempThumb.$fileThumb2,$s);
        //delete original thumbnail zip
        File::delete($tempThumb.$fileThumb);

        // delete original files
        foreach($video as $v){
            File::delete($tempFolder.$v->filename.".".$v->filetype);
            File::delete($tempThumb.$v->thumb);
        }
        //split zip pdf
        $partZip = MultipartCompress::zip($tempFolder.$fileName,$tempFolder.$fileName2,$s);
        //delete original zip
        File::delete($tempFolder.$fileName);

        $videos = [
            'video' => $video,
            'mp4' => $partZip,
            'thumb' => $partZips
        ];
        $ex = new Export;
        $ex->type = "video";
        $ex->sch_id = $id;
        $ex->save();

        return response()->json($videos);
    }

    public function syncBook(School $school)
    {
        $import = request('date');
        $id = $school->id;

        $book = Book::latest()
                ->with('education','grades','majors','subjects')
                ->whereHas('schools', function ($query) use ($id,$import) {
                    $query->where('id', $id)
                    ->whereDate('book_school.updated_at','>',$import);
                })->get();
        if (!$book->isEmpty()) {
            //get data
            $path = public_path("storage/pdf/");
            $thumbpath = public_path("storage/thumb/pdf/");
            $tempFolder = $path."tmp/$id/";
            $tempThumb = $thumbpath."tmp/$id/";
    
            if (!is_dir($tempFolder)) {
                mkdir($tempFolder);
            }
            if (!is_dir($tempThumb)) {
                mkdir($tempThumb);
            }
            //clear path
            $file = new Filesystem;
            $file->cleanDirectory($tempFolder);
            $fil = new Filesystem;
            $fil->cleanDirectory($tempThumb);
            
            //copy file to temp
            foreach($book as $b){
                copy($path.$b->filename,$tempFolder.$b->filename);
                copy($thumbpath.$b->thumb,$tempThumb.$b->thumb);
            };
            return redirect('/sync/book/'.$id.'/zip?date='.$import);
        } else{
            $rs = [
                'behave' => FALSE,
                'message' => "Nothing to synchronize"
            ];
            return response()->json($rs);
        }
    }
    public function syncBookzip(School $school)
    {
        set_time_limit(0);
        $import = request('date');
        $id = $school->id;
        $path = public_path("storage/video/");
        $thumbpath = public_path("storage/thumb/video/");
        $tempFolder = $path."tmp/$id/";
        $tempThumb = $thumbpath."tmp/$id/";

        //declare file name
        $fileName = 'video-'.$id.".zip";
        $fileThumb = 'thumbvideo-'.$id.".zip";
        
        //zip all pdf file
        $zip = new ZipArchive;
        if ($zip->open($tempFolder.$fileName, ZipArchive::CREATE) === TRUE)
        {
            $files = File::files($tempFolder);
            
            foreach ($files as $key => $value) {
                $relativeNameInZipFile = basename($value);
                $zip->addFile($value, $relativeNameInZipFile);
            }
            $zip->close();
        }
        //zip thumbnail
        $zips = new ZipArchive;
        if ($zips->open($tempThumb.$fileThumb, ZipArchive::CREATE) === TRUE)
        {
            $files = File::files($tempThumb);
            foreach ($files as $key => $value) {
                $relativeNameInZipFile = basename($value);

                $zips->addFile($value, $relativeNameInZipFile);
            }
            
            $zips->close();
        }
        
        return redirect('/sync/book/'.$id.'/part?date='.$import);
    }
    public function syncBookpart(School $school)
    {
        set_time_limit(0);
        $import = request('date');
        $id = $school->id;
        $path = public_path("storage/video/");
        $thumbpath = public_path("storage/thumb/video/");
        $tempFolder = $path."tmp/$id/";
        $tempThumb = $thumbpath."tmp/$id/";

        //declare file name
        $fileName = 'video-'.$id.".zip";
        $fileName2 = 'part-'.$id.".zip";
        $fileThumb = 'thumbvideo-'.$id.".zip";
        $fileThumb2 = 'part-'.$id.".zip";

        $book = Book::latest()
                ->with('education','grades','majors','subjects')
                ->whereHas('schools', function ($query) use ($id,$import) {
                    $query->where('id', $id)
                    ->whereDate('book_school.updated_at','>',$import);
                })->get();
        //split zip thumbnail
        $s = 50 * 1024 * 1024;
        $partZips = MultipartCompress::zip($tempThumb.$fileThumb,$tempThumb.$fileThumb2,$s);
        //delete original thumbnail zip
        File::delete($tempThumb.$fileThumb);

        // delete original files
        foreach($book as $v){
            File::delete($tempFolder.$v->filename);
            File::delete($tempThumb.$v->thumb);
        }
        //split zip pdf
        $partZip = MultipartCompress::zip($tempFolder.$fileName,$tempFolder.$fileName2,$s);
        //delete original zip
        File::delete($tempFolder.$fileName);
        
        $ex = Export::where('type','=','buku')
                ->where('sch_id','=',$id)
                ->latest()->first();
        $ex->touch();

        $rs = [
            'behave' => TRUE,
            'book' => $book,
            'pdf' => $partZip,
            'thumb' => $partZips
        ];

        return response()->json($rs);
    }

    public function syncVideo(School $school)
    {
        $import = request('date');
        $id = $school->id;
        $video = Video::latest()
                ->with('education','grades','majors','subjects')
                ->whereHas('schools', function ($query) use ($id,$import) {
                    $query->where('id', $id)
                    ->whereDate('school_video.updated_at','>',$import);
                })->get();
        if (!$video->isEmpty()) {
            //get data
            
            $path = public_path("storage/video/");
            $thumbpath = public_path("storage/thumb/video/");
            $tempFolder = $path."tmp/$id/";
            $tempThumb = $thumbpath."tmp/$id/";

            if (!is_dir($tempFolder)) {
                mkdir($tempFolder);
            }
            if (!is_dir($tempThumb)) {
                mkdir($tempThumb);
            }
            //clear path
            $file = new Filesystem;
            $file->cleanDirectory($tempFolder);
            $fil = new Filesystem;
            $fil->cleanDirectory($tempThumb);

            //copy file to temp
            foreach($video as $b){
                copy($path.$b->filename.".".$b->filetype,$tempFolder.$b->filename.".".$b->filetype);
                copy($thumbpath.$b->thumb,$tempThumb.$b->thumb);
            };
            return redirect('/sync/video/'.$id.'/zip?date='.$import);
        }else{
            $rs = [
                'behave' => FALSE,
                'message' => "Nothing to synchronize"
            ];
            return response()->json($rs);
        }
    }
    public function syncVideozip(School $school)
    {
        set_time_limit(0);
        $import = request('date');
        $id = $school->id;
        //get data
        $path = public_path("storage/video/");
        $thumbpath = public_path("storage/thumb/video/");
        $tempFolder = $path."tmp/$id/";
        $tempThumb = $thumbpath."tmp/$id/";

        //declare file name
        $fileName = 'video-'.$id.".zip";
        $fileThumb = 'thumbvideo-'.$id.".zip";
        //zip all pdf file
        $zip = new ZipArchive;
        if ($zip->open($tempFolder.$fileName, ZipArchive::CREATE) === TRUE)
        {
            $files = File::files($tempFolder);
            foreach ($files as $key => $value) {
                $relativeNameInZipFile = basename($value);
                $zip->addFile($value, $relativeNameInZipFile);
            }
            $zip->close();
        }
        //zip thumbnail
        $zips = new ZipArchive;
        if ($zips->open($tempThumb.$fileThumb, ZipArchive::CREATE) === TRUE)
        {
            $files = File::files($tempThumb);
            foreach ($files as $key => $value) {
                $relativeNameInZipFile = basename($value);

                $zips->addFile($value, $relativeNameInZipFile);
            }
            
            $zips->close();
        }
        
        return redirect('/sync/video/'.$id.'/part?date='.$import);
    }
    public function syncVideopart(School $school)
    {
        set_time_limit(0);
        $id = $school->id;
        $import = request('date');
        $video = Video::latest()
                ->with('education','grades','majors','subjects')
                ->whereHas('schools', function ($query) use ($id,$import) {
                    $query->where('id', $id)
                    ->whereDate('school_video.updated_at','>',$import);
                })->get();

        //get data
        $path = public_path("storage/video/");
        $thumbpath = public_path("storage/thumb/video/");
        $tempFolder = $path."tmp/$id/";
        $tempThumb = $thumbpath."tmp/$id/";

        //declare file name
        $fileName = 'video-'.$id.".zip";
        $fileName2 = 'part-'.$id.".zip";
        $fileThumb = 'thumbvideo-'.$id.".zip";
        $fileThumb2 = 'part-'.$id.".zip";

        //split zip thumbnail
        $s = 50 * 1024 * 1024;
        $partZips = MultipartCompress::zip($tempThumb.$fileThumb,$tempThumb.$fileThumb2,$s);
        //delete original thumbnail zip
        File::delete($tempThumb.$fileThumb);

        // delete original files
        foreach($video as $v){
            File::delete($tempFolder.$v->filename.".".$v->filetype);
            File::delete($tempThumb.$v->thumb);
        }
        //split zip pdf
        $partZip = MultipartCompress::zip($tempFolder.$fileName,$tempFolder.$fileName2,$s);
        //delete original zip
        File::delete($tempFolder.$fileName);

        $rs = [
            'behave' => TRUE,
            'message' => "Synchronized successfully",
            'video' => $video,
            'mp4' => $partZip,
            'thumb' => $partZips
        ];
        $ex = Export::where('type','=','video')
            ->where('sch_id','=',$id)
            ->latest()->first();
        $ex->touch();
        return response()->json($rs);
    }

    public function sbook(School $school, Request $request)
    {
        set_time_limit(0);
        //get data
        $import = request('date');
        $json = request('json');
        
        $id = $school->id;
        $book = Book::latest()
                ->with('education','grades','majors','subjects','getSize')
                ->whereHas('schools', function ($query) use ($id,$import) {
                    $query->where('id', $id)
                    ->whereDate('school_video.updated_at','>',$import);
                })
                ->whereNotIn('filename', $json)
                ->get();
        $books = $book->concat();
        if (!$book->isEmpty()) {
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
    public function syncFile(School $school)
    {
        set_time_limit(0);
        //declare var
        $id = $school->id;
        $type = request('type');
        $size = request('size');
        $name = str_replace(".$type","",request('name')); // don't have dot
        $cur = request('cur');
        $tot = request('tot');
        //declare file name
        $fileName = "$name-".$id.".zip";
        $fileName2 = "part-$name-".$id.".zip";
        //specify file type & path
        if ($type == "pdf") {
            // file pdf
            $type = $type;
            $tipe = "buku";
            $name = $name.$type;
            $path = storage_path("app/public/$type/");
            $temp = storage_path("app/public/$type/tmp/$id");
        }elseif($type == "video"){
            // file video
            $type = $type;
            $tipe = "mp4";
            $name = $name.$tipe;
            $path = storage_path("app/public/$type/");
            $temp = storage_path("app/public/$type/tmp/$id");
        }elseif($type == "thumbvid"){
            // thumb video
            $type = "video";
            $tipe = "jpg";
            $name = $name.$tipe;
            $path = storage_path("app/public/thumb/$type/");
            $temp = storage_path("app/public/thumb/$type/tmp/$id");
        }else{
            // thumb pdf
            $type = "pdf";
            $tipe = "jpg";
            $name = $name.$tipe;
            $path = storage_path("app/public/thumb/$type/");
            $temp = storage_path("app/public/thumb/$type/tmp/$id");
        }

        if ($size > 157286400) {
            // Multipart
            //copy file to temp
            $old = "$path/$name";
            $new = "$temp/$name";
            $zipFile = "$temp/$fileName";
            $zipPartFile = "$temp/$fileName2";
            copy($old,$new);
            //zip all pdf file
            $zip = new ZipArchive;
            if ($zip->open($zipFile, ZipArchive::CREATE) === TRUE)
            {
                $files = File::files($temp);
                foreach ($files as $key => $value) {
                    $relativeNameInZipFile = basename($value);
                    $zip->addFile($value, $relativeNameInZipFile);
                }
                $zip->close();
            }
            //split zip file
            $s = 50 * 1024 * 1024;
            $partZip = MultipartCompress::zip($zipFile,$temp,$zipPartFile,$s);
            // delete original file & zip
            File::delete($new);
            File::delete($zipFile);
            $videos = [
                request('type') => $partZip,
            ];
        }else{
            $videos = [
                request('type') => request('name')
            ];
        }
        
        return response()->json($videos);
    }
}
