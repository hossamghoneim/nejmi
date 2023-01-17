<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Affiliate;
use App\AffiliateOrder;
use App\AffiliateRelation;
use App\AffiliateTransaction;
use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AffiliateController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:affiliates');
    }
    public function index()
    {
        $affiliates = Affiliate::with('freelancers')->orderBy('id', 'desc')->paginate(10);
        return view('admin.affiliates.index', compact('affiliates'));
    }
    public function show($id)
    {
        $affiliate = Affiliate::with(['orders', 'freelancers'])->findOrFail($id);
        $total_sales = 0;
        $done_orders_mount = 0;
        $affiliate_orders = [];

        foreach ($affiliate->orders as $order) {
            $main_order = Order::with('freelancer')->find($order->order_id);
            $affiliate_orders[] = ["main_order" => $main_order, "comm" => $order->commission];
            if($main_order && $main_order->status ==  1 && $main_order->done ==  1) {
                $total_sales += ($main_order->mount * ($main_order->commission / 100)) * ($order->commission / 100);
            }
            if($order->done == 1 && $main_order && $main_order->status == 1) {
                $done_orders_mount += ($main_order->mount * ($main_order->commission / 100)) * ($order->commission / 100);
            }
        }

        $whatsappMessage = "تقرير أرباح الوسيط " . $affiliate->name . " ";
        $whatsappMessage .= "الأرباح الكلية " . $total_sales . "MRU ";
        $whatsappMessage .= "الأرباح المستلمة " . $done_orders_mount . "MRU ";
        $whatsappMessage .= "الأرباح المعلقة " . ($total_sales - $done_orders_mount) . "MRU ";

        return view('admin.affiliates.show', compact('affiliate', 'total_sales', 'affiliate_orders', 'done_orders_mount', 'whatsappMessage'));
    }
    public function add()
    {
        $affiliates = AffiliateRelation::get('target_id');
        foreach ($affiliates as $affiliate)
        {
            $aff[] = $affiliate->target_id;
        }
        $all_freelancers = User::where('type', 1)->where('status', 1)->get(['id', 'name']);
        $freelancers = [];
        foreach ($all_freelancers as $freelancer)
        {
            if(!in_array($freelancer->id, $aff))
                $freelancers[] = $freelancer;
        }
        return view('admin.affiliates.add', compact('freelancers'));
    }
    public function save(Request $request)
    {
        $affiliate_data = $request->only(['user_id', 'name', 'phone', 'email', 'commission']);

        $affiliate = Affiliate::create($affiliate_data);

        $admin = Admin::Create([
            "name" => $affiliate_data["name"],
            "email" => $affiliate_data["email"],
            "password" => Hash::make($request->password),
            "role_id" => 2,
        ]);

        if($request->freelancers && count($request->freelancers) > 0)
        {
            foreach ($request->freelancers as $aff) {
                $affiliate_rel = AffiliateRelation::create([
                    'affiliate_id' => $affiliate->id,
                    'target_id' => $aff
                ]);
            }
        }

        return redirect()->back()->with('msg', 'تمت الإضافة بنجاح');
    }
    public function edit($id)
    {
        $affiliate = Affiliate::with('freelancers')->findOrFail($id);
        $freelancers = User::where('type', 1)->get(['id', 'name']);
        $my_freelancers_ids = AffiliateRelation::where('affiliate_id', $id)->get('target_id');
        $my_freelancers = [];
        foreach ($my_freelancers_ids as $i) {
            $my_freelancers[] = $i->target_id;
        }
        return view('admin.affiliates.edit', compact('affiliate', 'freelancers', 'my_freelancers'));
    }
    public function update(Request $request)
    {

        $affiliate = Affiliate::with('freelancers')->findOrFail($request->aff_id);

        $affiliate_data = $request->only(['user_id', 'name', 'phone', 'email', 'commission']);
        $affiliate->update($affiliate_data);

        if($request->freelancers && count($request->freelancers) > 0) {
            foreach ($affiliate->freelancers as $f) {
                $f->delete();
            }
            foreach ($request->freelancers as $aff) {
                $affiliate_rel = AffiliateRelation::create([
                    'affiliate_id' => $affiliate->id,
                    'target_id' => $aff
                ]);
            }
        }

        return redirect()->back()->with('msg', 'تم التعديل بنجاح');
    }
    public function delete(Request $request)
    {
        $affiliate = Affiliate::findOrFail($request->aff_id);
        $affiliate_rel = AffiliateRelation::where('affiliate_id', $request->aff_id)->delete();
        $affiliate->delete();
        return redirect()->back()->with('msg', 'تم الحذف بنجاح');
    }

    public function send(Request $request)
    {
        $affiliates = AffiliateOrder::where('affiliate_id', $request->affiliate_id)->update(["done" => 1]);
        if($request->mount > 0) {
            AffiliateTransaction::create([
                'affiliate_id' => $request->affiliate_id,
                'mount' => $request->mount,
                'notes' => $request->notes ?? null
            ]);
        }
        return redirect()->back()->with('msg', 'تم تسليم الأرباح بنجاح');
    }
}
