<?php

namespace App\Http\Controllers;

use App\Activation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ActivationController extends Controller
{
    public function store(Request $request)
    {
        $data = [
            "image" => "",
            "image_type" => $request->image_type,
            "user_id" => auth()->id(),
            "status" => 2
        ];
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $image->getClientOriginalName();
            $newName = uniqid() . '-' . now()->timestamp . $filename;
            $image->move('images/activations/', $newName);
            $data['image'] = $newName;
        }

        $activation = Activation::create($data);

        return response()->json(1,200);
    }
    public function check() {
        if(auth()->user()->type == 0) {
            return response()->json(-2);
        }
        $approved = Activation::where('user_id', auth()->id())->where('status', 1)->get();
        $pending = Activation::where('user_id', auth()->id())->where('status', 2)->get();
        $rejected = Activation::where('user_id', auth()->id())->where('status', -1)->get();
        if($approved->count() > 0)
            return response()->json(1);
        elseif($pending->count() > 0)
            return response()->json(2);
        elseif($rejected->count() > 0)
            return response()->json(-1);
        else
        return response()->json(0);
    }
}
