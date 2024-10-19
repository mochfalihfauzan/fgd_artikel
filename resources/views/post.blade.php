@extends('layouts.main')

@section('container')
    <div class="containe">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <h1 class="mb-3">{{ $post->title }}</h1>
                <p>By. <a class="text-decoration-none"
                        href="/posts?author={{ $post->author->username }}">{{ $post->author->name }}</a> in
                    <a class="text-decoration-none"
                        href="/posts?category={{ $post->category->slug }}">{{ $post->category->name }}</a>
                </p>
                @if ($post->image)
                    <div style="max-height: 350px; overflow:hidden;">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}"
                            class="img-fluid">
                    </div>
                @else
                    <img src="https://picsum.photos/1200/400/?{{ $post->category->name }}" alt="{{ $post->category->name }}"
                        class="img-fluid">
                @endif


                <article class="my-3 fs-5">
                    {!! $post->body !!}
                </article>

                </article>
                <a href="/posts" class="d-block mt-4">&laquo; Back to posts</a>
                <hr>
                <div>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @php
                        $userRating = $post->ratings->where('user_id', auth()->id())->first();
                    @endphp

                    @if ($userRating)
                        <p class="fw-bold">You have already rated this post: {{ $userRating->rating }}/5</p>
                    @else
                        <form action="{{ route('posts.ratings.store', $post) }}" method="POST">
                            @csrf
                            <label for="rating" class="fw-bold">Rate this post:</label>
                            <select name="rating" id="rating" class="form-select">
                                <option value="1">1 (Very Poor)</option>
                                <option value="2">2 (Poor)</option>
                                <option value="3">3 (Average)</option>
                                <option value="4">4 (Good)</option>
                                <option value="5" selected>5 (Excellent)</option>
                            </select>
                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        </form>
                    @endif
                    <!-- Menampilkan rata-rata rating -->
                    @php
                        $averageRating = $post->ratings->avg('rating');
                    @endphp

                    @if ($averageRating)
                        <p class="fw-bold h3 mt-3">Rating: {{ $averageRating . '/5' }}</p>
                    @else
                        <p class="fw-bold h3 mt-3">This blog has not been rated yet.</p>
                    @endif
                </div>
                <hr>
                <div class="mt-5">
                    @auth
                        <form action="/comments" method="POST">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <div class="mb-3">
                                <label for="body" class="form-label"><strong>Add a comment</strong></label>
                                <textarea class="form-control @error('body') is-invalid @enderror" id="body" name="body" rows="3"
                                    required></textarea>
                                @error('body')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    @else
                        <p>Please <a href="/login">login</a> to add a comment.</p>
                    @endauth
                    <div class="mt-3">
                        <h3>Comments ({{ $post->comments->count() }})</h3>
                        @foreach ($post->comments as $comment)
                            <div class="mb-3">
                                <strong>{{ $comment->user->name }}</strong> said:
                                <p>"{{ $comment->body }}"</p>
                                <small>{{ $comment->created_at->diffForHumans() }}</small>
                                <hr>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
    <article>
    @endsection
