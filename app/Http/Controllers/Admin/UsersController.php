<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Country;
use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
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
        return view('admin.users.freelancers', compact('users'));
    }
    public function show($id) {
        $user = User::findOrFail($id);
        $orders = [];
        $total_sales = "";
        $done_orders_mount = 0;
        if($user->type == 1) {
            $orders = Order::where('target_id', $user->id)->latest()->get();
            $total_sales = 0;
            foreach ($orders as $order) {
                $total_sales += $order->mount;
            }
            $done_orders = $orders->where('done', 1);
            foreach ($done_orders as $d) {
                $done_orders_mount += $d->mount;
            }
        }
        return view('admin.users.show', compact(['user', 'orders', 'done_orders_mount', 'total_sales']));
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
            "price" => $request->price,
            "status" => $request->status,
        ];
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
        return view('admin.users.users', compact('users'));
    }
}
