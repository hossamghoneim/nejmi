<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use App\Transaction;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:orders');
    }
    public function index() {
        $orders = Order::where('image', '!=', null)->latest()->paginate(10);
        if(\request()->status == 'approved') {
            $orders = Order::where('status', 1)->where('image', '!=', null)->latest()->paginate(10);
            $orders->withPath('/admin/orders?status=approved');
        }
        if(\request()->status == 'pending') {
            $orders = Order::where('status', 0)->where('image', '!=', null)->latest()->paginate(10);
            $orders->withPath('/admin/orders?status=pending');
        }
        if(\request()->status == 'rejected') {
            $orders = Order::where('status', -1)->where('image', '!=', null)->latest()->paginate(10);
            $orders->withPath('/admin/orders?status=rejected');
        }
        if(\request()->status == 'under_process') {
            $orders = Order::where('status', 1)->where('done', 0)->where('image', '!=', null)->latest()->paginate(10);
            $orders->withPath('/admin/orders?status=rejected');
        }
        if(\request()->order_id && \request()->order_id != '' && is_numeric(\request()->order_id)) {
            $orders = Order::where('id', \request()->order_id)
                ->where('image', '!=', null)
                ->get();
        }
        return view('admin.orders.index', compact('orders'));
    }
    public function show($id) {
        $order = Order::findOrFail($id);
        $sender = $order->user->name ?? "مستخدم";
        $whatsappMessage = "لديك طلب جديد من " . $sender . " ";

        if($order->order_type == 'gift') {
            $whatsappMessage .= "نوع الإهداء:" . $order->gift_type . " ";
            $whatsappMessage .= "من:" . $order->gift_from . " ";
            $whatsappMessage .= "إلى:" . $order->gift_to . " ";
            $whatsappMessage .= "الرسالة:" . $order->message . " ";
        } else if($order->order_type == 'ad') {
            $whatsappMessage .= "الرسالة" . $order->message;
        }
        if(!$order->image)
        {
            $whatsappMessage = "تذكير: لديك طلب غير مكتمل ";
            $whatsappMessage .= "رابط الطلب: ";
            $whatsappMessage .= "https://nejmy.app/order/" . $order->id;
        }
        return view('admin.orders.show', compact('order', 'whatsappMessage'));
    }
    public function change_status(Request $request) {
        $order = Order::find($request->order_id);
        if($request->status) $order->status = $request->status;
        if($request->done) {
            $order->done = $request->done;
            if($request->done == 1) {
                Transaction::create([
                    'user_id' => $request->user_id,
                    'order_id' => $request->order_id,
                    'mount' => $order->mount - ($order->mount * $order->commission / 100),
                    'notes' => $request->notes ?? null
                ]);
            }
        }
        $order->save();

        return redirect()->back()->with('msg', 'تم الحفظ بنجاح');
    }
    public function delete(Request $request) {
        $order = Order::find($request->order_id);
        $order->delete();
        return redirect()->back()->with('msg', 'تم الحذف بنجاح');
    }
    public function incomplete()
    {
        $orders = Order::where('image', null)->latest()->paginate(10);
        return view('admin.orders.incomplete', compact('orders'));
    }
}
