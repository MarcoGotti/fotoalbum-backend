<?php

namespace App\Http\Controllers\Admin;

use App\Models\Photo;
use App\Models\User;
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
        return view('admin.photos.create', compact('owner_data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePhotoRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['slug'] = Str::of($request->title)->slug('-');
        //dd($validatedData);
        $photo = Photo::create($validatedData);

        return to_route('admin.photos.show', $photo)->with('message', 'You got it');
    }

    /**
     * Display the specified resource.
     */
    public function show(Photo $photo)
    {
        //dd($photo);
        $owner_data = User::all();
        return view('admin.photos.show', compact('photo', 'owner_data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Photo $photo)
    {
        $owner_data = User::all();
        return view('admin.photos.edit', compact('photo', 'owner_data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePhotoRequest $request, Photo $photo)
    {
        //dd($request->all());
        $validatedData = $request->validated();
        $validatedData['slug'] = Str::of($request->title)->slug('-');
        //dd($validatedData);
        $photo->update($validatedData);

        return to_route('admin.photos.show', $photo)->with('message', 'It\'s updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photo $photo)
    {
        $photo->delete();
        return redirect()->back()->with('message', 'Successfully deleted');
    }
}
