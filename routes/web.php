<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\DashboardPostController;
use App\Models\Comment;
use App\Models\Rating;

Route::get('/', function () {
    return view('home', [
        'title' => 'Home',
        //mengambil 5 data dari model Post terbaru
        'posts' => Post::latest()->take(5)->get()
    ]);
});


Route::get('/about', function () {
    return view('about', [
        'title' => 'About',
        'name' => 'Moch Falih Fauzan',
        'email' => 'falihfauzan2002@gmail.com',
        'image' => 'falih.jpg'

    ]);
});




Route::get('/posts', [PostController::class, 'index']);

//halaman single post

Route::get("posts/{post:slug}", [PostController::class, 'show']);

Route::get('/categories', function () {
    return view('categories', [
        'title' => 'Post Categories',
        'categories' => Category::all(),
    ]);
});


Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', function () {
    $ratings = Post::where('user_id', auth()->user()->id)->get()->pluck('ratings')->flatten();
    $totalRating = 0;
    foreach ($ratings as $rating) {
        $totalRating += $rating->rating;
    }
    if (count($ratings) == 0) {
        $totalRating = 0;
    } else {
        $totalRating = $totalRating / count($ratings);
    }

    $posts = Post::where('user_id', auth()->user()->id)->get();
    $comments = Post::where('user_id', auth()->user()->id)->get()->pluck('comments')->flatten();


    return view(
        'dashboard.index',
        [
            'posts' => $posts,
            'comments' => $comments,
            'totalRating' => $totalRating,
        ]
    );
})->middleware('auth');


Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])->middleware('auth');

Route::resource('dashboard/posts', DashboardPostController::class)->middleware('auth');

Route::get('/dashboard/categories/checkSlug', [AdminCategoryController::class, 'checkSlug'])->middleware('auth');
Route::resource('dashboard/categories', AdminCategoryController::class)->except('show')
    ->middleware('admin');

Route::post('/comments', [CommentController::class, 'store'])->middleware('auth');

Route::post('/posts/{post}/ratings', [PostController::class, 'storeRating'])->name('posts.ratings.store');
