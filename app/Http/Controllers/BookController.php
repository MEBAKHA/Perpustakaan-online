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
        $users = User::where('name', 'like', "%{$search}%")
            ->limit(2)
            ->pluck('name');

        // gabungin
        $results = $books->merge($users);

        return response()->json($results);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "book | index";
        $categories = Category::all();

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

        // ADMIN
        if ($isAdmin) {
            return view('dashboard.book.create', compact('categories', 'users'));
        }

        // USER
        return view('story.create', compact('categories'));
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
            'category_id' => 'required',
        ];

        // VALIDASI KHUSUS ADMIN
        if ($isAdmin) {
            $rules['slug'] = 'required|unique:books';
            $rules['user_id'] = 'required';
            $rules['cover'] = 'image|max:1024';
            $rules['published_at'] = 'date';
        }

        $validated = $request->validate($rules);

        // AUTO USER LOGIN
        $validated['user_id'] = $user->id;

        // TYPE
        $validated['type'] = $isAdmin ? 'book' : 'story';

        // AUTHOR DEFAULT UNTUK STORY
        if (!$isAdmin) {
            $validated['author_id'] = 1;
        }

        // AUTO SLUG UNTUK STORY
        if (!$isAdmin) {
            $validated['slug'] = Str::slug($validated['name']) . '-' . time();
        }

        // UPLOAD COVER
        if ($request->hasFile('cover')) {
            $validated['cover'] = $request->file('cover')->store('cover-buku', 'public');
        }

        // SIMPAN DATA
        Book::create($validated);

        // REDIRECT
        if ($isAdmin) {
            return redirect('/dashboard/book')
                ->with('success', 'Book berhasil dibuat!');
        }

        return redirect('/hall')
            ->with('success', 'Story berhasil dibuat!');
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
        $user = Auth::user();
        $isAdmin = $user && ($user->isAdmin ?? false);

        // CEK KEPEMILIKAN STORY
        if (!$isAdmin && $book->user_id !== $user->id) {
            abort(403);
        }

        $categories = Category::all();
        $users = User::all();

        // ADMIN
        if ($isAdmin) {
            return view('dashboard.book.edit', compact('book', 'categories', 'users'));
        }

        // USER
        return view('story.edit', compact('book', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $user = Auth::user();
        $isAdmin = $user && ($user->isAdmin ?? false);

        // CEK KEPEMILIKAN STORY
        if (!$isAdmin && $book->user_id !== $user->id) {
            abort(403);
        }

        $rules = [
            'name' => 'required|max:255',
            'body' => 'required',
            'category_id' => 'required',
        ];

        // VALIDASI KHUSUS ADMIN
        if ($isAdmin) {

            $rules['cover'] = 'image|file|max:1024';
            $rules['published_at'] = 'date';

            if ($request->slug != $book->slug) {
                $rules['slug'] = 'required|unique:books';
            }
        }

        $validatedData = $request->validate($rules);

        // UPLOAD COVER
        if ($request->hasFile('cover')) {

            // HAPUS COVER LAMA
            if ($book->cover && Storage::disk('public')->exists($book->cover)) {
                Storage::disk('public')->delete($book->cover);
            }

            $validatedData['cover'] = $request->file('cover')->store('cover-buku', 'public');
        }

        // UPDATE DATA
        $book->update($validatedData);

        // REDIRECT
        if ($isAdmin) {
            return redirect('/dashboard/book')
                ->with('success', 'Book berhasil diupdate!');
        }

        return redirect('/profile/' . $book->user->username)
            ->with('success', 'Story berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $user = Auth::user();
        $isAdmin = $user && ($user->isAdmin ?? false);

        // CEK KEPEMILIKAN STORY
        if (!$isAdmin && $book->user_id !== $user->id) {
            abort(403);
        }

        // HAPUS COVER
        if ($book->cover && Storage::disk('public')->exists($book->cover)) {
            Storage::disk('public')->delete($book->cover);
        }

        // HAPUS DATA
        $book->delete();

        // REDIRECT
        if ($isAdmin) {
            return redirect('/dashboard/book')
                ->with('success', 'Book berhasil dihapus!');
        }

        return redirect('/profile/' . $book->user->username)
            ->with('success', 'Story berhasil dihapus!');
    }
}