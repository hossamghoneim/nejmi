<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:categories');
    }
    public function index() {
        $categories = Category::latest()->paginate(10);
        if(\request()->word) {
            $categories = Category::where('name', 'like', '%' . \request()->word . '%')
                ->latest()
                ->paginate(10);
        }
        return view('admin.categories.index', compact('categories'));
    }
    public function add() {
        return view('admin.categories.add');
    }
    public function save(Request $request) {
        $data = [
            "name" => $request->name,
            "name_fr" => $request->name_fr
        ];
        $category = Category::create($data);
        return redirect()->back()->with('msg', 'تمت الإضافة بنجاح');
    }
    public function edit($id) {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }
    public function update(Request $request) {
        $data = [
            "name" => $request->name,
            "name_fr" => $request->name_fr
        ];
        $category = Category::find($request->category_id);
        $category->update($data);
        return redirect()->back()->with('msg', 'تم الحفظ بنجاح');
    }
    public function delete(Request $request) {
        $category = Category::findOrFail($request->category_id);
        $category->delete();
        return redirect()->back()->with('msg', 'تم الحذف بنجاح');
    }
}
