<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Story;
use Illuminate\Http\Request;

class HallController extends Controller
{
public function index(Request $request)
{
    $title = 'Hall';

    // 🔵 SEMUA DATA (BOOK + STORY)
    $feed = Book::latest()
        ->search($request->only(['search', 'category', 'author']))
        ->get()
        ->sortByDesc('created_at')
        ->values();

    return view('hall', compact('title', 'feed'));
}

    public function singleBook(Book $book)
    {
        $title = $book->name;
        return view('book', compact('title', 'book'));
    }

    
}