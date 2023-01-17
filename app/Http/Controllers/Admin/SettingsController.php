<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:settings');
    }
    public function index() {
        $settings = Setting::first();
        return view('admin.settings.index', compact('settings'));
    }
    public function save(Request $request) {
        $settings = Setting::first();
        $data = $request->except('_token');
        if($settings) {
            if($request->hasFile('logo')) {
                if(File::exists('images/logo/' . $settings->logo))
                    File::delete('images/logo/' . $settings->logo);
                $logo = $request->file('logo');
                $filename = $logo->getClientOriginalName();
                $newName = uniqid() . '-' . now()->timestamp . $filename;
                $logo->move('images/logo/', $newName);
                $data['logo'] = $newName;
            }
            if($request->hasFile('donation_image')) {
                if(File::exists('images/donation_image/' . $settings->donation_image))
                    File::delete('images/donation_image/' . $settings->donation_image);
                $donation_image = $request->file('donation_image');
                $filename = $donation_image->getClientOriginalName();
                $newName = uniqid() . '-' . now()->timestamp . $filename;
                $donation_image->move('images/donation_image/', $newName);
                $data['donation_image'] = $newName;
            }
            $settings->update($data);
        } else {
            $settings->create($data);
        }
        return redirect()->back()->with('msg', 'تم الحفظ بنجاح');
    }
}
