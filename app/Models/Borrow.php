<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    protected $guarded = ['id'];

    protected $with = ['book', 'user'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function book()
    {
       return $this->belongsTo( Book::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
