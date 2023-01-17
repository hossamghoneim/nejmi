<?php

namespace App\Http\Controllers;

use App\Alert;
use Illuminate\Http\Request;

class AlertController extends Controller
{
    public function index()
    {
        $alerts = Alert::where('user_id', auth()->id())->latest()->get();
        return response()->json($alerts, 200);
    }
    public function add(Request $request)
    {
        $data = [
            'event' => $request->data['event'],
            'date' => $request->data['date'],
            'user_id' => auth()->id()
        ];
        $alert = Alert::create($data);
        return response()->json($alert, 200);
    }
    public function delete(Request $request)
    {
        $alert = Alert::findOrFail($request->id);
        $alert->delete();
        return response()->json(1, 200);
    }
}
