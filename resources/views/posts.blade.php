@extends('layouts.main')

@section('container')
    <h1 class="mb-3 text-center">{{ $title }}</h1>

    <div class="row justify-content-center mb-3">
        <div class="col-md-6">
            <form action="/posts/" method="GET">
                @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                @if (request('author'))
                    <input type="hidden" name="author" value="{{ request('author') }}">
                @endif

                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search.." name="search"
                        value="{{ request('search') }}">
                    <button class="btn btn-warning text-white" type="submit">Search</button>
                </div>

            </form>
        </div>
    </div>


    @if ($posts->count())
        <div class="card mb-3">
            @if ($posts[0]->image)
                <div style="max-height: 350px; overflow:hidden;">
                    <img src="{{ asset('storage/' . $posts[0]->image) }}" alt="{{ $posts[0]->category->name }}"
                        class="img-fluid">
                </div>
            @else
                <img src="https://picsum.photos/1200/400/?{{ $posts[0]->category->name }}" class="card-img-top"
                    alt="{{ $posts[0]->category->name }}">
            @endif

            <div class="card-body text-center">

                <h3 class="card-title"><a href="/posts/{{ $posts[0]->slug }}"
                        class=" text-decoration-none text-dark">{{ $posts[0]->title }}</a>
                </h3>


                <p>
                    <small class="text-muted">
                        By. <a class="text-decoration-none"
                            href="/posts?author={{ $posts[0]->author->username }}">{{ $posts[0]->author->name }}</a>
                        in
                        <a class="text-decoration-none"
                            href="/posts?category={{ $posts[0]->category->slug }}">{{ $posts[0]->category->name }}</a>
                        {{ $posts[0]->created_at->diffForHumans() }}
                    </small>
                    <small class="text-muted ms-3"><i class="bi bi-chat-left"></i>
                        {{ $posts[0]->comments->count() }}</small>
                    @php
                        $averageRating = $posts[0]->ratings->avg('rating');
                    @endphp

                    @if ($averageRating)
                        <small class="text-muted ms-3">Rating:
                            {{ number_format($averageRating, 1) }}⭐</small>
                    @else
                        <small class="text-muted ms-3">not rated yet.</small>
                    @endif

                </p>

                <p class="card-text">{{ $posts[0]->excerpt }}</p>

                <a class="text-decoration-none btn btn-primary" href="/posts/{{ $posts[0]->slug }}">Read more &raquo;</a>

            </div>
        </div>




        <div class="container">
            <div class="row">
                @foreach ($posts->skip(1) as $post)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="position-absolute px-3 py-2" style="background-color: rgba(0, 0, 0, 0.7) ">
                                <a href="/posts?category={{ $post->category->slug }}"
                                    class="text-decoration-none text-white">{{ $post->category->name }}</a>
                            </div>
                            @if ($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}"
                                    class="img-fluid">
                            @else
                                <img src="https://picsum.photos/500/400?{{ $post->category->name }}" class="card-img-top"
                                    alt="{{ $post->category->name }}">
                            @endif

                            <div class="card-body">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p>
                                    <small class="text-muted">
                                        By. <a class="text-decoration-none"
                                            href="/posts?author={{ $post->author->username }}">{{ $post->author->name }}</a>

                                        {{ $post->created_at->diffForHumans() }}
                                    </small>
                                    <small class="text-muted ms-3"><i class="bi bi-chat-left"></i>
                                        {{ $post->comments->count() }}</small>
                                    @php
                                        $averageRating = $post->ratings->avg('rating');
                                    @endphp

                                    @if ($averageRating)
                                        <small class="text-muted ms-3">Rating:
                                            {{ number_format($averageRating, 1) }}⭐</small>
                                    @else
                                        <small class="text-muted ms-3">not rated yet.</small>
                                    @endif
                                </p>
                                <p class="card-text">{{ $post->excerpt }}</p>
                                <a href="/posts/{{ $post->slug }}" class="btn btn-primary">Read more &raquo;</a>
                            </div>
                        </div>


                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center fs-4">No post found.</p>
    @endif


    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
    </div>


@endsection
