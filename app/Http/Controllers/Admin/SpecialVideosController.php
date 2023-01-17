<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Special_video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SpecialVideosController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:special_videos');
    }
    public function index() {
        $videos = Special_video::latest()->paginate(10);
        return view('admin.special_videos.index', compact('videos'));
    }
    public function save(Request $request) {
        $request->validate([
            'video' => 'required|max:8000',
            'video_type' => 'required'
        ]);
        $video = "";
        if ($request->hasFile('video')) {
            $v = $request->file('video');
            $filename = $v->getClientOriginalName();
            $newName = uniqid() . '-' . now()->timestamp . $filename;
            $v->move('special_videos/', $newName);

            $video = new Special_video();
            $video->video = $newName;
            $video->video_type = $request->video_type;
            $video->save();
        }
        return redirect()->back()->with('msg', 'تم إضافة الفيديو بنجاح');   ;
    }
    public function delete(Request $request) {
        $video = Special_video::find($request->video_id);
        if(File::exists('special_videos/' . $video->video)) {
            File::delete('special_videos/' . $video->video);
        }
        $video->delete();
        return redirect()->back()->with('msg', 'تم حذف الفيديو بنجاح');
    }
}
