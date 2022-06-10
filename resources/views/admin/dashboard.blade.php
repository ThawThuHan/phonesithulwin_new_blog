@extends('layouts.admin_layout')

@section('content')
    <h3>Dashboard</h3>
        <div class="d-flex flex-wrap justify-content-evenly align-items-center mb-3">
            <div class="col-3">
                <div class="bg-secondary text-center text-white p-2 p-md-3 rounded-3">
                    <h1>{{ $categories }}</h1>
                    <p>Categories</p>
                </div>
            </div>
            <div class="col-3">
                <div class="bg-secondary text-center text-white p-2 p-md-3 rounded-3">
                    <h1>{{ $posts }}</h1>
                    <p>Articles</p>
                </div>
            </div>
            <div class="col-3">
                <div class="bg-secondary text-center text-white p-2 p-md-3 rounded-3">
                    <h1>{{ $orders }}</h1>
                    <p>Order</p>
                </div>
            </div>
        </div>

        <div class="container d-flex flex-wrap justify-content-evenly mb-3 show-counter mt-4">
            <div class="btn btn-primary mb-2" >
                <div><span id="counter" class="counter fs-2" data-target=""></span><span class="fs-2">+</span></div>
                <div>Total Website Visitors</div>
            </div>
            <div class="btn btn-primary mb-2">
                <div><span id="count2" data-target2="107000" class="fs-2">107000</span><span class="fs-2">+</span></div>
                <div>Facebook Followers</div>
            </div>
            <div class="btn btn-primary mb-2">
                <div><span id="count2" data-target2="14000" class="fs-2">14000</span><span class="fs-2">+</span></div>
                <div>Weekly Website Visitors</div>
            </div>
        </div>
        <hr>

        <div class="mt-4 col-12 col-md-8 mx-auto">
            <h3 class="text-center">Edit Site Info & Ad</h3>
            <form class="" action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col form-group">
                        <label for="">Facebook Followers</label>
                        <input class="form-control" type="text" name="facebook_follower" value="{{ $siteMaster->facebook_follower ?? "" }}">
                    </div>
                    <div class="col form-group">
                        <label for="">Weekly Website Visitors</label>
                        <input class="form-control" type="text" name="weekly_visitor" value="{{ $siteMaster->weekly_visitor ?? "" }}">
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="">Home Carousel Ad</label>
                    @php
                        $images = explode(',', $siteMaster->home_carousel_ad);
                    @endphp
                    <div class="d-flex flex-wrap mb-3">
                    @foreach ($images as $image)
                            <img src="storage/{{$image}}" alt="" style="width: 100px; height: 100px;">
                    @endforeach
                    </div>
                    <input class="form-control" type="file" name="home_carousel_ad[]" accept="image/jpeg,image/png,image/gif" multiple>
                </div>
                <div class="form-group mb-3">
                    <label for="">Home Banner Ad</label>
                    <div class="d-flex flex-wrap mb-3">
                        <img src="storage/{{ $siteMaster->home_banner_ad }}" alt="" style="width: 100%; height: 80px;">
                    </div>
                    <input class="form-control" type="file" name="home_banner_ad">
                </div>
                <div class="form-group mb-3">
                    <label for="">Post Banner Ad</label>
                    <div class="d-flex flex-wrap mb-3">
                        <img src="storage/{{ $siteMaster->post_banner_ad }}" alt="" style="width: 100%; height: 80px;">
                    </div>
                    <input class="form-control" type="file" name="post_banner_ad">
                </div>
                <div class="form-group mb-3">
                    <label for="">Home Carousel Ad</label>
                    @php
                        $images = explode(',', $siteMaster->contact_carousel);
                    @endphp
                    <div class="d-flex flex-wrap mb-3">
                    @foreach ($images as $image)
                            <img src="storage/{{$image}}" alt="" style="width: 100px; height: 100px;">
                    @endforeach
                    </div>
                    <input class="form-control" type="file" name="contact_carousel[]" accept="image/jpeg,image/png,image/gif" multiple>
                </div>
                <input type="hidden" name="old_home_carousel_ad" value="{{ $siteMaster->home_carousel_ad }}">
                <input type="hidden" name="old_contact_carousel" value="{{ $siteMaster->home_carousel_ad }}">
                <input type="hidden" name="old_home_banner_ad" value="{{ $siteMaster->home_banner_ad }}">
                <input type="hidden" name="old_post_banner_ad" value="{{ $siteMaster->post_banner_ad }}">
                <button class="btn btn-primary">Submit</button>
            </form>
        </div>
@endsection 

@section('script')
    <script src="/js/counter.js"></script>
@endsection