<?php

namespace App\Http\Controllers;

use App\Affiliate;
use App\AffiliateOrder;
use App\AffiliateRelation;
use App\Coupon;
use App\Order;
use App\Setting;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class OrdersController extends Controller
{
    public function create_temp_order(Request $request)
    {
        $data = [
            'user_id' => auth()->check() ? auth()->id() : null,
            'target_id' => $request->target_id,
            'message' => $request->message,
            'order_type' => $request->order_type,
            'phone' => $request->phone,
            'mount' => $request->mount,
            'gift_type' => $request->gift_type,
            'gift_from' => $request->from,
            'gift_to' => $request->to,
            'commission' => User::find($request->target_id)->commission ?? Setting::first()->commission
        ];
        $order = Order::updateOrCreate($data);
        return response()->json($order->id, 200);
    }
    public function create(Request $request) {
        $order = Order::findOrFail($request->order_id);
        $data = [
            'image' => $request->image,
        ];
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $image->getClientOriginalName();
            $newName = uniqid() . '-' . now()->timestamp . $filename;
            $image->move('images/orders/', $newName);
            $data['image'] = $newName;
        }
        $order->image = $data['image'];
        $order->save();

        $aff = AffiliateRelation::where('target_id', $request->target_id)->first();

        if($aff) {
            $aff_order = AffiliateOrder::create([
                'affiliate_id' => $aff->affiliate_id,
                'order_id' => $order->id,
                'target_id' => $request->target_id,
                'commission' => Affiliate::find($aff->affiliate_id)->commission
            ]);
        }


        if($request->has('coupon') && $request->has('coupon') != null) {
            $coupon = Coupon::whereCoupon($request->coupon)->first();
            if($coupon) $coupon->increment('used_times');
        }

        return response()->json(1,200);
    }
    public function checkCoupon($c) {
        $coupon = Coupon::where('coupon', $c)->first();
        if(!$coupon) return 0;

        if($coupon->expire_date) {
            $today = time();
            $expire_date = strtotime($coupon->expire_date);

            $datediff = $expire_date - $today;

            if(round($datediff / (60 * 60 * 24)) <= 0) return 0;
        }

        return response()->json($coupon);
    }
    public function get_user_orders() {
        if(auth()->user()->type == 0) {
            $orders = Order::with('freelancer')
                ->where('user_id', auth()->id())
                ->where('image', '!=', null)
                ->latest()
                ->get();
            return response()->json($orders);
        } else {
            $orders = Order::with('user')
                ->where('target_id', auth()->id())
                ->where('status', 1)
                ->where('image', '!=', null)
                ->latest()
                ->get();

            $total_sales = 0;
            $done_orders_mount = 0;

            foreach ($orders as $order) {
                if($order->status == 1)
                    $total_sales += $order->mount - ($order->mount * $order->commission / 100);
            }

            $done_orders = $orders->where('done', 1);
            foreach ($done_orders as $d) {
                if($d->status == 1)
                    $done_orders_mount += $d->mount - ($d->mount * $d->commission / 100);
            }

            return response()->json([
                "orders" => $orders,
                "total_sales" => $total_sales,
                "done_orders_mount" => $done_orders_mount
            ]);
        }
    }
    public function toggleOrderStatus(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        $order->update(["status" => $request->status]);
        return response()->json(["id" => $request->order_id, "status" => $request->status], 200);
    }
}
