@extends('layouts.master')

@section('title', $category->name)

@section('content')
<div class="container mt-3">
    <h2 class="text-center mb-4 sub-title"><?= $category->name ?></h2>
    <div class="row px-3">
        <?php foreach ($posts as $post) : ?>
            <?php
            $content = str_replace("\"", "\\\"", $post->content);
            $content = strip_tags($content);
            ?>
            <div class="col-12 col-md-6 col-lg-4 mb-3">
                <x-post-card :post="$post" />
            </div>
        <?php endforeach; ?>
    </div>
</div>
@endsection