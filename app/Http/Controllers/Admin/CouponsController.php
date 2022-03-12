<?php

namespace App\Http\Controllers\Admin;

use App\Coupon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CouponsController extends Controller
{
    public function index() {
        $coupons = Coupon::latest()->paginate(10);
        return view('admin.coupons.index', compact('coupons'));
    }
    public function add() {
        return view('admin.coupons.add');
    }
    public function save(Request $request) {
        $data = [
            "coupon" => $request->coupon,
            "discount" => $request->discount
        ];
        $c = Coupon::create($data);
        return redirect()->back()->with('msg', 'تمت الإضافة بنجاح');
    }
    public function delete(Request $request) {
        $coupon = Coupon::find($request->coupon_id);
        $coupon->delete();
        return redirect()->back()->with('msg', 'تم الحذف بنجاح');
    }
}
