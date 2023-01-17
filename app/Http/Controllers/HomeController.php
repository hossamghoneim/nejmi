<?php

namespace App\Http\Controllers;

use App\FeaturedUser;
use App\Special_video;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('index');
    }
    public function get_latest() {
        $users = User::where('type', 1)
            ->where('status', 1)
            ->latest()
            ->with(['category','country'])
            ->take(9)
            ->get();
        foreach ($users as $user) {
            if(Cache::has('user-is-online-' . $user->id))
                $user->is_online = true;
            else
                $user->is_online = false;
        }
        return response()->json($users);
    }
    public function get_featured()
    {
        $featured = FeaturedUser::latest()->take(9)->get();
        $users = [];
        foreach ($featured as $f)
        {
            $users[] = User::where('id', $f->user_id)->with(['category','country'])->first();
        }
        foreach ($users as $user) {
            if(Cache::has('user-is-online-' . $user->id))
                $user->is_online = true;
            else
                $user->is_online = false;
        }
        return response()->json($users);
    }
    public function get_special_videos() {
        $videos = Special_video::latest()->take(6)->get();
        return response()->json($videos, 200);
    }
    public function get_views()
    {
        $session = session()->all();
        $keys = array_keys($session);
        $data = [];
        foreach ($keys as $key) {
            if(substr($key, 0, 5) == 'views')
                $data[] = session()->get($key);
        }
        return $data;
    }
    public function get_user_logs()
    {
        $logs = Transaction::where('user_id', auth()->id())->latest()->get();
        return response()->json($logs, 200);
    }
}
