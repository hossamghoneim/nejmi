<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index($id) {
        $user = User::with(['category', 'videos'])->find($id);
        if(!$user || $user->type == 0) return 0;
        $related = User::where([
            ['category_id', $user->category_id],
            ['id', '!=', $id]
        ])->get();
        return response()->json(["user" => $user, "related" => $related]);
    }
    public function update(Request $request) {
        $user = User::find(auth()->id());
        if($request->data['name'])
            $user->name = $request->data['name'];
        if($request->data['followers'])
            $user->followers = $request->data['followers'];
        if($request->data['about'])
            $user->about = $request->data['about'];
        $user->save();
        return response()->json(1);
    }
    public function update_password(Request $request) {
        return User::find(auth()->id())->update([
            'password' => Hash::make($request->data['password'])
        ]);
    }
    public function get_target($id) {
        $user = User::find($id);
        if(!$user) return 0;
        return response()->json($user);
    }
}
