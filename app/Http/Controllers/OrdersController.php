<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\Order;
use App\User;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function create(Request $request) {
        $data = [
            'user_id' => auth()->id(),
            'target_id' => $request->target_id,
            'message' => $request->message,
            'order_type' => $request->order_type,
            'phone' => $request->phone,
            'mount' => $request->mount,
            'image' => $request->image,
            'gift_type' => $request->gift_type,
            'gift_from' => $request->from,
            'gift_to' => $request->to,
        ];
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $image->getClientOriginalName();
            $newName = uniqid() . '-' . now()->timestamp . $filename;
            $image->move('images/orders/', $newName);
            $data['image'] = $newName;
        }
        $order = Order::updateOrCreate($data);
        return response()->json(1,200);
    }
    public function checkCoupon($c) {
        $coupon = Coupon::where('coupon', $c)->first();
        if(!$coupon) return 0;
        return response()->json($coupon);
    }
    public function get_user_orders() {
        $orders = Order::with('freelancer')->where('user_id', auth()->id())->latest()->get();
        return response()->json($orders);
    }
}
