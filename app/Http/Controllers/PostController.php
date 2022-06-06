<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $query = request(['search', 'category']);
        $posts = Post::latest()->filter($query)->paginate(9)->withQueryString();
        return view('admin.post.index', ["posts" => $posts]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.post.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $formdata = $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'image' => 'required',
            'content' => 'required',
        ]);
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('post_images');
            $formdata['image'] = explode("/", $path)[1];
        }
        Post::create($formdata);
        return back()->with("status", "Post Created!");
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.post.edit', ["post" => $post, "categories" => $categories]);
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => "required",
            'image' => "",
            'category_id' => 'required',
            'old_image' => '',
            'content' => "required",
        ]);
        $post->title = $request->title;
        $post->category_id = $request->category_id;
        $post->image = $request->old_image;
        $post->content = $request->content;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('post_images');
            $post->image = explode('/', $path)[1];
            Storage::delete('post_images/' . $request->old_image);
        }
        $post->update();
        return redirect()->route('post.index')->with('edit', 'Post Edit Successful!');
    }

    public function destroy(Post $post)
    {
        Storage::delete('post_images/' . $post->image);
        $post->delete();
        return redirect()->route('post.index')->with('delete', 'Post Deleted Successful!');
    }
}
