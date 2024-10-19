<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory,
        Sluggable;


    // protected $fillable = [
    //     'title',
    //     'excerpt',
    //     'body'
    // ];
    protected $guarded = ['id'];
    protected $with = ['author', 'category'];    //use eager loading

    public function scopeFilter($query, array $filters)
    {


        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%');
        });

        $query->when($filters['category'] ?? false, function ($query, $category) {
            return $query->whereHas('category', function ($query) use ($category) {
                $query->where('slug', $category);
            });
        });

        $query->when(
            $filters['author'] ?? false,
            fn($query, $author)
            => $query->whereHas(
                'author',
                fn($query) =>
                $query->where('username', $author)

            )
        );
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()    //user_id di ganti author
    {
        return $this->belongsTo(User::class, 'user_id');    //author menjadi alias dari user
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // sluggable
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
