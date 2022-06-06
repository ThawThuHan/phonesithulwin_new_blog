<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'category_id', 'image', 'content'];

    public function scopeFilter($query, $data)
    {
        $query->when($data['search'] ?? false, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where("title", "LIKE", "%$search%")
                    ->orWhere("content", "LIKE", "%$search%");
            });
        });
        $query->when($data['category'] ?? false, function ($query, $category) {
            // $query->where("category_id", $category); // by category_id
            $query->whereHas("category", function ($query) use ($category) {
                $query->where('name', $category);
            });
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
