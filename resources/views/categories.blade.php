@extends('layouts/master')

@section('title', "Categories")

@section('css')
    <link rel="stylesheet" href="css/categories.css">
    <style>
        .category-text {
            text-align: center;
            color: white;
            font-weight: bolder;
            text-shadow: 2px 2px 4px #000000;
            font-size: 20px;
        }

        .category-img {
            filter: brightness(70%);
            /* opacity: 0.7;  */
            width: 100%; 
            height: 180px; 
            object-fit: cover; 
            box-shadow: 5px 5px 5px grey;
            border-radius: 20px;
        }
    </style>
@endsection

@section('content')
<div class="container mt-3">
    <h2 class="mb-4 sub-title">Categories</h2>
    <div class="row g-3 mb-4">
        <?php foreach ($categories as $category) : ?>
            
            <div onclick="location.href='/categories/{{ $category->id }}/posts'" class="col-12 col-md-6 col-lg-4" >
                <div class="position-relative">
                    <img class="category-img" src="{{ asset("storage/category_images/".$category->image) }}" alt="..." style="">
                    <div class="category-text position-absolute start-50 top-50 translate-middle">
                        <p class=""><?= $category->name; ?></p>
                        <strong> <?= count($category->posts) ?> posts</strong>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- <div onclick="location.href='articles.php'" class="col-12 col-md-6 col-lg-3 mb-3" style="position: relative;">
        <b style="position: absolute; right: 0%;">3 posts</b>
        <img src="assets/images/stress.jpg" class="" alt="..." style="opacity: 0.6; width: 100%; height: 200px; object-fit: cover; box-shadow: 0px 0px 5px black;">
        <strong class="" style="position: absolute; top: 100px; left: 150px; transform: translate(-50%, -25%);">Title</strong>
            
    </div> -->
</div>
@endsection