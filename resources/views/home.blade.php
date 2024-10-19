@extends('layouts.main')

@section('container')
    <h2>Halaman {{ $title }}</h2>
    @if ($posts->count())
        @foreach ($posts as $post)
            <div class="card mb-3 shadow">
                @if ($post->image)
                    <div style="max-height: 350px; overflow:hidden;">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}" class="img-fluid">
                    </div>
                @else
                    <img src="https://picsum.photos/1200/400/?{{ $post->category->name }}" class="card-img-top"
                        alt="{{ $post->category->name }}">
                @endif

                <div class="card-body text-center">

                    <h3 class="card-title"><a href="/posts/{{ $post->slug }}"
                            class=" text-decoration-none text-dark">{{ $post->title }}</a>
                    </h3>


                    <p>
                        <small class="text-muted">
                            By. <a class="text-decoration-none"
                                href="/posts?author={{ $post->author->username }}">{{ $post->author->name }}</a>
                            in
                            <a class="text-decoration-none"
                                href="/posts?category={{ $post->category->slug }}">{{ $post->category->name }}</a>
                            {{ $post->created_at->diffForHumans() }}
                        </small>
                    </p>

                    <p class="card-text">{{ $post->excerpt }}</p>

                    <a class="text-decoration-none btn btn-primary" href="/posts/{{ $post->slug }}">Read more
                        &raquo;</a>

                </div>
            </div>
        @endforeach
        <div class="my-5 text-center">
            <a href="/posts" type="button" class="btn btn-primary">Selengkapnya...</a>
        </div>
    @else
        <div class="container">
            <p class="text-center fs-4">No post found.</p>
        </div>
    @endif
@endsection
