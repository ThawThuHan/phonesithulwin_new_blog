@extends('layouts.admin_layout')

@section('content')
    <h3>Edit Book</h3>
<div class="py-2">
    <form action="{{ route('book.update', ['book' => $book->id]) }}" method="POST" enctype="multipart/form-data" class="needs-validation col-12 col-md-6">
        @csrf
        @method('put')
        <x-input-error name="name">
            <label for="name" class="form-label">Book Title:</label>
            <input class="form-control" id="name" type="text" name="name" placeholder="Enter your book title...." value="{{ $book->name }}" required>
        </x-input-error>
        <x-input-error name="price">
            <label for="price" class="form-label">Price:</label>
            <div class="input-group">
                <input class="form-control" id="price" type="number" name="price" placeholder="Price for book..." required value="{{ $book->price }}">
                <span class="input-group-text">Ks</span>
            </div>
        </x-input-error>
        <x-input-error name="features">
            <label for="features" class="form-label">Features:</label>
            <input type="text" name="features" id="features" class="form-control" placeholder="Features of your book..." required value="{{ $book->features }}">
        </x-input-error>
        <div class="row">
            <div class="col">
                <x-input-error name="release_date">
                    <label for="released_date" class="form-label">Released date:</label>
                    <input type="date" name="release_date" id="release_date" class="form-control" value="{{ $book->release_date }}" required>
                </x-input-error>
            </div>
            <div class="col">
                <x-input-error name="available">
                    <label for="available" class="form-label">Available</label>
                    <select class="form-select" name="available" id="available">
                        <option {{ $book->available == "1" ? "selected" : "" }} value="1">yes</option>
                        <option {{ $book->available == "0" ? "selected" : "" }} value="0">no</option>
                    </select>
                </x-input-error>
            </div>
        </div>
        <x-input-error name="images">
            <label for="image" class="form-label">Book cover & preview:</label>
            <div class="d-flex flex-wrap justify-content-between mb-2">
                @php
                    $images = json_decode($book->images);
                @endphp
                @foreach ($images as $image)
                    <img src="/storage/book_images/{{ $image }}" style="width: 100px; height: 100px" alt="">
                @endforeach
            </div>
            <input type="file" name="images[]" id="image" class="form-control" accept="image/*" multiple >
        </x-input-error>
        <input type="hidden" name="old_images" value="{{ $book->images }}">
        <x-input-error name="preview_content">
            <label for="content" class="form-label">Preview content:</label>
            <textarea class="form-control" style="resize: none" name="preview_content" rows="4" required placeholder="Say something about your book...">{{ $book->preview_content }}</textarea>
        </x-input-error>
        <button class="btn btn-primary" type="submit">Submit</button>
        <button 
        onclick="event.preventDefault();
        document.querySelector('#book_delete').submit();"
        class="btn btn-danger">Delete</button>
    </form>
    <form id="book_delete" action="{{ route('book.destroy', ['book' => $book->id]) }}" method="POST">
        @csrf
        @method('delete');
    </form>
</div>
@endsection