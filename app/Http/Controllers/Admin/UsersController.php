<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Country;
use App\Http\Controllers\Controller;
use App\Order;
use App\Transaction;
use App\User;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:users');
    }
    public function get_freelancers() {
        $users = User::where('type', 1)->latest()->paginate(10);
        if(\request()->status == 'approved') {
            $users = User::where('type', 1)->where('status', 1)->latest()->paginate(10);
            $users->withPath('/admin/freelancers?status=approved');
        }
        if(\request()->status == 'pending') {
            $users = User::where('type', 1)->where('status', 0)->latest()->paginate(10);
            $users->withPath('/admin/freelancers?status=pending');
        }
        if(\request()->status == 'rejected') {
            $users = User::where('type', 1)->where('status', -1)->latest()->paginate(10);
            $users->withPath('/admin/freelancers?status=rejected');
        }
        if(\request()->word && \request()->word != "") {
            $users = User::where('type', 1)
                ->where(function ($q) {
                    $q->where('name', 'like', '%' . \request()->word . '%')
                        ->orWhere('phone', 'like', '%' . \request()->word . '%');
                })
                ->latest()
                ->paginate(10);
        }
        return view('admin.users.freelancers', compact('users'));
    }
    public function add()
    {
        $categories = Category::latest()->get(['id', 'name']);
        $countries = Country::latest()->get(['id', 'name']);
        return view('admin.users.add')->with(['countries'=>$countries, 'categories'=>$categories]);
    }
    public function store(Request $request)
    {
        $data = $request->except('_token');
        $data['type'] = 1;
        $data['status'] = 1;
        $data['password'] = Hash::make($request->password);
        if($request->activated == 'on')
            $data['activated'] = 1;
        else
            $data['activated'] = 0;
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $image->getClientOriginalName();
            $newName = uniqid() . '-' . now()->timestamp . $filename;
            $image->move('images/users/', $newName);
            $data['image'] = $newName;
        }
        $user = User::create($data);
        return redirect()->route('admin.users.freelancers')->with('msg', 'تمت الإضافة بنجاح');
    }
    public function show($id) {
        $user = User::findOrFail($id);
        $orders = [];
        $total_sales = 0;
        $profit = 0;
        $done_orders_mount = 0;
        if($user->type == 1) {
            $orders = Order::where('target_id', $user->id)
                ->where('image', '!=', null)
                ->latest()
                ->get();
            $total_sales = 0;
            foreach ($orders as $order) {
                if($order->status == 1) {
                    $total_sales += $order->mount;
                    $profit += $order->mount * ($order->commission / 100);
                }
            }
            $done_orders = $orders->where('done', 1);
            foreach ($done_orders as $d) {
                if($d->status == 1)
                    $done_orders_mount += $d->mount;
            }
        }
        return view('admin.users.show', compact(['user', 'orders', 'done_orders_mount', 'total_sales', 'profit']));
    }
    public function show_user($id) {
        $user = User::findOrFail($id);
        $orders = Order::with('freelancer')->where('user_id', $id)->latest()->get();
        return view('admin.users.show_user', compact(['user', 'orders']));
    }
    public function edit($id) {
        $user = User::findOrFail($id);
        $countries = Country::all();
        $categories = Category::all();
        return view('admin.users.edit', compact(["user", "countries", "categories"]));
    }
    public function update(Request $request) {
        $data = [
            "name" => $request->name,
            "phone" => $request->phone,
            "country_id" => $request->country_id,
            "category_id" => $request->category_id,
            "followers" => $request->followers,
            "price_ad" => $request->price_ad,
            "price_gift" => $request->price_gift,
            "commission" => $request->commission,
        ];
        if($request->status && $request->status != '')
            $data['status'] = $request->status;


        if ($request->hasFile('video')) {
            $v = $request->file('video');
            $filename = $v->getClientOriginalName();
            $newName = uniqid() . '-' . now()->timestamp . $filename;
            $v->move('video/', $newName);

            $video = new Video();
            $video->user_id = $request->user_id;
            $video->video = $newName;
            $video->save();
        }


        $user = User::find($request->user_id)->update($data);
        return redirect()->back()->with('msg', 'تم التعديل نجاح');
    }
    public function delete(Request $request) {
        $user = User::find($request->user_id);
        $user->delete();
        return redirect()->back()->with('msg', 'تم الحذف بنجاح');
    }
    public function get_users() {
        $users = User::where('type', 0)->latest()->paginate(10);
        if(\request()->word && \request()->word != "") {
            $users = User::where('type', 0)
                ->where('name', 'like', '%' . \request()->word . '%')
                ->latest()
                ->paginate(10);
        }
        return view('admin.users.users', compact('users'));
    }
    public function delete_video($id)
    {
        $video = Video::findOrFail($id);
        if(File::exists('video/' . $video->video)) {
            File::delete('video/' . $video->video);
        }
        $video->delete();
        return redirect()->back()->with('msg', 'تم الحذف بنجاح');
    }
    public function delete_main_video($id)
    {
        $user = User::findOrFail($id);
        if(File::exists('video/' . $user->video)) {
            File::delete('video/' . $user->video);
        }
        $user->video = null;
        $user->save();
        return redirect()->back()->with('msg', 'تم الحذف بنجاح');
    }
    public function toggleActivation(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        if($user->activated == 1)
            $user->activated = 0;
        else
            $user->activated = 1;
        $user->save();
        return redirect()->back()->with('msg', 'تم التعديل بنجاح');
    }
    public function send(Request $request)
    {
        $orders = Order::where('target_id', $request->user_id)->update(["done" => 1]);
        if($request->mount > 0) {
            Transaction::create([
                'user_id' => $request->user_id,
                'mount' => $request->mount,
                'notes' => $request->notes ?? null
            ]);
        }
        return redirect()->back()->with('msg', 'تم تسليم الأرباح بنجاح');
    }
    public function send_money_page()
    {

        $users = User::where('type', 1)->get();
        $orders = [];
        foreach ($users as $user) {
            $all_orders = Order::where('target_id', $user->id)
                ->where('status', 1)
                ->where('done', 0)
                ->where('image', '!=', null)
                ->get();
            if($all_orders && $all_orders->count() > 0) {
                $mount = 0;
                foreach ($all_orders as $order) {
                    $mount += $order->mount;
                }
                $orders[] = [
                    "user" => $user,
                    "mount" => $mount
                ];
            }
        }
        return view('admin.users.send_money_page', compact('orders'));
    }
}
