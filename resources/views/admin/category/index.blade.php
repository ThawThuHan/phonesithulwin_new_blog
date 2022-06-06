@extends('layouts.admin_layout')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center py-2">
    <span class="fs-3">Categories</span>
    <a class="btn btn-primary" href="{{ route('category.create') }}"><i class="fas fa-plus"></i> new category</a>
</div>

@if (session("status"))
    <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
    <strong>{{ session('status') }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Image</th>
            <th>Posts</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @php
            $i = 0;
        @endphp
        <?php foreach ($categories as $category) : ?>
            <?php
            $i += 1;
            $postCount = count($category->posts);
            ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $category->name ?></td>
                <td><img src="{{ asset("storage/category_images/".$category->image) }}" alt="" style="width:80px; height:100px"></td>
                <td><?= $postCount ?></td>
                <td>
                    <a href="{{ route('post.index', ['category' => $category->name]) }}" class="btn btn-primary mb-1 mb-md-0"><i class="fas fa-eye"></i></a>
                    <a href="{{ route("category.edit", ["category" => $category->id]) }}" class="btn btn-secondary mb-1 mb-md-0"><i class="fas fa-edit"></i></a>
                    <form class="d-inline-block" id="delete" action="{{ route('category.destroy', ['category' => $category->id]) }}" method="POST">
                    @csrf
                    @method("delete")
                        <button class="btn btn-danger mb-1 mb-md-0">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
@endsection