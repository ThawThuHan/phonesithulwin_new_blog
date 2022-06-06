@extends('layouts.admin_layout')

@section('content')
    <h3>Edit Post</h3>
<div class="py-2" id="post-form">
    <form action="{{ route("post.update", ["post" => $post->id]) }}" id="post-form-validation" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <x-input-error name="title">
            <input class="form-control" id="title" type="text" name="title" placeholder="Title Here...." value="{{ $post->title }}">
        </x-input-error>
        <x-input-error name="category_id">
            <select class="form-select mb-2" name="category_id" id="category">
                <option value="">Select Category....</option>
                @foreach ($categories as $category)
                    <option {{ $category->id == $post->category_id ? "selected" : "" }} value="<?= $category->id ?>"> <?= $category->name ?> </option>
                @endforeach
            </select>
        </x-input-error>
        <div class="mb-2">
            <img src="/storage/post_images/{{ $post->image }}" style="width: 100px; height: 100px" alt="No Image">
        </div>
        <x-input-error name="image">
            <input type="file" name="image" id="image" class="form-control mb-2" accept="image/gif, image/jpeg, image/png">
        </x-input-error>
        <input type="hidden" name="old_image" value="{{ $post->image }}">
        <x-input-error name="content">
            <textarea class="form-control" name="content" id="editor" cols="30" rows="10">
                {{ $post->content }}
            </textarea>
        </x-input-error>
        <button class="btn btn-primary mt-2">Submit</button>
        <button 
        onclick="event.preventDefault();
        document.querySelector('#post_delete').submit();"
        class="btn btn-danger mt-2">Delete</button>
    </form>
    <form id="post_delete" action="{{ route('post.destroy', ['post' => $post->id]) }}" method="POST">
        @csrf
        @method('delete');
    </form>
</div>
@endsection

@section('script')
<script src="{{ asset("packages/my_ckeditor/build/ckeditor.js") }}"></script>
<script>
    ClassicEditor.contentsCss = "css/content.css";
    // ClassicEditor.allowedContent = true;
    ClassicEditor.create(document.querySelector("#editor"), {
        // plugin: ['Image', 'ImageToolbar', 'ImageCaption', 'ImageStyle', 'ImageResize', 'SimpleImageUploader', ],
        plugin: ['ImageResizeEditing', 'ImageResizeHandles', 'SimpleImageUploader'],
        simpleUpload: {
            uploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
        },
        mediaEmbed: {
            previewsInData: true,
            // elementName: 'o-embed',
        },
        image: {
            resizeOptions: [
                {
                    name: 'resizeImage:original',
                    value: null,
                    label: 'Original'
                },
                {
                    name: 'resizeImage:20',
                    value: '20',
                    label: '20%'
                },
                {
                    name: 'resizeImage:40',
                    value: '40',
                    label: '40%'
                },
                {
                    name: 'resizeImage:60',
                    value: '60',
                    label: '60%'
                },
                {
                    name: 'resizeImage:80',
                    value: '80',
                    label: '80%'
                },
                {
                    name: 'resizeImage:100',
                    value: '100',
                    label: '100%'
                },
            ],
            toolbar: ['imageStyle:alignBlockRight', 'imageStyle:alignCenter', 'imageStyle:alignBlockLeft', '|', 'toggleImageCaption', 'imageTextAlternative', 'resizeImage']
        },
    });
</script>
@endsection