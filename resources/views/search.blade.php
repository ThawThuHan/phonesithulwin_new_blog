@extends("layouts.master")

@section('title', 'Search')

@section('css')
    <style>
        .sub-title {
            color: white;
            text-shadow: 2px 2px 4px #000000;
        }

        .error {
            height: 300px;
        }
    </style>
@endsection

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 sub-title">Search Result: {{$search}} </h2>
        @if (count($posts) > 0)
            <div class="row mb-0 mb-md-4">
            @foreach ($posts as $post)
                <div class="col-12 col-md-6 col-lg-4 mb-3">
                    <x-post-card :post="$post" />
                </div>
            @endforeach
        @else
            <div class="error d-flex align-items-center justify-content-center">
                <h1>No Result Found!</h1>
            </div>
        @endif
        {{-- <div>{{ $posts->links() }}</div> --}}
    </div>
</div>
@endsection