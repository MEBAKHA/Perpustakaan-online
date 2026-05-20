<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
class ProfileController extends Controller
{

    public function index()
    {

        $user = Auth::user(); // 🔥 WAJIB ADA
        return redirect()->route('profile', auth()->user()->username);

    }

    

    public function show($username, $name = null, $slug = null)
    {
        $user = User::where('username', $username)->firstOrFail(); // 🔥 WAJIB
        $title = $user->name . "'s Profile";
        $isFollowing = false;
        $canEdit = false;

        if (Auth::check()) {
            $authUser = Auth::user();
            $isFollowing = DB::table('follows')
                ->where('follower_id', $authUser->id)
                ->where('following_id', $user->id)
                ->exists();
            $canEdit = $authUser->id === $user->id;
        }

        return view('profile.profile', compact('user', 'title', 'isFollowing', 'canEdit'));
    }

    public function edit(){
        $title = "Profile - edit";
        return view('profile.edit', compact ('title'));
    }

    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!$user) {
            return redirect('/login');
        }

        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'bio' => 'nullable|string|max:500',
            'avatar' => 'nullable|image|max:5120',
            'banner' => 'nullable|image|max:10240',
        ]);

        $user->update($request->only(['username', 'email', 'bio']));

        if ($request->hasFile('avatar')) {
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            $user->avatar = $request->file('avatar')->store('avatars', 'public');
        }

        if ($request->hasFile('banner')) {
            if ($user->banner && Storage::disk('public')->exists($user->banner)) {
                Storage::disk('public')->delete($user->banner);
            }

            $user->banner = $request->file('banner')->store('banners', 'public');
        }

        $user->save();

        return redirect()->route('profile', $user->username)->with('success', 'Profile berhasil diupdate!');
        
 
    }

}