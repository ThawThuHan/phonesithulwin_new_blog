@extends('layouts.admin_layout')

@section('content')
    <h3>Dashboard</h3>
        <div class="d-flex flex-wrap justify-content-around">
            <div class="col-3">
                <div class="bg-primary text-center text-white p-3 rounded-3">
                    <h1>{{ $categories }}</h1>
                    <p>Categories</p>
                </div>
            </div>
            <div class="col-3">
                <div class="bg-primary text-center text-white p-3 rounded-3">
                    <h1>{{ $posts }}</h1>
                    <p>Articles</p>
                </div>
            </div>
            <div class="col-3">
                <div class="bg-primary text-center text-white p-3 rounded-3">
                    <h1>{{ $orders }}</h1>
                    <p>Book Order</p>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <h3>Edit Ad Images</h3>
            <form class="col-8" action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="">Home Carousel Ad</label>
                    <div>
                        <img src="/storage/Ad/HomeCarousel/" alt="">
                    </div>
                    <input class="form-control" type="file" name="carousel_Images[]" accept="image/jpeg,image/png,image/gif" multiple>
                </div>
                <div class="form-group mb-3">
                    <label for="">Home Banner Ad</label>
                    <input class="form-control" type="file" name="home_banner">
                </div>
                <div class="form-group mb-3">
                    <label for="">Post Banner Ad</label>
                    <input class="form-control" type="file" name="post_banner">
                </div>
                <button class="btn btn-primary">Submit</button>
            </form>
        </div>
@endsection 