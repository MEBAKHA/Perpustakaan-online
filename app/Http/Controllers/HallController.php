<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\Request;

class HallController extends Controller
{
public function index(Request $request)
{
    $title = 'Hall';

    // 🔵 SEMUA DATA (BOOK + STORY)
    $feed = Book::latest()
        ->search($request->only(['search', 'category', 'user']))
        ->get()
        ->sortByDesc('created_at')
        ->values();

    return view('hall', compact('title', 'feed'));
}

    public function singleBook(Book $book)
    {
        $title = $book->name;
        // Eager-load borrows with user to avoid querying in the view
        $book->load('borrows.user', 'user', 'category', 'author');
        return view('book', compact('title', 'book'));
    }

    
}