<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SiteMaster>
 */
class SiteMasterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "home_carousel_ad" => "Ad/HomeCarousel/carousel_0.jpg",
            "home_banner_ad" => "Ad/HomeBanner/home_banner.gif",
            "post_banner_ad" => "Ad/PostBanner/post_banner.gif",
            "contact_carousel" => "Ad/ContactCarousel/carousel_0.jpg,Ad/ContactCarousel/carousel_1.jpg,Ad/ContactCarousel/carousel_2.jpg,Ad/ContactCarousel/carousel_3.jpg,Ad/ContactCarousel/carousel_4.jpg",
            "facebook_follower" => "107000",
            "weekly_visitor" => "14000",
        ];
    }
}
