@extends('layouts.admin_layout')

@section('content')
    <h3 class="mb-2">Edit Category</h3>

    <form class="col-6 py-2" action="{{ route('category.update', ['category' => $category->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <x-input-error name="name">
            <input class="form-control" type="text" name="name" placeholder="Category Name" value="{{ $category->name }}">
        </x-input-error>
        <div class="mb-2">
            <img src="/storage/category_images/{{ $category->image }}" alt="" style="width: 100px; height: 100px;">
        </div>
        <input type="hidden" name="old_image" id="" value="{{ $category->image }}">
        <x-input-error name="image">
            <input type="file" name="image" class="form-control mb-2" accept="image/png, image/gif, image/jpeg">
        </x-input-error>
        <button class="btn btn-primary ms-1">Submit</button>
    </form>
@endsection