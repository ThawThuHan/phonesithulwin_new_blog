<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $categories = Category::count();
        $posts = Post::count();
        $orders = Order::count();
        return view('admin.dashboard', [
            'categories' => $categories,
            'posts' => $posts,
            'orders' => $orders,
        ]);
    }

    public function adImage(Request $request)
    {
        if ($request->hasFile('carousel_Images')) {
            $images = $request->file('carousel_Images');
            foreach ($images as $key => $image) {
                $ext = $image->getClientOriginalExtension();
                $image->storeAs('Ad/HomeCarousel', "carousel_$key.$ext");
            }
        }

        return back();
    }
}
