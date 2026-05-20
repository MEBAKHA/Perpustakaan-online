<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;
use App\Models\User;

class Borrow extends Model
{
    protected $guarded = ['id'];

    protected $with = ['book', 'user'];

    protected $casts = [
        'borrow_date' => 'datetime',
        'due_date' => 'datetime',
    ];

    public function book()
    {
       return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }
}

