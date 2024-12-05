<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::latest();
        $search = $request->input('search', '');
        if ($search) {
            $categories->where('name', 'LIKE', '%' . $search . '%');
        }
        $categories = $categories->paginate(12);
        return view('admin.categories.index', compact('categories', 'search'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories,name|max:100',
            'description' => 'nullable|max:2000',
            'image' => 'required|mimes:jpg,png,gif,jpeg,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return responseJson([
                'errors' => $validator->errors(),
            ], 'error', 422);
        }

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->slug = Str::slug($request->name);
        $category->status = true;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filePath = 'uploads/categories';
            $imagePath = saveImage($image, $filePath);

            $category->image = $imagePath;
        }

        $category->save();

        return responseJson([
            'message' => 'Category created successfully!',
            'redirect' => route('categories.index'),
        ], 'success', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);

        if (!$category) {
            session()->flash('error', 'Category not found');

            return redirect()->back();
        }
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories,name,' . $category->id . '|max:100',
            'description' => 'nullable|max:2000',
            'image' => 'nullable|mimes:jpg,png,gif,jpeg,webp|max:2048',
            'status' => 'required|in:0,1'
        ]);

        if ($validator->fails()) {
            return responseJson([
                'errors' => $validator->errors(),
            ], 'error', 422);
        }

        $category->name = $request->name;
        $category->description = $request->description;
        $category->slug = Str::slug($request->name);
        $category->status = $request->status;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filePath = 'uploads/categories';

            if ($category->image) {
                deleteOldImage($category->image); 
            }

            $imagePath = saveImage($image, $filePath);
            $category->image = $imagePath;
        }

        $category->save();

        return responseJson([
            'message' => 'Category updated successfully!',
            'redirect' => route('categories.index'),
        ], 'success', 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);

        if (!$category) {
            session()->flash('error', 'Category not found');

            return redirect()->back();
        }

        $category->delete();

        session()->flash('success', 'Category deleted successfully');
        return redirect()->back();
    }

}
