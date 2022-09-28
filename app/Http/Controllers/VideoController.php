<?php

namespace App\Http\Controllers;

use stdClass;
use App\Grade;
use App\Major;
use App\Video;
use App\School;
use App\History;
use App\Subject;
use App\TempVid;
use App\Education;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Exports\TempVid as ExportsTempVid;
use App\Imports\TempVid as ImportsTempVid;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('video.index');
    }

    public function data()
    {
        $rel = ['education','grades'];
        $id = [
            'id' => Auth::user()->school_id
        ];
        $role = Auth::user()->role;
        if ($role < 1) {
            $model = Video::with($rel)
            ->orderBy('created_at','desc');
        }else{
            $model = Video::with($rel)
            ->whereHas('schools',function($query) use ($id){
                $query->where($id);
            })
            ->orderBy('created_at','desc');
        }

        return DataTables::of($model)
                ->addIndexColumn()
                ->setRowId('id')
                ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $edu = Education::all();
        $maj = Major::all();
        $sub = Subject::all();
        $kls = Grade::all();

        return view('video.add',compact('edu','maj','sub','kls'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenjang' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'mapel' => 'required',
            'judul' => 'required',
            'deskripsi' => '',
            'nama_pembuat' => 'required|unique:videos,creator',
            'jam' => 'required|numeric|max:2',
            'menit' => 'required|numeric|max:59',
            'detik' => 'required|numeric|max:59',
            // 'thumb' => 'required|mimes:png,jpeg'
        ]);
        // $file = $request->file('thumb');
        
        $res = new stdClass;
        $filename = Str::slug($request->judul." ".$request->nama_pembuat,'-');
        $vid = new Video;
        $vid->title = $request->judul;
        $vid->desc = $request->deskripsi;
        $vid->filename = $filename;
        $vid->filetype = 'mp4';
        $vid->clicked_time = 0;
        $vid->edu_id = $request->jenjang;
        $vid->grade_id= $request->kelas;
        $vid->major_id= $request->jurusan;
        $vid->sub_id= $request->mapel;
        $vid->creator = $request->nama_pembuat;
        $vid->frame = "$request->jam:$request->menit:$request->detik";
        // $vid->thumb = "$filename.".$file->getClientOriginalExtension();
        
        if ($vid->save()) {
            $res->stats = 'success';
            $res->message = 'Save data success';

            return redirect('admin/video/' . $vid->id . '/upload');
        }else {
            $res->stats = 'failed';
            $res->message = 'Failed to save data';

            return redirect('admin/video')->with($res->stats, json_encode($res));
        }
    }
    public function upload(Video $video)
    {
        return view('video.upload', compact('video'));
    }

    public function uploadFile(Request $request,Video $video)
    {
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));
        
        if (!$receiver->isUploaded()) {

            // file not uploaded

            throw new UploadMissingFileException();

        }

        $fileReceived = $receiver->receive(); // receive file

        // return json_encode($fileReceived);

        if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded

            $file = $fileReceived->getFile(); // get file

            $extension = $file->getClientOriginalExtension();

            $fileName = $video->filename.".".$extension; // a unique file name
            
            $path = "public/video/";

            $disk = Storage::disk(config('filesystems.default'));

            $disk->putFileAs($path,$file,$fileName);

            unlink($file->getPathname());
            

            $video->thumb = $video->filename.".jpg";
            $video->filetype = $extension;

            $video->save();

            return [
                'path' => Storage::url($path.$fileName),
                'filename' => $fileName,
            ];

        }
        // otherwise return percentage information
        $handler = $fileReceived->handler();
        return [

            'done' => $handler->getPercentageDone(),

            'status' => true

        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */

    public function show(Video $video)
    {
        $video->with('education','grades')->get();
        return view('video.showvideo',compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */

    public function edit(Video $video)
    {
        $edu = Education::all();
        $maj = Major::all();

        $time = $video->frame;
        if($time == null) $time = '0:00:00';
        $tArr = explode(':',$time);
        $tObj = new stdClass;
        $tObj->jam = $tArr[0];
        $tObj->menit = $tArr[1];
        $tObj->detik = $tArr[2];

        $video->with('education','grades')->get();
        return view('video.edit',compact('edu','maj','video','tObj'));
    }
    public function editFile(Video $video)
    {
        return view('video.update',compact('video'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Video $video)
    {
        $request->validate([
            'jenjang' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'mapel' => 'required',
            'judul' => 'required',
            'deskripsi' => '',
            'nama_pembuat' => 'required|unique:videos,creator',
            'jam' => 'required|numeric|max:2',
            'menit' => 'required|numeric|max:59',
            'detik' => 'required|numeric|max:59'
        ]);
        $res = new stdClass;
        $time = $video->created_at;
        $title = $request->judul;
        $creator = $request->nama_pembuat;

        $of = $video->frame;
        $nef = "$request->jam:$request->menit:$request->detik";
        if($of == null) $of = '0:00:00';
        $tArr = explode(':',$of);
        $tObj = new stdClass;
        
        $tObj->jam = $tArr[0];

        $tObj->menit = $tArr[1];
        
        $tObj->detik = $tArr[2];
        
        $filename = Str::slug($request->judul." ".$request->nama_pembuat,'-');

        $op = 'public/video/'."$video->filename.$video->filetype";
        $np = 'public/video/'."$filename.$video->filetype";
        $opthumb = 'public/thumb/video/'.$video->thumb;
        $npthumb = 'public/thumb/video/'."$filename.jpg";
        if (($title != $video->title) || ($creator != $video->creator)) {
            $video->filename = $filename;
            $video->thumb = $filename.".jpg";
            Storage::move($opthumb,$npthumb);
            Storage::move($op,$np);
        }
        $video->title = $request->judul;
        $video->desc = $request->deskripsi;
        $video->edu_id = $request->jenjang;
        $video->grade_id= $request->kelas;
        $video->major_id= $request->jurusan;
        $video->sub_id= $request->mapel;
        $video->creator = $request->nama_pembuat;
        $video->frame = $nef;
        $video->save();

        $res->stats = 'Berhasil';

        $res->message = 'Berhasil mengedit video info';

        if ($tObj->jam != $request->jam || $tObj->menit != $request->menit || $tObj->detik != $request->detik) {
            return redirect("/admin/video/$video->id/thumb");
        }else{
            return redirect('/admin/video')->with($res->stats, json_encode($res));
        };
    }

    public function updateFile(Request $request, Video $video)
    {
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));
        
        if (!$receiver->isUploaded()) {

            // file not uploaded

            throw new UploadMissingFileException();

        }

        $fileReceived = $receiver->receive(); // receive file

        if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded

            $file = $fileReceived->getFile(); // get file

            $extension = $file->getClientOriginalExtension();

            $fileName = "$video->filename.$extension"; // a unique file name
            $path = "public/video/";
            

            $disk = Storage::disk(config('filesystems.default'));

            $disk->putFileAs($path,$file,$fileName);

            unlink($file->getPathname());
            
            
            $video->thumb = $video->filename.".jpg";
            $video->filetype = $extension;

            $video->save();

            return [
                'path' => Storage::url($path.$fileName),
                'filename' => $fileName
            ];

        }
        // otherwise return percentage information
        $handler = $fileReceived->handler();
        return [
            'done' => $handler->getPercentageDone(),

            'status' => true
        ];
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        $res = new stdClass;
        $ex = file_exists(storage_path('app/public/video/')."$video->filename.$video->filetype");
        $et = file_exists(storage_path('app/public/thumb/video/').$video->thumb);
        if ($ex) {
            Storage::delete('public/video/'."$video->filename.$video->filetype");
            History::where('file_id','=',$video->id)->where('type','=','mp4')->delete();
        }
        if ($et) {
            Storage::delete('public/thumb/video/'.$video->thumb);
        }

        $video->delete();

        $status = 'success';
        $title = 'Berhasil';
        $msg = 'Hapus video berhasil.';

        $res->status = $status;
        $res->title = $title;
        $res->message = $msg;
        return response()->json($res);
    }

    /**
     * Generate Thumbnail with ffmpeg
     * @param  \App\Video  $video
     * @return \Illuminate\Http\RedirectResponse
     * 
     */

    public function thumb(Video $video)
    {
        $res = new stdClass;
        $req = "/admin/video";
        $url = url()->previous();
        $lastUrl = explode('/',$url);
        $key = sizeof($lastUrl);
        $last = $lastUrl[$key-1];
        try {
            $frame = $video->frame;
            $filename = "$video->filename.$video->filetype";
            $path = storage_path('app/public/video/'.$filename);
            $path2 = storage_path('app/public/thumb/video/'.$video->thumb);
            $res->message= '';
            if ($last == 'upload') {
                $ffmpeg = "ffmpeg -ss $frame -i '$path' -q:v 4 -frames:v 1 -s 192x108 '$path2'";
                $res->message= 'Upload video berhasil, generate thumbnail sukses';
            }else{
                $ffmpeg = "ffmpeg -ss $frame -i '$path' -q:v 4 -frames:v 1 -s 192x108 '$path2' -y";
                $res->message= 'Edit video berhasil, generate thumbnail sukses';
                
            }
            $exec = shell_exec($ffmpeg);
            
            $res->status = 'success';
            $res->title = 'Berhasil';
            return redirect($req)->with($res->status,json_encode($res));
        } catch (\Throwable $th) {
            $res->status = 'error';
            $res->title = 'Gagal';
            $res->message= $th;
            return redirect($req)->with($res->status,json_encode($res));
        }
    }

    public function dataTemp()
    {
        $model = TempVid::orderBy('created_at','desc');
        return DataTables::of($model)
                ->addIndexColumn()
                ->setRowId('id')
                ->toJson();
    }

    public function mass(Request $request)
    {
        
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));
        
        if (!$receiver->isUploaded()) {

            // file not uploaded

            throw new UploadMissingFileException();

        }

        $fileReceived = $receiver->receive(); // receive file

        if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded

            $file = $fileReceived->getFile(); // get file

            $extension = $file->getClientOriginalExtension();

            
            $vid = new TempVid;
            $fileName = $file->getClientOriginalName(); // a unique file name
            
            $path = "public/temp/video/";

            $disk = Storage::disk(config('filesystems.default'));

            $disk->putFileAs($path,$file,$fileName);

            unlink($file->getPathname());
            
            $vid->nama_file = str_replace('.mp4','',$file->getClientOriginalName());
            $vid->tipe_file = $extension;

            $vid->save();

            $temp = public_path("storage/temp/video/");
            return [
                'path' => $temp,
                'filename' => $fileName,
                'id' => $vid->id
            ];

        }
        // otherwise return percentage information
        $handler = $fileReceived->handler();
        return [

            'done' => $handler->getPercentageDone(),

            'status' => true

        ];
    }

    public function import()
    {
        return view('video.import');
    }

    public function excel()
    {
        return view('video.excel');
    }

    public function downloadExcel()
    {
        return (new ExportsTempVid)->download('videolist.xlsx');
    }

    public function delTemp(TempVid $video)
    {
        $thumbname = "$video->nama_file.jpg";
        $path = storage_path("app/public/temp/video/");
        $path1 = $path."$video->nama_file.$video->tipe_file"; // pdf path
        $path2 = $path.$thumbname; // image path

        if (file_exists($path1)) unset($path1);
        if (file_exists($path2)) unset($path2);

        $video->delete();

        $res = new stdClass;
        $res->status = 'success';
        $res->title = 'Berhasil';
        $res->message = "Hapus file $video->nama_file berhasil";

        return response()->json($res);
    }

    public function saveExcel(Request $request)
    {
        $res = new stdClass;
        $request->validate([
            'xcl' => 'required|mimes:xls,xlsx'
        ]);
        try {
            TempVid::truncate();
            $file = $request->file('xcl');

            $imp = (new ImportsTempVid);

            \Log::channel('proc')->info("Uploaded video excel output :");
            \Log::channel('proc')->info($imp->toArray($file));
            $imp->import($file);
            return redirect()->route('video.generate');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            
            foreach ($failures as $key => $val) {
                $val->row(); // row that went wrong
                $val->attribute(); // either heading key (if using heading row concern) or column index
                $val->errors(); // Actual error messages from Laravel validator
                $val->values(); // The values of the row that has failed.
                
                $res->message[$key] = $val->errors();
            }
            $res->status = 'error';

            return redirect()->back()->with($res->status, json_encode($res));
        }
    }
    public function generate()
    {
        set_time_limit(0);
        $res = new stdClass;
        $temp = TempVid::all();
        $totrow = TempVid::count();
        $save = 0;

        foreach ($temp as $key => $vid) {
            
            $filename = Str::slug($vid->judul." ".$vid->nama_pembuat,'-');
            
            $video = new Video;
            $video->filename = $filename;
            $video->filetype = $vid->tipe_file;
            
            $op = 'public/temp/video/'."$vid->nama_file.$vid->tipe_file";
            $np = 'public/video/'."$filename.$video->filetype";
            $path = storage_path('app/'.$op);
            $newpath = storage_path("app/$np");
            $thumb = "$filename.jpg";
            $npthumb = 'public/thumb/video/'.$thumb;
            $path2 = storage_path('app/'.$npthumb);

            // echo "$key $path<br>";
            if (file_exists($path)) {
                // echo $path."<br>";
                // clear existing same files
                if (file_exists($path2)) {
                    unlink($path2);
                    // Storage::delete($npthumb);
                }
                if (file_exists($newpath)) {
                    unlink($newpath);
                    // Storage::delete($np);
                }
                //generate thumbnail
                $ffmpeg = "ffmpeg -ss $vid->thumbnail -i '$path' -q:v 4 -frames:v 1 -s 192x108 '$path2'";
                $exec = shell_exec($ffmpeg);
                // $fh = fopen(storage_path("logs/ffmpeg-$key.log"),'w');
                // fwrite($fh,$exec);
                // fclose($fh);
                \Log::channel('generate')->info($exec);
                rename($path,$newpath);
                // Storage::move($op,$np);
                $video->thumb = $thumb;
            }
            $edu = Education::where('edu_name','=',$vid->jenjang)->first();
            $grade = Grade::where('grade_name','=',$vid->kelas)->first();
            $sub = Subject::where('sbj_name','=',$vid->mapel)->first();
            
            if (empty($edu)) {
                $ed = null;
                $mjr = null;
            }else{
                $ed = $edu->id;
                $mjr = Major::where('maj_name','=',$vid->jurusan)
                        ->where('edu_id',$ed)
                        ->first();
            }
            if (empty($grade)) {
                $gr = null;
            }else{
                $gr = $grade->id;
            }
            if (empty($mjr)) {
                $mj = null;
            }else {
                $mj = $mjr->id;
            }
            if (empty($sub)) {
                $su = null;
            }else {
                $su = $sub->id;
            }

            $video->title = $vid->judul;
            $video->desc = $vid->deskripsi;
            $video->edu_id = $ed;
            $video->grade_id= $gr;
            $video->major_id= $mj;
            $video->sub_id= $su;
            $video->creator = $vid->nama_pembuat;
            $video->frame = $vid->thumbnail;
            $video->clicked_time = 0;

            if($video->save()){
            $save++;
            };
            // echo var_dump($video);
            // echo "<br>";
        }
        // echo "<br> $save <br>";
        if ($save == $totrow) {
            TempVid::truncate();
            
            $res->status = 'success';
            $res->title = 'Berhasil';
            $res->message = 'Video berhasil di import.';
            
            return redirect()->route('video.index')->with($res->status, json_encode($res));
        }else{
            $res->status = 'error';
            $res->title = 'Gagal';
            $res->message = 'Gagal import video. Row terakhir '.$save;
    
            return redirect()->route('video.excel')->with($res->status, json_encode($res));
        }
    }
}
