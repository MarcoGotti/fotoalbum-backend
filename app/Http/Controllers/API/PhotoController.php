<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Photo;

class PhotoController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('is_highlight')) {
            return response()->json([
                //'is_highlight' => $request->is_highlight,
                'success' => true,
                'results' => Photo::with('categories')->orderByDesc('id')->where('is_highlight', true)->get()
                //con ->paginate() i links ...photos?page=n sono gli stessi di All-photos
            ]);
        }
        $photos = Photo::with('categories')->orderByDesc('id')->where('is_draft', false)->get();
        return response()->json([
            'success' => true,
            'results' => $photos,
        ]);
    }

    /* public function show($id)
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
    } */
}
