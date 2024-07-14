<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Photo;

class PhotoController extends Controller
{
    public function index()
    {
        $photos = Photo::with('categories')->orderByDesc('id')->paginate();
        return response()->json([
            'success' => true,
            'results' => $photos,
        ]);
    }

    public function show($id)
    {
        $photo = Photo::with('categories')->find($id);

        if ($photo) {
            return response()->json([
                'success' => true,
                'results' => $photo,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'result' => '404 Not found'
            ]);
        }
    }
}
