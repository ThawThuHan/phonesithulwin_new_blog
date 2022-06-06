@extends('layouts/master')

@section('title', 'Home')

@section('css')
    <link rel="stylesheet" href="{{URL::asset("css/index.css")}}">
    <link rel="stylesheet" href="{{URL::asset("css/adSlider.css")}}">
@endsection

@section('content')
<div class="banner container-fluid">
    <div class="container py-auto" id="title-box">
        <div class="row g-5">
            <div class="col-12 col-lg-6 d-flex flex-column align-items-center justify-content-center py-4">
                <h1 class="text-primary ">Dr.Phone Sithu Lwin</h1>
                <h3 class="text-primary mb-5">Knowledge Sharing</h3>
                <p class=" text-primary">
                    ကျွန်တော် ဘုန်းစည်သူလွင် သည် အထွေထွေရောဂါကုဆရာဝန် တစ်ယောက်ဖြစ်ပြီး မိသားစုကျန်းမာရေးစောင့်ရှောက်မှုဆေးပညာဘွဲ့လွန် နှင့် တော်ဝင်သမားတော်ဘွဲ့ရေးဖြေ (MRCP part II) အောင်မြင်ထားပါတယ်။
                    <br>
                    ၁။ မလိုအပ်ပဲ ဆေးများ မသောက်သုံးစေလိုခြင်း <br>
                    ၂။ မိမိခံစားနေရသော ရောဂါဝေဒနာ အချို့ကို သိရှိစေလိုခြင်း <br>
                    ၃။ Healthy Life Style (ကျန်းမာသော လူနေမှုပုံစံ) ပြောင်းလဲ ခြင်း <br>
                    စသည်ဖြင့် ရောဂါများကင်းဝေး စေလိုခြင်း စသည့်ရည်ရွယ်ချက်များဖြင့် ကျန်းမာရေးဆောင်းပါးများရေးသား မျှဝေနေသူတစ်ဦးဖြစ်ပါသည်။ 
                    ဤ Blog Website တွင် အကြောင်းအရာများစွာ လေ့လာဖတ်ရှုနိုင်ပါသည်။
                </p>
                <div class="container d-flex align-items-center justify-content-center">
                    <a href="/about" class="btn btn-info rounded-pill text-white">About me</a>
                </div>
            </div>
            <div class="col-12 col-md-6 d-none d-lg-flex align-items-end justify-content-center">
                <img src="assets/images/phonestl2.png" style="width: 70%" alt="">
            </div>
        </div>
    </div>
</div>

<!-- ad slider -->
    <div class="container mt-5" id="primary">
        <div class="swiper mySwiper1">
            <div class="swiper-wrapper mb-3">
                <div class="swiper-slide">
                    <img src="assets/images/post ad.jpg" alt="">
                </div>
                <div class="swiper-slide">
                    <img src="assets/images/book1.jpg" alt="">
                </div>
                <div class="swiper-slide">
                    <img src="assets/images/book2.jpg" alt="">
                </div>
                <div class="swiper-slide">
                   <img src="assets/images/book3.jpg" alt="">
                </div>
            </div>
            <div class="swiper-pagination2"></div>
        </div>
    </div>

<div class="container mt-5">
    <h2 class="mb-4 sub-title">Recent Posts</h2>
    <div class="row mb-0 mb-md-4">
        @foreach ($recentPosts as $post)
            <div class="col-12 col-md-6 col-lg-4 g-3 mb-3">
                <x-post-card :post="$post" />
                {{-- <div class="">
                    <div class="mycard position-relative">
                        <img src="{{ URL("storage/post_images/".$post->image) }}" alt="...">
                        <div class="position-absolute p-3 start-0 bottom-0">
                            <h5 class="card-title d-inline text-white">{{ $post->title }}</h5>
                            <div class="text-white">
                                <span>{{ $post->created_at->diffForHumans() }}</span>
                                <span class="card-subtitle float-end"><i class="fas fa-eye"></i> {{ $post->view_count }}</span>
                            </div>
                            <p class="card-text mt-4">
                                {{ mb_strimwidth($content, 0, 100, '...', 'utf-8') }}
                            </p>
                        </div>
                    </div>
                </div> --}}
            </div>
        @endforeach
        <div>{{ $recentPosts->onEachSide(1)->links() }}</div>
    </div>
</div>

<!-- Ad -->
<div class="container">
    <img src="/assets/images/text.gif" class="adImg" alt="">
</div>

<!-- popular posts -->
<div class="container mt-3">
    <h2 class="mb-4 sub-title">Popular Posts</h2>
    <div class="row mb-4">
        @foreach ($popularPosts as $post)
        <div class="col-12 col-md-6 col-lg-3 mb-3">
            <x-post-card :post="$post" />
        </div>
        @endforeach
    </div>
</div>

<div class="container d-flex flex-wrap justify-content-evenly mb-3 show-counter">
    <div class="btn btn-primary" >
        <div><span id="counter" class="counter fs-2" data-target=""></span><span class="fs-2">+</span></div>
        <div>Total Website Visitors</div>
    </div>
    <div class="btn btn-primary">
        <div><span id="count2" data-target2="107000" class="fs-2">107000</span><span class="fs-2">+</span></div>
        <div>Facebook Followers</div>
    </div>
    <div class="btn btn-primary">
        <div><span id="count2" data-target2="14000" class="fs-2">14000</span><span class="fs-2">+</span></div>
        <div>Weekly Website Visitors</div>
    </div>
</div>

<!-- Ad -->
<div class="container">
    <img src="/assets/images/text.gif" class="adImg" alt="">
</div>

<!-- books -->
<div class="container mt-3" id="book">
    <div class="container-fluid my-3">
        <i class="fas fa-book fs-2 m-0"></i>
        <!-- <i class="fas fa-book-medical"></i> -->
        <h3 class="d-inline sub-title">ထွက်ရှိပြီးသောစာအုပ်များ...</h3>
        <span class="btn btn-secondary ms-3">{{ count($books) }} books</span>
    </div>

    <div class="py-2" id="post-view">
        <div class="row">
            <?php foreach ($books as $book) : ?>
                <?php
                $images = json_decode($book->images);
                ?>
                <div class="col-12 col-md-6">
                    <div class="card mb-3 mx-3 blogShadow">
                        <div class="row g-0">
                            <div class="col-md-4 book position-relative">
                                @if (!$book->available)
                                <div class="bg-danger text-white text-center position-absolute top-0 px-2">out of stock</div>
                                @endif
                                <img src="{{ URL("storage/book_images/".$images[0]) }}" class="" alt="..." style="object-fit: cover; width: 100%;height: 280px;">
                            </div>
                            <div class="col-md-8 p-3 d-flex flex-column justify-content-between">
                                <h5 class="card-title d-inline"><b><?= $book->name ?></b></h5>
                                {{-- <div class="float-end my-3"><?= $book->order_count ?><i class="fas fa-shopping-cart"></i></div> --}}
                                <p class="card-text mt-4 mb-2">
                                    {{ mb_strimwidth($book->preview_content, 0, 100, '...', 'utf-8') }}
                                </p>
                                <div class="d-flex justify-content-between">
                                    <span class="float-start my-3 text-danger"><?= $book->price." Ks" ?></span>
                                    @if ($book->available)
                                    <a href="/book/<?= $book->id ?>/order" class="btn btn-info text-white my-2">Order Now</a>
                                    @else
                                    <a class="btn btn-secondary text-white my-2">Order Now</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>
    
@endsection

@section('script')
<script src="js/adSlider.js"></script>
<script src="js/counter.js"></script>
@endsection