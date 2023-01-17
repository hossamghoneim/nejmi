<?php

namespace App\Http\Controllers\Admin;

use App\Coupon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CouponsController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:coupons');
    }
    public function index() {
        $coupons = Coupon::latest()->paginate(10);
        if(\request()->word) {
            $coupons = Coupon::where('coupon', 'like', '%' . \request()->word . '%')
                ->latest()
                ->paginate(10);
        }
        return view('admin.coupons.index', compact('coupons'));
    }
    public function add() {
        return view('admin.coupons.add');
    }
    public function save(Request $request) {
        $data = [
            "coupon" => $request->coupon,
            "discount" => $request->discount,
            "expire_date" => $request->expire_date ? $request->expire_date : ''
        ];
        $c = Coupon::create($data);
        return redirect()->back()->with('msg', 'تمت الإضافة بنجاح');
    }
    public function edit($id) {
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupons.edit', compact('coupon'));
    }
    public function update(Request $request) {
        $data = [
            "coupon" => $request->coupon,
            "discount" => $request->discount,
            "expire_date" => $request->expire_date ? $request->expire_date : ''
        ];
        $coupon = Coupon::find($request->coupon_id);
        $coupon->update($data);
        return redirect()->back()->with('msg', 'تم الحفظ بنجاح');
    }
    public function delete(Request $request) {
        $coupon = Coupon::find($request->coupon_id);
        $coupon->delete();
        return redirect()->back()->with('msg', 'تم الحذف بنجاح');
    }
}
