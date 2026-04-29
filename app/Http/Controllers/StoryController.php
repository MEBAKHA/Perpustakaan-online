<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Category;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoryController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        $authors = Author::all(); // kalau dipakai juga

        return view('story.create', compact('categories', 'authors'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'cover' => 'image|max:2048'
        ]);

        if ($request->file('cover')) {
            $validated['cover'] = $request->file('cover')->store('stories', 'public');
        }

        $validated['user_id'] = Auth::id();

        Story::create($validated);

        return redirect()->route('profile')->with('success', 'Cerita berhasil dibuat!');
    }
}