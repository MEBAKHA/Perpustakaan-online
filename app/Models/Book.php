<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    protected $with = ['author', 'category'];

    #[Scope]
    protected function search(Builder $query, $filters) {
        $query->when(
            $filters['search'] ?? false,
            fn ($query, $search) => 
            $query->where('name', 'like', '%' . $search . '%' )
        );

        $query->when(
            $filters['category'] ?? false,
            fn ($query, $category) => 
            $query->whereHas('category', fn($query) => $query->where('slug', $category))
        );

        $query->when(
            $filters['author'] ?? false,
            fn ($query, $author) => 
            $query->whereHas('author', fn($query) => $query->where('slug', $author))
        );
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
