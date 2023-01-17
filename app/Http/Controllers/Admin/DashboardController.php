<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Affiliate;
use App\AffiliateOrder;
use App\Http\Controllers\Controller;
use App\Order;
use App\Setting;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {

        $freelancers_count = 0;
        $users_count = 0;
        $orders_count = 0;
        $orders = "";
        $sales_count = 0;
        $sales = 0;
        $profit = 0;
        $final_profit = 0;
        $affiliate = "";
        $total_sales = 0;
        $affiliate_orders = 0;
        $done_orders_mount = 0;


        if(auth()->user()->role_id == 2) {
            $affiliate = Affiliate::with(['orders', 'freelancers'])->where('email', auth()->user()->email)->first();
            $total_sales = 0;
            $done_orders_mount = 0;
            $affiliate_orders = [];

            foreach ($affiliate->orders as $order) {
                $main_order = Order::with('freelancer')->find($order->order_id);
                $affiliate_orders[] = ["main_order" => $main_order, "comm" => $order->commission];
                if($main_order && $main_order->status ==  1) {
                    $total_sales += ($main_order->mount * ($main_order->commission / 100)) * ($order->commission / 100);
                }
                if($order->done == 1 && $main_order && $main_order->status == 1) {
                    $done_orders_mount += ($main_order->mount * ($main_order->commission / 100)) * ($order->commission / 100);
                }
            }
        } else {
            $freelancers_count = User::where('type', 1)->where('status', 1)->count();
            $users_count = User::where('type', 0)->count();
            $orders_count = Order::where('status', 0)->count();
            $orders = Order::latest()->take(5)->get();

            // Sales
            $sales_count = Order::where('status', 1)->count();
            $orders = Order::where('status', 1)->get();

            $sales = 0;
            $profit = 0;
            $final_profit = 0;
            foreach ($orders as $order) {
                if($order->status == 1) {
                    $sales += $order->mount;
                    $profit += $order->mount * ($order->commission / 100);
                }
                $affiliate = AffiliateOrder::where('order_id', $order->id)->get();
                if($affiliate->count() > 0) {
                    foreach ($affiliate as $aff) {
                        $final_profit += $order->mount * $order->commission / 100 - ($order->mount * $order->commission / 100 * $aff->commission / 100);
                    }
                } else {
                    $final_profit += $order->mount * $order->commission / 100;
                }
            }
        }


        return view('admin.index', compact([
            'freelancers_count',
            'users_count',
            'orders_count',
            'orders',
            'sales_count',
            'sales',
            'profit',
            'final_profit',
            'affiliate',
            'total_sales',
            'affiliate_orders',
            'done_orders_mount',
        ]));
    }
}
