@extends('layouts.admin_layout')

@section('content')
    <h3>New Book</h3>
    @if (session("create"))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('create') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="py-2">
        <form action="{{ route('book.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation col-12 col-md-6" novalidate>
            @csrf
            <x-input-error name="name">
                <label for="name" class="form-label">Book Title:</label>
                <input class="form-control" id="name" type="text" name="name" placeholder="Enter your book title...." required>
            </x-input-error>
            <x-input-error name="price">
                <label for="price" class="form-label">Price:</label>
                <div class="input-group">
                    <input class="form-control" id="price" type="number" name="price" placeholder="Price for book..." required>
                    <span class="input-group-text">Ks</span>
                </div>
            </x-input-error>
            <x-input-error name="features">
                <label for="features" class="form-label">Features:</label>
                <input type="text" name="features" id="features" class="form-control" placeholder="Features of your book..." required>
            </x-input-error>
            <div class="row">
                <div class="col">
                    <x-input-error name="release_date">
                        <label for="released_date" class="form-label">Released date:</label>
                        <input type="date" name="release_date" id="release_date" class="form-control" required>
                    </x-input-error>
                </div>
                <div class="col">
                    <x-input-error name="available">
                        <label for="available" class="form-label">Available</label>
                        <select class="form-select" name="available" id="available">
                            <option value="1">yes</option>
                            <option value="0">no</option>
                        </select>
                    </x-input-error>
                </div>
            </div>
            <x-input-error name="images">
                <label for="image" class="form-label">Book cover & preview:</label>
                <input type="file" name="images[]" id="image" class="form-control" accept="image/*" multiple required>
            </x-input-error>
            <x-input-error name="preview_content">
                <label for="content" class="form-label">Preview content:</label>
                <textarea class="form-control" style="resize: none" name="preview_content" rows="4" required placeholder="Say something about your book..."></textarea>
            </x-input-error>
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    </div>
@endsection