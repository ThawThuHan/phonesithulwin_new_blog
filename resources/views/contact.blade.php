@extends('layouts/master')

@section('title', "Contact")

@section('css')
    <link rel="stylesheet" href="css/contact.css">
    <link rel="stylesheet" href="{{URL::asset("css/carousel.css")}}">
    <link rel="stylesheet" href="{{URL::asset("css/swiper.bundle.min.css")}}">
@endsection

@section('content')
<div class="container-fluid" style="background-color: skyblue;">
    <h1 class="sub-title text-center p-3 m-3" style="color:white; text-shadow:2px 2px 4px #000000;">Contact</h1>

    @if (session("success"))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{session("success")}}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if (session("error"))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{session("error")}}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="container contact-container px-3">        
        <div class="container" id="primary">
            <div class="swiper mySwiper1">
                <div class="swiper-wrapper mb-3">
                    @php
                        $images = explode(",",$siteMaster->contact_carousel);    
                    @endphp
                    @foreach ($images as $image)
                        <div class="swiper-slide">
                            <img src="/storage/{{$image}}" alt="">
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination2"></div>
            </div>
        </div>
        
        <!-- Start Contact Form -->
        <div class="message-form container col-xs-12 col-md-8 col-lg-9">

            <form action="" id="form" method="post" class="form">
                @csrf
                <div class="mb-2 form-group ">
                    <label for="yname">
                        <h5>Enter Your Name</h5>
                    </label>
                    <input type="text" name="yname" class="form-control" id="yname" placeholder="ဥပမာ- ခင်မောင်ထွန်း">

                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error message</small>
                </div>

                <div class=" mb-2 form-group ">
                    <label for="email">
                        <h5>Enter your email</h5>
                    </label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="ဥပမာ- khinmaungtun1990@gmail.com">

                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error message</small>
                </div>

                <div class=" mb-2 form-group ">
                    <label for="phone">
                        <h5>Enter your phone</h5>
                    </label>
                    <input type="text" name="phone" class="form-control" id="phone" placeholder="ဥပမာ- ၀၉-xxxxxxxxx">

                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error message</small>
                </div>

                <div class="mb-2 form-group">
                    <label for="messages">
                        <h5>Enter your messages</h5>
                    </label>
                    <textarea name="messages" cols="30" rows="10" id="messages" class="form-control" placeholder="မိတ်ဆွေ ပြောဆိုချင်သောအကြောင်းအရာ (သို့) မေးချင်သောအကြောင်းအရာ"></textarea>

                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error message</small>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary mb-2">Send</button>
                </div>
            </form>

        </div>
        <!-- End Contact Form -->
    </div>
</div>
@endsection

@section('script')
<script src="js/contact.js"></script>
<script src="js/carousel.js"></script>
@endsection