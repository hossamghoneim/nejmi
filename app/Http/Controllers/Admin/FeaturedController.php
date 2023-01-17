<?php

namespace App\Http\Controllers\Admin;

use App\FeaturedUser;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class FeaturedController extends Controller
{
    public function index()
    {
        $users = FeaturedUser::latest()->paginate(10);
        return view('admin.featured_users.index', compact('users'));
    }
    public function add()
    {
        $users = User::where('status', 1)->where('type', 1)->get(['id', 'name']);
        return view('admin.featured_users.add', compact('users'));
    }
    public function save(Request $request)
    {
        $featured = FeaturedUser::create([
            'user_id' => $request->user_id
        ]);
        return redirect()->back()->with('msg', 'تمت الإضافة بنجاح');
    }
    public function delete(Request $request)
    {
        $featured = FeaturedUser::findOrFail($request->user_id);
        $featured->delete();
        return redirect()->back()->with('msg', 'تم الحذف بنجاح');
    }
}
