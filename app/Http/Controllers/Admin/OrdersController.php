<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index() {
        $orders = Order::latest()->paginate(10);
        if(\request()->status == 'approved') {
            $orders = Order::where('status', 1)->latest()->paginate(10);
            $orders->withPath('/admin/orders?status=approved');
        }
        if(\request()->status == 'pending') {
            $orders = Order::where('status', 0)->latest()->paginate(10);
            $orders->withPath('/admin/orders?status=pending');
        }
        if(\request()->status == 'rejected') {
            $orders = Order::where('status', -1)->latest()->paginate(10);
            $orders->withPath('/admin/orders?status=rejected');
        }
        return view('admin.orders.index', compact('orders'));
    }
    public function show($id) {
        $order = Order::findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }
    public function change_status(Request $request) {
        $order = Order::find($request->order_id);
        $order->status = $request->status;
        $order->done = $request->done;
        $order->save();
        return redirect()->back()->with('msg', 'تم الحفظ بنجاح');
    }
    public function delete(Request $request) {
        $order = Order::find($request->order_id);
        $order->delete();
        return redirect()->back()->with('msg', 'تم الحذف بنجاح');
    }
}
