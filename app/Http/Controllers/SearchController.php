<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index() {
        if(\request()->word) {
            $users = User::where('type', 1)
                ->where('status', 1)
                ->where('name', 'like', '%' . \request()->word . '%')
                ->get();
            return response()->json($users);
        } else return 0;
    }
}
