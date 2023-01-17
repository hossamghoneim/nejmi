<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:roles');
    }
    public function index()
    {
        $roles = Role::where('id', '>', 2)->latest()->paginate(10);
        return view('admin.roles.index', compact('roles'));
    }
    public function add()
    {
        return view('admin.roles.add');
    }
    public function save(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'permissions' => 'required|array|min:1'
        ]);
        $role = Role::create([
            'name' => $request->name,
            'permissions' => json_encode($request->permissions)
        ]);
        return redirect()->back()->with('msg', 'تمت الإضافة بنجاح');
    }
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('admin.roles.edit', compact('role'));
    }
    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'permissions' => 'required|array|min:1'
        ]);
        $role = Role::findOrFail($request->role_id);
        $role->name =  $request->name;
        $role->permissions =  json_encode($request->permissions);
        $role->save();
        return redirect()->back()->with('msg', 'تم التعديل بنجاح');
    }
    public function delete(Request $request)
    {
        $role = Role::findOrFail($request->role_id);
        $role->delete();
        return redirect()->back()->with('msg', 'تم الحذف بنجاح');
    }
}
