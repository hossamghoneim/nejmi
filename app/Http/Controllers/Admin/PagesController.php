<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:pages');
    }
    public function index() {
        $pages = Page::latest()->paginate(10);
        return view('admin.pages.index', compact('pages'));
    }
    public function add() {
        return view('admin.pages.add');
    }
    public function save(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'name_fr' => 'required',
            'body' => 'required',
            'body_fr' => 'required',
            'slug' => 'required|unique:pages,slug',
        ]);
        $data['slug'] = Str::slug($request->slug, '-');
        $page = Page::create($data);
        return redirect()->back()->with('msg', 'تمت الإضافة بنجاح');
    }
    public function edit($id) {
        $page = Page::findOrFail($id);
        return view('admin.pages.edit', compact('page'));
    }
    public function update(Request $request) {
        $page = Page::findOrFail($request->page_id);
        $data = $request->validate([
            'name' => 'required',
            'name_fr' => 'required',
            'body' => 'required',
            'body_fr' => 'required',
        ]);
        $page->update($data);
        return redirect()->back()->with('msg', 'تم التعديل بنجاح');
    }
    public function delete(Request $request) {
        $page = Page::findOrFail($request->page_id);
        $page->delete();
        return redirect()->back()->with('msg', 'تم الحذف بنجاح');
    }
}
