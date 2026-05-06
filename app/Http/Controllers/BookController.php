<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookController extends Controller
{
  
    public function suggestions(Request $request)
    {
        $search = $request->q;

        // ambil buku
        $books = Book::where('name', 'like', "%{$search}%")
            ->limit(3)
            ->pluck('name');

        // ambil user
        $users = \App\Models\User::where('name', 'like', "%{$search}%")
            ->limit(2)
            ->pluck('name');

        // gabungin
        $results = $books->merge($users);

        return response()->json($results);
    }
    public function index()
    {
        $title = "book | index";
        $books = Book::latest()->paginate(9);

        return view('dashboard.book.index', compact('title', 'books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $isAdmin = $user && ($user->isAdmin ?? false);

        $categories = Category::all();
        $users = User::all();


        if ($isAdmin) {
            return view('dashboard.book.create', compact('categories', 'authors'));
        } else {
            return view('story.create', compact('categories')); // 🔥 view user
        }
    }

    /**
     * Store a newly created resource in storage.
     */
        public function store(Request $request)
        {
            $user = Auth::user();
            $isAdmin = $user && ($user->isAdmin ?? false);

            $rules = [
                'name' => 'required|max:255',
                'body' => 'required',
                'user' => 'required',
                'category_id' => 'required',
            ];

            if ($isAdmin) {
                $rules['slug'] = 'required|unique:books';
                $rules['user_id'] = 'required';                  
                $rules['cover'] = 'image|max:1024';
                $rules['published_at'] = 'date';
            }

            $validated = $request->validate($rules);

            // 🔥 AUTO TAMBAHAN
            $validated['user_id'] = $user->id;
            $validated['type'] = $isAdmin ? 'book' : 'story';

            // 🔥 FIX ERROR AUTHOR_ID
            if (!$isAdmin) {
                $validated['author_id'] = 1; // sementara pakai default author
                // atau nanti kita bikin author dari user
            }

            // 🔥 AUTO SLUG USER
            if (!$isAdmin) {
                $validated['slug'] = Str::slug($validated['name']) . '-' . time();
            }

            if ($request->hasFile('cover')) {
                $validated['cover'] = $request->file('cover')->store('cover-buku', 'public');
            }

            Book::create($validated);

            return redirect(
                $isAdmin ? '/dashboard/book' : '/profile'
            )->with('success', $isAdmin ? 'Book berhasil dibuat!' : 'Story berhasil dibuat!');
        }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

      public function edit(Book $book)
        {
            $title = "book | edit";
            $categories = Category::all();
            $users = User::all();
            
            return view('dashboard.book.edit', compact('title', 'book', 'categories', 'users'));
        }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $rules = [
           'name' => 'required | max:255',
            'cover' => 'image|file|max:1024',
            'body' => 'required',
            'published_at' => 'date',
            'category_id' => 'required',

            
        ];

    
        if ($request->slug != $book->slug){
            $rules['slug'] = 'required|unique:book';
        }

        $validatedData = $request->validate($rules);

        if ($request->hasFile('cover')) {
            if ($book->cover && Storage::disk('public')->exists($book->cover)) {
                Storage::disk('public')->delete($book->cover);
            }

            $validatedData['cover'] = $request->file('cover')->store('cover-buku', 'public');
        }

        Book::where('id', $book->id)->update($validatedData);

        return redirect('/dashboard/book')->with('success', 'Book has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        if ($book->cover && Storage::disk('public')->exists($book->cover)) {
             Storage::disk('public')->delete($book->cover);
        }

        Book::destroy($book->id);
        return redirect('/dashboard/book')->with('success', 'Data buku berhasil dihapus!');

    }

    

}
