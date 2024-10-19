@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Welcome Back, {{ auth()->user()->name }}</h1>
    </div>
    <div class="row mb-5">
        <div class="col-8 col-md-4 mx-auto">
            <div class="border px-4 py-3 rounded-3 mb-3 bg-success text-white shadow" style="height: 10rem">
                <p class="fs-5 mb-0">Artikel</p>
                <p class="h2">{{ $posts->count() }}</p>
                <div class="d-flex justify-content-end">
                    <a href="" class="btn btn-warning shadow fw-bold m-0">Detail</a>
                </div>
            </div>
        </div>
        <div class="col-8 col-md-4 mx-auto">
            <div class="border px-4 py-3 rounded-3 mb-3 bg-secondary text-white shadow" style="height: 10rem">
                <p class="fs-5 mb-0">Comments</p>
                <p class="h2">{{ $comments->count() }}</p>
            </div>
        </div>
        <div class="col-8 col-md-4 mx-auto">
            <div class="border px-4 py-3 rounded-3 mb-3 bg-primary text-white shadow" style="height: 10rem">
                <p class="fs-5 mb-0">Ratings</p>
                <p class="h2">{{ number_format($totalRating, 1) }}⭐</p>
            </div>
        </div>
    </div>
    <h2 class="mb-4">Your Posts</h2>
    <div class="row">
        @foreach ($posts as $post)
            <div class="col-md-4">
                <div class="card mb-3 col-gap-3 shadow">
                    <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="..."
                        style="height: 15rem">
                    <div class="card-header">
                        {{ $post->title }}
                    </div>
                    <div class="card-body">
                        <a href="/dashboard/posts/{{ $post->slug }}" class="btn btn-primary">Read More</a>
                    </div>
                    <div class="card-footer text-muted">
                        <p class="fw-bold"><a href="/dashboard/categories/{{ $post->category->slug }}"
                                class="icon-link-hover" class="text-decoration-none">{{ $post->category->name }}</a></p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
