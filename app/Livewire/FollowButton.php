<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowButton extends Component
{
    public User $user;
    public bool $isFollowing = false;

    public function mount(User $user)
    {
        $this->user = $user;

        if (Auth::check()) {
            $this->isFollowing = Auth::user()
                ->following()
                ->where('following_id', $user->id)
                ->exists();
        }
    }

    public function follow()
    {
        auth()->user()
            ->following()
            ->syncWithoutDetaching([$this->user->id]);

        $this->isFollowing = true;

        logger('isFollowing = ' . ($this->isFollowing ? 'true' : 'false'));
    }

    public function unfollow()
    {
        auth()->user()
            ->following()
            ->detach($this->user->id);

        $this->isFollowing = false;

        logger('isFollowing = ' . ($this->isFollowing ? 'true' : 'false'));
    }

    public function render()
    {
        return view('livewire.follow-button');
    }
}
