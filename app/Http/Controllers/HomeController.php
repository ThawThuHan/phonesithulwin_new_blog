<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Book;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $books = Book::all();
        $recentPosts = Post::with('category')->latest()->paginate(9);
        $popularPosts = Post::with('category')->orderBy('view_count', 'desc')->take(4)->get();;
        // dd($popularPosts);
        return view('home', [
            "books" => $books,
            "recentPosts" => $recentPosts,
            "popularPosts" => $popularPosts,
        ]);
    }

    public function search()
    {
        if (request('query')) {
            $search = request('query');
            $search = mb_convert_encoding($search, 'utf-8');
            $posts = Post::where('content', 'LIKE', '%' . $search . '%')->get();
            // dd($posts);
            return view('search', [
                "search" => $search,
                "posts" => $posts,
            ]);
        }
        return back();
    }

    public function post($id)
    {
        $post = Post::find($id);
        if (!$post) {
            abort(404);
        }
        $post->view_count += 1;
        $post->update();
        $recentPosts = Post::inRandomOrder()->latest()->take(10)->get();
        $popular = Post::orderBy('view_count', 'desc')->take(10)->get();
        $relatedPosts = Post::where("category_id", $post->category_id)->inRandomOrder()->take(3)->get();
        $relatedPosts = $relatedPosts->filter(fn ($rPost) => $rPost->id != $id);
        return view('post', [
            "current" => $post,
            "recentPosts" => $recentPosts,
            "popular" => $popular,
            "relatedPosts" => $relatedPosts,
        ]);
    }

    public function categories()
    {
        $categories = Category::with("posts")->latest()->get();
        return view("categories", [
            "categories" => $categories,
        ]);
    }

    public function postsByCategory($category_id)
    {
        $category = Category::find($category_id);
        $posts = $category->posts;
        return view("posts", [
            "category" => $category,
            "posts" => $posts,
        ]);
    }

    public function sendMail(Request $request)
    {
        $details = [
            "name" => $request->yname,
            "email" => $request->email,
            "phone" => $request->phone,
            "messages" => $request->messages,
        ];
        try {
            Mail::to("support@phonesithulwin.info")->send(new ContactMail($details));
        } catch (\Throwable $th) {
            return back()->with("error", "Email sending fail! please try again later...");
        }
        return back()->with("success", "Email send success! thanks.");
    }
}
