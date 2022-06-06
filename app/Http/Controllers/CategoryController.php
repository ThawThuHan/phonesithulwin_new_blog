<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('posts')->get();
        return view('admin.category.index', ['categories' => $categories]);
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $formData = $request->validate([
            'name' => 'required|unique:categories',
            'image' => 'required',
        ]);
        $path = $request->file('image')->store("category_images");
        $formData['image'] = explode("/", $path)[1]; // store only filename in db.
        Category::create($formData);
        return back()->with("status", "Category Added!");
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', ['category' => $category]);
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
            'image' => '',
            'old_image' => '',
        ]);
        $category->name = $request->name;
        $category->image = $request->old_image;
        if ($request->file('image')) {
            $path = $request->file('image')->store("category_images");
            $category->image = explode("/", $path)[1];
            Storage::delete("category_images/{$request->old_image}");
        }
        $category->update();

        return redirect()->route('category.index')->with('status', 'Category edit successful!');
    }

    public function destroy(Category $category)
    {
        Storage::delete("category_images/" . $category->image);
        $category->delete();
        return back()->with("status", "Category Deleted!");
    }
}
