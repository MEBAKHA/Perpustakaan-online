<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Notifications\Notifiable;
    use Laravel\Sanctum\HasApiTokens;

    class User extends Authenticatable
    {
        /** @use HasFactory<\Database\Factories\UserFactory> */
        use HasFactory, Notifiable, HasApiTokens;

        /**
         * The attributes that are mass assignable.
         *
         * @var list<string>
         */
        protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
        public function getAuthIdentifierName()
    {
        return 'username';
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'follower_id');
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id');
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }
        public function stories()
    {
        return $this->hasMany(Book::class)->where('type', 'story');
    }
}
