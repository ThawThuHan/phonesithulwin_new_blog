@extends('layouts.admin_layout')

@section('css')
<style>
    .myCustom-card img {
        width: 100%;
        height: 150px;
        /* background-color: darkslateblue; */
    }

    .myCustom-text {
        word-wrap: break-word;
    }
</style>
@endsection

@section('content')
<div class="py-2 d-flex flex-wrap justify-content-between align-items-center">
    <h3>Articles</h3>
    <a class="btn btn-primary" href="{{ route("post.create") }}"><i class="fas fa-plus"></i> New Post</a>
</div>

<form class="d-flex" action="">
    {{-- @if (request('category'))
        <input type="hidden" name="category" value="{{ request('category') }}">
    @endif --}}
    <input class="form-control" type="text" name="search" placeholder="Search" value="{{ request('search') }}">
    <button class="btn btn-primary ms-2">Search</button>
</form>

@if (session("edit"))
    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
    <strong>{{ session('edit') }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session("delete"))
    <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
    <strong>{{ session('delete') }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="py-2">
    <h3 class="mt-2">Category : {{ request('category') ? request('category') : "ALL" }}</h3>
    <div class="row g-2 m-0">
        <?php foreach ($posts as $post) : ?>
            <?php
            $content = str_replace("\"", "\\\"", $post->content);
            $content = strip_tags($content);
            ?>
            <div onclick="location.href='{{ route('post.edit', ['post' => $post->id]) }}'" class="col-12 col-md-6 col-lg-4 myCustom-card">
                <div class="m-1 p-2">
                    <img class="border rounded" src="{{ asset("storage/post_images/".$post->image) }}" alt="">
                    <h6 class="mt-2"><b><?= $post->title ?></b></h6>
                    <div class="text-muted d-flex justify-content-between"><?= $post->created_at ?> <span class="text-end"><?= $post->view_count ?> <i class="fa fa-eye"></i></span></div>
                    <div class="myCustom-text mt-2">
                        <?= mb_strimwidth($content, 0, 100, '...', 'utf-8') ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="text-center">
        {{ $posts->onEachSide(1)->links() }}
    </div>
</div>
@endsection