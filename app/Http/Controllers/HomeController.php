<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $title = "Homepage";
        $books = Book::latest('published_at')->take(3)->get();

        $color = [
            'bg-sky-100 text-sky-500',
            'bg-yellow-100 text-yellow-500',
            'bg-red-100 text-red-500',
            'bg-green-100 text-green-500',
            'bg-teal-100 text-teal-500',
            'bg-indigo-100 text-indigo-500',
            'bg-stone-100 text-stone-500',
            'bg-orange-100 text-orange-500',
        ];

        foreach ($books as $book) {
            $categoryId = $book->category->id;
            $colorIndex = $categoryId % count($color);
            $book->category_color = $color[$colorIndex];
        }

        // return dd('books');
        return view('homepage', compact('title', 'books'));
    }
}
