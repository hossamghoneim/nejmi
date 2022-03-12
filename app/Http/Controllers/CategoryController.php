<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($id) {
        $category = Category::with('users')->find($id);
        if(!$category) return 0;
        return response()->json($category);
    }
}
