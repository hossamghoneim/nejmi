<?php

namespace App\Http\Controllers\Admin;

use App\Ad;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:ads');
    }
    public function index() {
        $ads = Ad::first();
        return view('admin.ads.index', compact('ads'));
    }
    public function save(Request $request) {
        $ads = Ad::first();
        $data = $request->except('_token');
        if($ads) {
            $ads->update($data);
        } else {
            $ads->create($data);
        }
        return redirect()->back()->with('msg', 'تم الحفظ بنجاح');
    }
}
