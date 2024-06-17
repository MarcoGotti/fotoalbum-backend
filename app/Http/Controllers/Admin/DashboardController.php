<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Photo;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $owner_data = User::all();
        $photos = Photo::all();
        $categories = Category::all();

        return view('dashboard', compact('photos', 'owner_data', 'categories'));
    }
}
