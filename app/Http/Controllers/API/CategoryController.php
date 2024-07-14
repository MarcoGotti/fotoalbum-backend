<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return response()->json([
            'success' => true,
            'results' => $categories,
        ]);
    }

    public function show($id)
    {
        $category = Category::with('photos')->find($id);
        return response()->json([
            'success' => true,
            'results' => $category,
        ]);
    }
}
