<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(15);
        $owner_data = User::all();

        return view('admin.categories.index', compact('categories', 'owner_data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:categories,name' //da sistemare anti hacker
        ]);

        $category = new Category();
        $category->name = $validatedData['name'];
        $category->slug = Str::of($validatedData['name'])->slug('-');
        $category->save();

        return to_route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $owner_data = User::all();
        return view('admin.categories.show', compact('category', 'owner_data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        // I don't need this view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //dd($request->all());
        $validatedData = $request->validated();
        $validatedData['slug'] = Str::of($request->name)->slug('-');
        //dd($validatedData);
        $category->update($validatedData);

        return redirect()->back()->with('message', 'You just modified the category');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()->with('message', 'Successfully deleted');
    }
}
