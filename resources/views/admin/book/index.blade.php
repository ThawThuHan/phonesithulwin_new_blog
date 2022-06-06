@extends('layouts.admin_layout')

@section('content')
<div class="my-2 d-flex flex-wrap justify-content-between align-items-center">
    <h3>Books</h3>
    <a href="{{ route('book.create') }}" class="btn btn-primary" id="post-btn"><i class="fas fa-plus"></i> New Book</a>
</div>

@if (session("update"))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
    <strong>{{ session('update') }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session("delete"))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>{{ session('delete') }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
    
<div class="py-2" id="post-view">
    <div class="row g-3">
        <?php foreach ($books as $book) : ?>
            <?php
            $images = json_decode($book->images);
            $image = $images[0];
            ?>
            <div onclick="location.href='{{ route('book.edit', ['book' => $book->id]) }}'" class="col-12 col-md-6">
                <div class="card mb-3 mx-3 blogShadow" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4 book">
                            <img src="{{ asset("storage/book_images/".$image) }}" class="" alt="..." style="object-fit: cover; width: 100%; height: 280px;">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title d-inline"><b><?= $book->name ?></b></h5>
                                <div class="float-end my-3"><?= $book->order_count ?><i class="fas fa-shopping-cart"></i></div>
                                <p class="card-text mt-4 mb-2">
                                    {{ mb_strimwidth($book->preview_content, 0, 100, '...', 'utf-8') }}
                                </p>
                                <span class="float-start my-3 text-danger"><?= $book->price ?> MMK</span>
                                <span class="float-end my-3"><?= $book->created_at ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
@endsection