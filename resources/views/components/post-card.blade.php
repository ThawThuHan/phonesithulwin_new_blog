<?php
$content = str_replace("\"", "\\\"", $post->content);
$content = strip_tags($content);
?>
<a href="/posts/{{ $post->id }}" class="text-decoration-none text-dark blog">
    <div class="card blogShadow h-100">
        <img src="{{ URL("storage/post_images/".$post->image) }}" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title d-inline">{{ $post->title }}</h5>
            <div class="text-muted">
                <span>{{ $post->created_at->diffForHumans() }}</span>
                <span class="card-subtitle float-end"><i class="fas fa-eye"></i> {{ App\Custom\MyClass::number_format_short($post->view_count) }}</span>
            </div>
            <p class="card-text mt-4">
                {{ mb_strimwidth($content, 0, 100, '...', 'utf-8') }}
            </p>
            <a href="/posts/{{ $post->id }}" class="btn btn-info mt-2 float-end text-white">Read more</a>
        </div>
    </div>
</a>