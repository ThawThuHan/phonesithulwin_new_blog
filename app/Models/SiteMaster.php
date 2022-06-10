<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteMaster extends Model
{
    use HasFactory;

    protected $fillable = [
        'home_carousel_ad',
        'home_banner_ad',
        'post_banner_ad',
        'contact_carousel',
        'facebook_follower',
        'weekly_visitor',
    ];
}
