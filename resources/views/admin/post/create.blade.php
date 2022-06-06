@extends('layouts.admin_layout')

@section('content')
    <h3>New Post</h3>
    @if (session("status"))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('status') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="py-2" id="post-form">
        <form action="{{ route("post.store") }}" id="post-form-validation" method="POST" enctype="multipart/form-data">
            @csrf
            <x-input-error name="title">
                <input class="form-control" id="title" type="text" name="title" placeholder="Title Here....">
            </x-input-error>
            <x-input-error name="category_id">
                <select class="form-select mb-2" name="category_id" id="category">
                    <option selected value="">Select Category....</option>
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?= $category->id ?>"> <?= $category->name ?> </option>
                    <?php endforeach; ?>
                </select>
            </x-input-error>
            <x-input-error name="image">
                <input type="file" name="image" id="image" class="form-control mb-2" accept="image/gif, image/jpeg, image/png">
            </x-input-error>
            <x-input-error name="content">
                <textarea class="form-control" name="content" id="editor" cols="30" rows="10"></textarea>
            </x-input-error>
            <button class="btn btn-primary mt-2">Submit</button>
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