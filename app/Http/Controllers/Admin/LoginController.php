<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function getLogin() {
        return view('admin.login');
    }
    public function login(Request $request) {
        // Make Validation
        $messages = [
            'email.required' => 'البريد الالكتروني مطلوب',
            'email.email' => 'أدخل عنوان بريد الكتروني صالح',
            'password.required' => 'كلمة المرور مطلوبة'
        ];
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ],$messages);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        // Make Login
        if(auth()->guard('admin')->attempt(['email'=>$request->input('email'),'password'=>$request->input('password')])) {
            return redirect()->route('admin.dashboard');
        }else {
            return redirect()->back()->with(['error' => 'هناك خطأ في البيانات'])->withInput($request->all());
        }
    }

    public function profile()
    {
        $admin = Admin::find(1);
        return view('admin.profile.index')->with('admin',$admin);
    }

    public function profileUpdate(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        $admin = Admin::find(1);
        $admin->name = $data['name'];
        $admin->email = $data['email'];
        if($request->password && $request->password != '')
            $admin->password = Hash::make($data['password']);
        $admin->save();
        return redirect()->back()->with('msg','تم التعديل بنجاح');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('get.admin.login');
    }
}
