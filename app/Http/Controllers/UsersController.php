<?php

namespace App\Http\Controllers;

use App\ProfileView;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index($username) {
        $user = User::with(['category','country', 'videos'])->whereUsername($username)->first();
        if(!$user || $user->type == 0 || $user->status != 1) return 0;
        $related = User::where([
            ['category_id', $user->category_id],
            ['username', '!=', $username]
        ])->with(['category','country'])->take(15)->get();

        $videos = $user->videos;
        $sameCountry = User::where([
            ['country_id', $user->country_id],
            ['username', '!=', $username]
        ])->with(['category','country'])->take(15)->get();
        session()->put('views-' . $user->id, $user);

        return response()->json(["videos" => $videos ,"user" => $user, "related" => $related, 'sameCountry' => $sameCountry]);
    }
    public function update(Request $request) {
        $user = auth()->user();
        if($request->data['name'])
            $user->name = $request->data['name'];
        if($request->data['followers'])
            $user->followers = $request->data['followers'];
        if($request->data['about'])
            $user->about = $request->data['about'];
        if($request->data['phone'])
            $user->phone = $request->data['phone'];
        $user->save();
        return response()->json(1);
    }
    public function update_password(Request $request) {
        return auth()->user()->update([
            'password' => Hash::make($request->data['password'])
        ]);
    }
    public function update_image_video(Request $request) {
        $user = auth()->user();
        if($request->hasFile('image')) {
            if(File::exists('images/' . $user->image))
                File::delete('images/' . $user->image);
            $image = $request->file('image');
            $filename = $image->getClientOriginalName();
            $newName = uniqid() . '-' . now()->timestamp . $filename;
            $image->move('images/users/', $newName);
            $user->image = $newName;
        }
        if($request->hasFile('video')) {
            if(File::exists('video/' . $user->video))
                File::delete('video/' . $user->video);
            $video = $request->file('video');
            $filename = $video->getClientOriginalName();
            $newName = uniqid() . '-' . now()->timestamp . $filename;
            $video->move('video/', $newName);
            $user->video = $newName;
        }
        $user->save();
        return response()->json(1,200);
    }
    public function get_target($id, $type) {
        $user = User::with('category','country')->find($id);
        if(!$user) return 0;
        if($type == 'order' && $user->accept_orders == 0) return 0;
        if($type == 'gift' && $user->accept_gifts == 0) return 0;
        return response()->json($user, 200);
    }
    public function toggleAcceptOrders(Request $request) {
        $user = auth()->user();
        if($request->type == 'orders')
            $user->accept_orders = $request->accept_orders == "true" ? 1 : 0;
        if($request->type == 'gifts')
            $user->accept_gifts = $request->accept_gifts == "true" ? 1 : 0;
        $user->save();
        return response()->json("تم التعديل بنجاح", 200);
    }
}
