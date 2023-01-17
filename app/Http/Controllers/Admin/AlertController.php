<?php

namespace App\Http\Controllers\Admin;

use App\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AlertController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:alerts');
    }
    public function index()
    {
        $alerts = Alert::latest()->paginate(10);
        if(\request()->sort == 'date')
            $alerts = Alert::orderBy('date', 'asc')->paginate(10);
        return view('admin.alerts.index', compact('alerts'));
    }
    public function delete(Request $request)
    {
        $alert = Alert::findOrFail($request->id);
        $alert->delete();
        return redirect()->back()->with('msg', 'تم الحذف بنجاح');
    }
    public function send($id)
    {
        $alert = Alert::findOrFail($id);
        $whatsappMessage = "تذكير: لديك حدث قريب في تاريخ%0a";
        $whatsappMessage .= $alert->date . " ";
        $whatsappMessage .= "الحدث:%0a";
        $whatsappMessage .= $alert->event;
        return redirect("https://wa.me/" . $alert->user->phone . "/?text=". $whatsappMessage);
    }
}
