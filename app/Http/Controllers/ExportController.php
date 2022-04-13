<?php

namespace App\Http\Controllers;

use App\Book;
use App\User;
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

class ExportController extends Controller
{
    public function user(School $school)
    {
        $id = $school->id;
        $user = User::where('school_id',$id)->get()->makeVisible('password');
        $super = User::where('role',0)->get()->makeVisible(['password']);
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
            if ($eduname == 'SD') {
                $gr = Grade::where('grade_name','<','7')->get();
            }elseif ($eduname == 'SMP') {
                $gr = Grade::
                        where('grade_name','>=','7')
                        ->where('grade_name','<=','9')
                        ->get();
            }elseif ($eduname == 'SMA') {
                $gr = Grade::
                      where('grade_name','>=','10')
                      ->where('grade_name','<=','12')
                      ->get();
            }
            $maj = Major::where('maj_name','Umum')->get();
            $maj_id = DB::table('majors')->where('maj_name','Umum')->value('id');
            
            $sub = Subject::where('parent_id',$maj_id)->with('hasMajor')->get();
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
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function book(School $school)
    {
        //get data
        $id = $school->id;
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

        $book = Book::latest()
                ->with('getEdu','getGrade','getMajor','getSubject')
                ->whereHas('schools', function ($query) use ($id) {
                    $query->where('id', $id);
                })->get();
        
        //declare file name
        $fileName = 'pdf-'.$id.".zip";
        $fileName2 = 'part-'.$id.".zip";
        $fileThumb = 'pdf-'.$id.".zip";
        $fileThumb2 = 'part-'.$id.".zip";
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
        $s = 10 * 1024 * 1024;
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

        $video = Video::latest()
                ->with('getEdu','getGrade','getMajor','getSubject')
                ->whereHas('schools', function ($query) use ($id) {
                    $query->where('id', $id);
                })->get();
        //declare file name
        $fileName = 'video-'.$id.".zip";
        $fileName2 = 'part-'.$id.".zip";
        $fileThumb = 'thumbvideo-'.$id.".zip";
        $fileThumb2 = 'part-'.$id.".zip";
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
                ->with('getEdu','getGrade','getMajor','getSubject')
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
            
            //declare file name
            $fileName = 'pdf-'.$id.".zip";
            $fileName2 = 'part-'.$id.".zip";
            $fileThumb = 'pdf-'.$id.".zip";
            $fileThumb2 = 'part-'.$id.".zip";
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
            $rs = [
                'behave' => TRUE,
                'book' => $book,
                'pdf' => $partZip,
                'thumb' => $partZips
            ];
            $ex = Export::where('type','=','buku')
                    ->where('sch_id','=',$id)
                    ->latest()->first();
            $ex->touch();
        } else{
            $rs = [
                'behave' => FALSE,
                'message' => "Nothing to synchronize"
            ];
        }
        return response()->json($rs);
    }

    public function syncVideo(School $school)
    {
        $import = request('date');
        $id = $school->id;
        $video = Video::latest()
                ->with('getEdu','getGrade','getMajor','getSubject')
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

            //declare file name
            $fileName = 'video-'.$id.".zip";
            $fileName2 = 'part-'.$id.".zip";
            $fileThumb = 'thumbvideo-'.$id.".zip";
            $fileThumb2 = 'part-'.$id.".zip";
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
            $s = 10 * 1024 * 1024;
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
            
        }else{
            $rs = [
                'behave' => FALSE,
                'message' => "Nothing to synchronize"
            ];
        }
        return response()->json($rs);
        
    }
}
