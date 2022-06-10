@extends('layouts.master')

@section('metatags')
<meta property="og:type" content="website" />
<meta property="og:image" content="{{ asset('storage/post_images/'.$current->image) }}" />
@endsection

@section('css')
    <link rel="stylesheet" href="/css/content-styles.css"">
    <link rel="stylesheet" href="/css/post.css">
@endsection

@section('title', $current->title)

@section('content')
<!-- Ad -->
<div class="container">
    <img src="/storage/{{ $siteMaster->post_banner_ad }}" class="adImg" alt="">
</div>

<div class="container">
    <div class="row">
        <div class="col-9">
            <h3 class="mt-2">{{ $current->title }}</h3>
            <div class="mb-4 main-image">
                <img src="{{ asset('storage/post_images/'.$current->image) }}" alt="" style="width: 100%; height: 100%; object-fit: contain;">
            </div>
            <span class="fs-5"><b>Posted - {{ $current->created_at->diffForHumans() }}</b></span> <br>
            <small> by <b>Dr.Phone Sithu Lwin</b></small>
            <div id="content" class="ck-content mt-2">
                {!! $current->content !!}
            </div>

            <!-- share -->
            <h6 class="mx-5 border-top d-inline">Share this:</h6>
            <div class="mx-5 mt-1 d-flex align-items-center gap-1" id="footer">
                <!-- copy link -->
                <a id="copyurl" class="fas fa-link fs-3 mx-1 my-2 text-decoration-none"></a>
                <!-- facebook -->
                <a href="http://www.facebook.com/sharer.php?u={{ Request::url() }}" class="fab fa-facebook fs-3 text-primary mx-1 my-2 text-decoration-none"></a>
                <!-- telegram -->
                <a href="https://t.me/share?url={{ Request::url() }}" class="fab fa-telegram fs-3 mx-1 my-2 text-decoration-none"></a>
                <!-- twitter -->
                <a href="https://twitter.com/intent/tweet?original_referer={{ Request::url() }}" class="fab fa-twitter fs-3 text-primary mx-1 my-2 text-decoration-none"></a>
                <!-- linkedin -->
                <a href="http://www.linkedin.com/shareArticle?mini=true&url={{ Request::url() }}" class="fab fa-linkedin fs-3 mx-1 my-2  text-decoration-none"></a>
            </div>
        </div>
        <div class="col-3 ps-0">
            <div class="mb-2">
                <span>Font Size</span>
                <button onclick="incrementSize()" class="fas fa-plus bg-outline-secondary"></button>
                <button onclick="decrementSize()" class="fas fa-minus bg-outline-secondary"></button>
                
            </div>
            <!-- recent posts -->
            <h4 class="fs-5">For you</h4>
            @foreach ($recentPosts as $post)
            <?php
            $content = str_replace("\"", "\\\"", $post->content);
            $content = strip_tags($content);
            ?>
            <a href="/posts/{{ $post->id }}" style="text-decoration: none;">
                <span class="side-title">{{ $post->title }}</span>
            </a>
            {{-- <hr> --}}
            <div class="mb-2" style="height: 0.09px; width:50%; background-color:rgb(161, 161, 161)"></div>
            @endforeach

            <!-- popular posts -->
            <h4 class="mt-4">Popular Posts</h4>
            @foreach ($popular as $post)
            <?php
            $content = str_replace("\"", "\\\"", $post->content);
            $content = strip_tags($content);
            ?>
            <a href="/posts/{{ $post->id }}" style="text-decoration: none;">
                <span class="side-title">{{$post->title}}</span>
            </a>
            <div class="mb-2" style="height: 0.09px; width:50%; background-color:gray"></div>
            @endforeach
        </div>
    </div>
    
    <!-- Ad -->
    <div class="container">
        <img src="/storage/{{ $siteMaster->post_banner_ad }}" class="adImg" alt="">
    </div>

    <!-- related posts -->
    <h2 class="mx-2 mt-5">Related Posts</h2>
    <div class="row mx-2 mt-3">
        <div class="row g-0 g-md-3">
            @foreach ($relatedPosts as $post)
            <div class="col-xs-12 col-md-4 col-sm-6 mb-3">
                <x-post-card :post="$post" />
            </div>
            @endforeach
        </div>
    </div>

    <!-- Ad -->
    <div class="container">
        <img src="/storage/{{ $siteMaster->post_banner_ad }}" class="adImg" alt="">
    </div>
</div>
@endsection

@section('script')
    <script>
        let copy = document.querySelector("#copyurl");
        copy.addEventListener("click", function(e) {
            e.preventDefault();
            let url = window.location.href;
            let result = navigator.clipboard.writeText(url);
            result.then(() => {
                alert("link copied!")
            })
        })

        const content = document.querySelector("#content");

        let size = 12;

        function incrementSize() {
            size++;
            content.style.fontSize = `${size}px`;
        }

        function decrementSize() {
            size--;
            content.style.fontSize = `${size}px`;
        }
    </script>
@endsection