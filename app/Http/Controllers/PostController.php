<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{


    public function index()
    {

        $title = "";
        if (request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            $title = " in " . $category->name;
        }

        if (request('author')) {
            $author = User::firstWhere('username', request('author'));
            $title = " by " . $author->name;
        }
        return view("posts", [
            "title" => 'All Posts' . $title,
            "active" => "posts",
            // "posts" => Post::all()
            "posts" => Post::latest()->filter(request(['search', 'category', 'author']))->paginate(7)->withQueryString()

        ]);
    }

    public function show(Post $post)
    {
        return view("post", [
            "title" => "Single Post",
            "active" => "posts",

            "post" => $post
        ]);
    }

    public function storeRating(Request $request, Post $post)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $post->ratings()->create([
            'user_id' => auth()->id(),
            'rating' => $request->rating,
        ]);

        return back()->with('success', 'Rating has been added!');
    }
}
