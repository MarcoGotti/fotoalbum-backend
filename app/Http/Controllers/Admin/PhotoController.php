<?php

namespace App\Http\Controllers\Admin;

use App\Models\Photo;
use App\Models\User;
use App\Models\Category;
use App\Http\Requests\StorePhotoRequest;
use App\Http\Requests\UpdatePhotoRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;


use function Ramsey\Uuid\v1;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $photos = Photo::orderByDesc('id')->paginate(12);
        $owner_data = User::all();

        return view('admin.photos.index', compact('photos', 'owner_data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $owner_data = User::all();
        $categories = Category::all();


        return view('admin.photos.create', compact('owner_data', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePhotoRequest $request)
    {
        //dd($request->all());

        $validatedData = $request->validated();
        $validatedData['slug'] = Str::of($request->title)->slug('-');
        if ($request->has('is_highlight')) {
            $validatedData['is_highlight'] = 1;
        } else {
            $validatedData['is_highlight'] = 0;
        }
        $request->has('is_draft') ? $validatedData['is_draft'] = 1 : $validatedData['is_draft'] = 0;



        //dd($validatedData);

        $photo = Photo::create($validatedData);
        $photo->categories()->attach($validatedData['categories']);

        return to_route('admin.photos.show', $photo)->with('message', 'You got it');
    }

    /**
     * Display the specified resource.
     */
    public function show(Photo $photo)
    {
        $owner_data = User::all();

        return view('admin.photos.show', compact('photo', 'owner_data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Photo $photo)
    {
        $owner_data = User::all();
        $categories = Category::all();

        return view('admin.photos.edit', compact('photo', 'owner_data', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePhotoRequest $request, Photo $photo)
    {
        $validatedData = $request->validated();
        $validatedData['slug'] = Str::of($request->title)->slug('-');
        $request->has('is_highlight') ? $validatedData['is_highlight'] = 1 : $validatedData['is_highlight'] = 0;
        $request->has('is_draft') ? $validatedData['is_draft'] = 1 : $validatedData['is_draft'] = 0;

        $photo->update($validatedData);
        if ($request->has('categories')) {
            $photo->categories()->sync($validatedData['categories']);
        }

        return to_route('admin.photos.index')->with('message', 'It\'s updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photo $photo)
    {
        $photo->categories()->detach();
        $photo->delete();
        return redirect()->back()->with('message', 'Successfully deleted');
    }
}
