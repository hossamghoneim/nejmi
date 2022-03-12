<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;

class VideosController extends Controller
{
    public function index() {
        $user = auth()->user();
        if(!$user) return 0;
        $videos = $user->videos;
        return response()->json($videos);
    }
    public function add(Request $request) {
        $video = "";
        if ($request->hasFile('video')) {
            $v = $request->file('video');
            $filename = $v->getClientOriginalName();
            $newName = uniqid() . '-' . now()->timestamp . $filename;
            $v->move('videos/', $newName);

            $video = new Video();
            $video->user_id = auth()->id();
            $video->video = $newName;
            $video->save();
        }
        return response()->json($video);
    }
}
