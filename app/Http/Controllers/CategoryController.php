<?php

namespace App\Http\Controllers;

use App\Category;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index($id) {
        $category = Category::find($id);
        if(!$category) return 0;
        $users = User::where('category_id', $id)->with('country','category')->where('status', 1)->take(48)->get();
        return response()->json(["category" => $category, "users" => $users]);
    }
    public function best() {
        $users = User::where('status', 1)->where('type', 1)
            ->orderBy(
                Order::select('target_id')
                    ->whereColumn('target_id', 'users.id')
                    ->limit(1)
            )
            ->get();
        $category["name"] = "الأكثر طلباً";
        return response()->json(["category" => $category, "users" => $users]);
    }
    public function latest() {
        $users = User::where('status', 1)->where('type', 1)->latest()->get();
        $category["name"] = "الأحدث";
        return response()->json([
            "users" => $users,
            "category" => $category
        ]);
    }
}
