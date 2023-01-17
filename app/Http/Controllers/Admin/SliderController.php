<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\slider;
class SliderController extends Controller
{

    public function index() {
        return view('admin.sliders.index')->with(["sliders" => slider::select('id','image','header','description','link','btn_text')->get()]);
    }
    public function sliders() {
        return response()->json(["sliders" => slider::select('image','header','description','link','btn_text')->get()]);
    }

    public function create() {
         return view('admin.sliders.add');
    }

    public function store(Request $request) {
        $request->validate([
            
            'header' => 'string|nullable|max:191',
            'link' => 'string|nullable|max:191',
            'description' => 'string|nullable',
            'btn_text' => 'string:max:191',
        ]);

        $file = $request->File('image');
        $filename = $file->getClientOriginalName();
        $newName = uniqid() . '-' . now()->timestamp . $filename;
        $file->move('images/sliders/',$newName);
        $newSlider = new slider($request->all());
        $newSlider->save();
        $newSlider->image = $newName;
        $newSlider->save();
        return back()->with('msg','تم الحفظ');
    }

    public function destroy(Request $request, $id) {

        $slider = slider::findOrFail($id);
        $slider->delete();
        return back()->with('msg','تم الحذف');
    }
}
