@extends('layouts.admin_layout')

@section('content')
    <h3 class="mb-2">Add Category</h3>
    @if (session("status"))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{ session('status') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form class="col-6 py-2" action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <x-input-error name="name">
            <input class="form-control" type="text" name="name" placeholder="Category Name">
        </x-input-error>
        <x-input-error name="image">
            <input type="file" name="image" class="form-control mb-2" accept="image/png, image/gif, image/jpeg">
        </x-input-error>
        <button class="btn btn-primary ms-1">Submit</button>
    </form>
@endsection