<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Http\Request;

class SupervisorsController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:supervisors');
    }
    public function index()
    {
        $admins = Admin::where('id', '<>', auth()->id())->latest()->paginate(10);
        return view('admin.supervisors.index', compact('admins'));
    }
    public function add()
    {
        $roles = Role::where('id', '>', 2)->get();
        return view('admin.supervisors.add', compact('roles'));
    }
    public function save(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'password' => bcrypt($request->password),
        ];
        $admin = Admin::create($data);
        return redirect()->back()->with('msg', 'تمت الإضافة بنجاح');
    }
    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        $roles = Role::where('id', '>', 1)->get();
        return view('admin.supervisors.edit', compact('admin', 'roles'));
    }
    public function update(Request $request)
    {
        $admin = Admin::findOrFail($request->admin_id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->role_id = $request->role_id;
        if($request->pasword && $request->password != '')
            $admin->password = bcrypt($request->password);
        $admin->save();
        return redirect()->back()->with('msg', 'تم التعديل بنجاح');
    }
    public function delete(Request $request)
    {
        $admin = Admin::findOrFail($request->admin_id);
        $admin->delete();
        return redirect()->back()->with('msg', 'تم الحذف بنجاح');
    }
}
