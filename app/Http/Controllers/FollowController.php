<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FollowController extends Controller
{
    public function follow($id)
    {
        $user = Auth::user();

        if ($user->id == $id) {
            return back();
        }

        DB::table('follows')->updateOrInsert([
            'follower_id' => $user->id,
            'following_id' => $id
        ], [
            'follower_id' => $user->id,
            'following_id' => $id,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back();
    }

    public function unfollow($id)
    {
        $user = Auth::user();

        DB::table('follows')
            ->where('follower_id', $user->id)
            ->where('following_id', $id)
            ->delete();

        return back();
    }
}

