<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $freelancers_count = User::where('type', 1)->where('status', 1)->count();
        $users_count = User::where('type', 0)->count();
        $orders_count = Order::where('status', 0)->count();
        $orders = Order::latest()->take(5)->get();
        return view('admin.index', compact(['freelancers_count', 'users_count', 'orders_count', 'orders']));
    }
}
