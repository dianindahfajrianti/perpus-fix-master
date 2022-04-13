<?php

namespace App\Http\Controllers;

use stdClass;
use App\Major;
use App\Video;
use App\School;
use ZipArchive;
use App\Subject;
use App\Education;
use App\Grade;
use MultipartCompress;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
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
        $edu = Education::all();
        $maj = Major::all();
        $sub = Subject::all();
        $kls = Grade::all();

        return view('video.index',compact('edu','maj','sub','kls'));
    }

    public function data()
    {
        $rel = ['getEdu','getGrade'];
        $model = Video::with($rel)
                 ->orderBy('updated_at','desc');
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
            'mapel' => '',
            'judul' => 'required',
            'deskripsi' => '',
            'nama_pembuat' => 'required',
            'thumb' => 'required|mimes:png,jpeg'
        ]);
        $file = $request->file('thumb');
        $ext = ".".$file->getClientOriginalExtension();
        $res = new stdClass;

        if ($file != null) {
            $filename = Str::slug($request->judul." ".$request->nama_pembuat." ".date('Y-m-d'),'-');
            $file->storeAs('public/thumb/video',$filename.$ext);
        
            $imgman = new ImageManager(['driver'=> 'imagick']);
            $img = $imgman->make(storage_path('app/public/thumb/video/').$filename.$ext)->resize(385,216)->save();
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
            $vid->thumb = $filename.$ext;
            if ($vid->save()) {
                $res->stats = 'success';
                $res->message = 'Save data success';

                return redirect('admin/video/' . $vid->id . '/upload');
            }else {
                $res->stats = 'failed';
                $res->message = 'Failed to save data';

                return redirect('admin/video')->with($res->stats, json_encode($res));
            }   
        } else {
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
            $name = $video->filename;
            $path = "public/video/";
            $path2 = storage_path($path.$fileName);

            $disk = Storage::disk(config('filesystems.default'));

            $disk->putFileAs($path,$file,$fileName);

            unlink($file->getPathname());

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
     * Display the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */

    public function show(Video $video)
    {
        $video->with('getEdu','getGrade')->get();
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
        $sub = Subject::all();

        $video->with('getEdu','getGrade')->get();
        return view('video.edit',compact('edu','maj','sub','video'));
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
            'mapel' => '',
            'judul' => 'required',
            'deskripsi' => '',
            'nama_pembuat' => 'required'
        ]);
        $res = new stdClass;
        $time = $video->created_at;
        $title = $request->judul;
        $creator = $request->nama_pembuat;
        $file = $request->file('thumbnail');
        
        $filename = Str::slug($request->judul." ".$request->nama_pembuat." ".$time,'-');

        if ($file != null) {
            $ext = ".".$file->getClientOriginalExtension();
            $sv = $file->storeAs('public/thumb/video/', $filename.$ext);
            
            if ($sv) {
                $video->title = $request->judul;
                $video->desc = $request->deskripsi;
                $video->filename = $filename;
                $video->edu_id = $request->jenjang;
                $video->grade_id= $request->kelas;
                $video->major_id= $request->jurusan;
                $video->sub_id= $request->mapel;
                $video->creator = $request->nama_pembuat;
                $video->thumb = $filename.$ext;
                $video->save();
                $imgman = new ImageManager(['driver'=> 'imagick']);
                $img = $imgman->make(storage_path('app/public/thumb/video/').$filename.$ext)->resize(385,216)->save();

                $res->stats = 'success';
                $res->message = 'Berhasil mengedit video info';

                return redirect('admin/video/')->with($res->stats, json_encode($res));
            }else {

                $res->stats = 'error';
                $res->message = 'Gagal mengedit video info';
                return redirect('admin/video')->with($res->stats, json_encode($res));
            }
        } else {
            
            $op = 'public/video/'."$video->filename.$video->filetype";
            $np = 'public/video/'."$filename.$video->filetype";
            $opthumb = 'public/thumb/video/'.$video->thumb;
            $npthumb = 'public/thumb/video/'."$filename.png";
            if (($title != $video->title) || ($creator != $video->creator)) {
                $video->filename = $filename;
                $video->thumb = $filename.".png";
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
            $video->save();
            $res->stats = 'Berhasil';

            $res->message = 'Berhasil mengedit video info';

            return redirect('admin/video')->with($res->stats, json_encode($res));
        }
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
        $del = Storage::delete('public/video/'."$video->filename.$video->filetype");
        if ($del) {
            Storage::delete('public/thumb/video/'.$video->thumb);
            
            $video->delete();
            $status = 'success';
            $title = 'Berhasil';
            $msg = 'Hapus video berhasil.';
        }else{
            $status = 'error';
            $title = 'Gagal';
            $msg = 'Hapus video gagal.';
        }
        $res->status = $status;
        $res->title = $title;
        $res->message = $msg;
        return response()->json($res);
    }

}
