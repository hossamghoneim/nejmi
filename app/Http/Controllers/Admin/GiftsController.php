<?php

namespace App\Http\Controllers\Admin;

use App\Gift;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GiftsController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:gifts');
    }
    public function index() {
        $gifts = Gift::latest()->paginate(10);
        return view('admin.gifts.index', compact('gifts'));
    }
    public function add() {
        return view('admin.gifts.add');
    }
    public function save(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'name_fr' => 'required'
        ]);
        $gift = Gift::create($data);
        return redirect()->back()->with('msg', 'تم إضافة الإهداء بنجاح');
    }
    public function edit($id) {
        $gift = Gift::findOrFail($id);
        return view('admin.gifts.edit', compact('gift'));
    }
    public function update(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'name_fr' => 'required'
        ]);
        $gift = Gift::findOrFail($request->gift_id);
        $gift->update($data);
        return redirect()->back()->with('msg', 'تم التعديل بنجاح');
    }
    public function delete(Request $request) {
        $gift = Gift::findOrFail($request->gift_id);
        $gift->delete();
        return redirect()->back()->with('msg', 'تم الحذف بنجاح');
    }
}
