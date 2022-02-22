<?php

namespace App\Http\Controllers;

use FFI;
use App\Major;
use App\Video;
use App\Subject;
use App\Education;
use FFMpeg\FFMpeg;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Psr\Log\LoggerInterface;
use FFMpeg\Coordinate\TimeCode;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;
use stdClass;

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
        return view('video.index',compact('edu','maj','sub'));
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
        return view('video.add',compact('edu','maj','sub'));
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
        if ($file != null) {
            $filename = Str::slug($request->judul." ".$request->nama_pembuat." ".now('Asia/Jakarta'),'-');
            $file->storeAs(public_path('assets/images/thumbs/'),$filename);
        
            $vid = new Video;
            $vid->title = $request->judul;
            $vid->desc = $request->deskripsi;
            $vid->filename = $filename;
            $vid->clicked_time = 0;
            $vid->edu_id = $request->jenjang;
            $vid->grade_id= $request->kelas;
            $vid->major_id= $request->jurusan;
            $vid->sub_id= $request->mapel;
            $vid->creator = $request->nama_pembuat;
            $vid->thumb = $filename.$file->getClientOriginalExtension();
            if ($vid->save()) {
                $stats = 'success';
                
                $msg = 'Save data success';

                return redirect('admin/video/' . $vid->id . '/upload');
            }else {
                $stats = 'failed';

                $msg = 'Failed to save data';

                return redirect('admin/video')->with($stats, $msg);
            }   
        } else {
            
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
                'url' => "/admin/video/".$video->id."/thumb",
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

    public function thumb(Request $request, Video $video)
    {
        // $dir1 = "C:\\FFmpeg\\bin\\ffmpeg.exe";
        // $dir2 = "C:\\FFmpeg\\bin\\ffprobe.exe";
        // $cfg = [
        //     'ffmpeg.binaries' => $dir1,
        //     'ffprobe.binaries' => $dir2,
        //     'timeout' => 3600
        // ];
        // $stamp = $request->stamp ?? 1;
        // $res = new stdClass;
        // $path = storage_path('public/video/'.$video->filename);
        // $name = preg_replace('/\\.[^.\\s]{3,4}$/', '', $video->filename);
        // $thumb = public_path("/assets/video/thumb/".$name);
        // $mpg = FFMpeg::create($cfg);
        // $frame = TimeCode::fromSeconds($stamp);
        // $video = $mpg->open($path);

        // $video->frame($frame)->save($thumb);
        
        // return redirect(route('video.index'))->with('success',json_encode($res));
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        //
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
        //
    }

    public function updateFile()
    {
        
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        //
    }
}
