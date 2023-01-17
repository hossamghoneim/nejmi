<?php

namespace App\Http\Controllers\Admin;

use App\Activation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActivationController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:activations');
    }

    public function index()
    {
        $activations = Activation::latest()->paginate(10);
        return view('admin.activations.index', compact('activations'));
    }
    public function show($id)
    {
        $activation = Activation::findOrFail($id);
        return view('admin.activations.show', compact('activation'));
    }
    public function change_status(Request $request)
    {
        $activation = Activation::findOrFail($request->act_id);
        if($request->status && $request->status != '')
            $activation->update(["status" => $request->status]);
        return redirect()->back()->with('msg', 'تم التعديل بنجاح');
    }
    public function delete(Request $request)
    {
        $activation = Activation::findOrFail($request->act_id);
        $activation->delete();
        return redirect()->back()->with('msg', 'تم الحذف بنجاح');
    }
}
