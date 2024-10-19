@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2 class="h2">{{ $post->title }}</h2>
    </div>


    <article class="col-lg-8">
        <div class="mb-3">
            <a href="/dashboard/posts" class="btn btn-success"><span data-feather="arrow-left"></span> &laquo; Back to My
                Posts</a>
            <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning"><span class="bi bi-pencil"></span>
                Edit</a>
            <form class="d-inline" action="/dashboard/posts/{{ $post->slug }}" method="POST">
                @method('delete')
                @csrf
                <button class="btn btn-danger" onclick="return confirm('Are You Sure?')"><i
                        class="bi bi-trash"></i>Delete</button>
            </form>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <h3 class="card-title">{{ $post->title }}</h3>
                @if ($post->image)
                    <div style="max-height: 350px; overflow:hidden;">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}"
                            class="img-fluid">
                    </div>
                @else
                    <img src="https://picsum.photos/1200/400?{{ $post->category->name }}" alt="{{ $post->category->name }}"
                        class="img-fluid">
                @endif


                <p class="card-text">{!! $post->body !!}</p>

            </div>
        </div>
    </article>
@endsection
