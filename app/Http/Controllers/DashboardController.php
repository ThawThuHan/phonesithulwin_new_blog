<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Post;
use App\Models\SiteMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $categories = Category::count();
        $posts = Post::count();
        $orders = Order::count();
        $siteMaster = SiteMaster::latest()->first();
        return view('admin.dashboard', [
            'categories' => $categories,
            'posts' => $posts,
            'orders' => $orders,
            'siteMaster' => $siteMaster,
        ]);
    }

    public function updateOrCreate(Request $request)
    {
        $request->validate([
            "facebook_follower" => "required",
            "weekly_visitor" => "required",
        ]);

        $formData = [
            "facebook_follower" => $request->facebook_follower,
            "weekly_visitor" => $request->weekly_visitor,
            "home_carousel_ad" => $request->old_home_carousel_ad,
            "home_banner_ad" => $request->old_home_banner_ad,
            "post_banner_ad" => $request->old_post_banner_ad,
            "contact_carousel" => $request->old_contact_carousel,
        ];

        if ($request->hasFile('home_carousel_ad')) {
            Storage::deleteDirectory('Ad/HomeCarousel');
            $images = $request->file('home_carousel_ad');
            $paths = [];
            foreach ($images as $key => $image) {
                $ext = $image->getClientOriginalExtension();
                $paths[] = $image->storeAs('Ad/HomeCarousel', "carousel_$key.$ext");
            }
            $formData['home_carousel_ad'] = implode(",", $paths);
        }

        if ($request->hasFile('contact_carousel')) {
            Storage::deleteDirectory('Ad/ContactCarousel');
            $images = $request->file('contact_carousel');
            $paths = [];
            foreach ($images as $key => $image) {
                $ext = $image->getClientOriginalExtension();
                $paths[] = $image->storeAs('Ad/ContactCarousel', "carousel_$key.$ext");
            }
            $formData['contact_carousel'] = implode(",", $paths);
        }

        if ($request->hasFile('home_banner_ad')) {
            Storage::deleteDirectory('Ad/HomeBanner');
            $image = $request->file('home_banner_ad');
            $ext = $image->getClientOriginalExtension();
            $path = $image->storeAs('Ad/HomeBanner', "home_banner.$ext");
            $formData['home_banner_ad'] = $path;
        }

        if ($request->hasFile('post_banner_ad')) {
            Storage::deleteDirectory('Ad/PostBanner');
            $image = $request->file('post_banner_ad');
            $ext = $image->getClientOriginalExtension();
            $path = $image->storeAs('Ad/PostBanner', "post_banner.$ext");
            $formData['post_banner_ad'] = $path;
        }


        $siteMaster = SiteMaster::updateOrCreate([
            "id" => 1,
        ], $formData);

        return back();
    }
}
