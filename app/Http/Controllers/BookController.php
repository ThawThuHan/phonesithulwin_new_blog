<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('admin.book.index', ['books' => $books]);
    }

    public function create()
    {
        return view('admin.book.create');
    }

    public function store(Request $request)
    {
        $formdata = $request->validate([
            "name" => 'required',
            "price" => 'required|numeric',
            "features" => 'required',
            "release_date" => 'required',
            "images" => "required",
            "available" => "required",
            "preview_content" => 'required',
        ]);

        if ($request->hasFile("images")) {
            $images = $request->file('images');
            $paths = [];
            foreach ($images as $image) {
                $path = $image->store('book_images');
                $paths[] = explode('/', $path)[1];
            }
            $formdata['images'] = json_encode($paths);
        }

        Book::create($formdata);
        return back()->with('create', 'Book Created Successful!');
    }

    public function edit(Book $book)
    {
        return view('admin.book.edit', ["book" => $book]);
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            "name" => 'required',
            "price" => 'required|numeric',
            "features" => 'required',
            "release_date" => 'required',
            "images" => "",
            "old_images" => "required",
            "available" => "required",
            "preview_content" => 'required',
        ]);
        $book->name = $request->name;
        $book->price = $request->price;
        $book->features = $request->features;
        $book->release_date = $request->release_date;
        $book->images = $request->old_images;
        $book->available = $request->available;
        $book->preview_content = $request->preview_content;
        if ($request->hasFile('images')) {
            $old_images = json_decode($request->old_images);
            foreach ($old_images as $image) {
                Storage::delete('book_images/' . $image);
            }
            $images = $request->file('images');
            $paths = [];
            foreach ($images as $image) {
                $path = $image->store('book_images');
                $paths[] = explode('/', $path)[1];
            }
            $book->images = json_encode($paths);
        }

        $book->update();
        return redirect()->route('book.index')->with('update', 'Book Edited Successful!');
    }

    public function destroy(Book $book)
    {
        $images = json_decode($book->images);
        foreach ($images as $image) {
            Storage::delete('book_images/' . $image);
        }
        $book->delete();
        return redirect()->route('book.index')->with('delete', 'Book Deleted Successful!');
    }
}
