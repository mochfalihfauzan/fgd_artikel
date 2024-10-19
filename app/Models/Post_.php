<?php

namespace App\Models;


class Post
{
    private static $blog_posts = [
        [
            "title" => "Judul Post Pertama",
            "slug" => "judul-post-pertama",
            "author" => "Moch Falih Fauzan",
            "body" => "Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore
             et dolore magna aliqua. Ut enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip ex
            ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugia
            t nulla pariatur."
        ],
        [
            "title" => "Judul Post Fauzan",
            "slug" => "judul-post-kedua",
            "author" => "Ilham Surya",
            "body" => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vel, accusantium consequatur
            voluptatum odio perspiciatis repellat quibusdam. Odio quod doloribus repudiandae repellat! Veniam, libero?
            Quibusdam optio nam ratione maxime error magni et dicta aliquid sapiente? Voluptates molestias architecto
            sint fuga quidem optio deleniti eos nostrum labore dolore. Maxime modi velit vel fuga eaque voluptates 
            cupiditate nobis tempore laboriosam aliquam odio aperiam, perspiciatis quas maiores nesciunt expedita 
            accusantium quisquam ut eligendi dolorum accusamus inventore. Fugit, sunt. Reprehenderit repellat optio, eum 
            tenetur quasi illo alias. Debitis quibusdam doloremque, harum cum eveniet totam blanditiis repellendus mollitia 
            assumenda corporis quis optio officiis facilis. Nisi, ipsa."
        ],

    ];

    public static function all()
    {
        return collect(self::$blog_posts);
    }

    public static function find($slug)
    {
        $posts = static::all();

        return $posts->firstWhere('slug', $slug);
    }
}
