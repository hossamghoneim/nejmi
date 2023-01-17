<?php

namespace App\Http\Controllers\Admin;

use App\AffiliateOrder;
use App\Http\Controllers\Controller;
use App\Order;
use App\Setting;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:reports');
    }
    public function index() {

        // Sales
//        $sales_count = Order::where('status', 1);
//        $orders = Order::where('status', 1);

        $sales_count = null;
        $orders = [];

        if(\request()->time) {
            $sales_count = Order::where('status', 1)
                ->whereDate('created_at', '>', Carbon::now()->subDays(\request()->time))->count();
            $orders = Order::where('status', 1)
                ->whereDate('created_at', '>', Carbon::now()->subDays(\request()->time))->get();
        } else {
            $sales_count = Order::where('status', 1)->count();
            $orders = Order::where('status', 1)->get();
        }

        $sales = 0;
        $profit = 0;
        $final_profit = 0;
        foreach ($orders as $order) {
            $sales += $order->mount;
            $profit += $order->mount * $order->commission / 100;
            $affiliate = AffiliateOrder::where('order_id', $order->id)->get();
            if($affiliate->count() > 0) {
                foreach ($affiliate as $aff) {
                    $final_profit += $order->mount * $order->commission / 100 - ($order->mount * $order->commission / 100 * $aff->commission / 100);
                }
            } else {
                $final_profit += $order->mount * $order->commission / 100;
            }
        }

        return view('admin.reports.index', compact([
            'orders',
            'sales_count',
            'sales',
            'profit',
            'final_profit'
        ]));
    }
}
