<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\Repost;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BorrowController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'description' => 'nullable|string|max:500',
        ]);

        $alreadyBorrowed = Borrow::where('user_id', $request->user_id)
            ->where('book_id', $request->book_id)
            ->exists();

        if ($alreadyBorrowed) {
            return redirect()->back()->with('error', 'Anda sudah memposting ulang buku ini.');
        }

        $borrowDate = Carbon::today();
        $dueDate = $borrowDate->copy()->addDays(7);

        Borrow::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'borrow_date' => $borrowDate,
            'due_date' => $dueDate,
            'status' => 'diajukan',
            'description' => $request->description,
        ]);

        $book = Book::find($request->book_id);
        $book->status = '1';
        $book->save();

        $user = User::find($request->user_id);

        return redirect()->route('borrows', $user->slug)->with('success', 'Data berhasil disimpan');
    }


   public function feed()
    {
        $title = 'Posting Ulang';

        $reposts = Repost::with(['user', 'book'])
            ->latest()
            ->paginate(10);

        return view('borrows', compact('title', 'reposts'));
    }
    public function userBorrows(User $user)
    {
        $title = $user->name . " borrows";
        $borrows = Borrow::with(['user', 'book', 'comments.user'])->where('user_id', $user->id)->latest()->paginate(10);
        return view('borrows', compact('title', 'borrows'));
    }

    public function cancel(Borrow $borrow)
    {
        if (! auth()->check() || auth()->id() !== $borrow->user_id) {
            abort(403);
        }

        $book = Book::find($borrow->book_id);
        $borrow->delete();

        if ($book && in_array($borrow->status, ['diajukan', 'dipinjam'])) {
            $remainingBorrows = Borrow::where('book_id', $book->id)->exists();
            $book->status = $remainingBorrows ? 1 : 0;
            $book->save();
        }

        return redirect()->route('borrows', auth()->user()->slug)->with('success', 'Posting ulang berhasil dibatalkan.');
    }

    public function comment(Request $request, Borrow $borrow)
    {
        $request->validate([
            'body' => 'required|string|max:500',
        ]);

        $borrow->comments()->create([
            'user_id' => auth()->id(),
            'body' => $request->body,
        ]);

        return redirect()->route('borrow.detail', $borrow)->with('success', 'Komentar berhasil dikirim.');
    }

    public function index()
    
    {
        $title = "Borrow - index";
        $borrows = Borrow::latest()->paginate(9);
        return view('dashboard.borrow.index', compact('title', 'borrows'));
    }

    public function edit(Borrow $borrow)
    {
        $title = "Borrow - edit";
        return view('dashboard.borrow.edit', compact('title', 'borrow'));
    }

       public function update(Request $request, Borrow $borrow)
    {
        $request->validate([
            'status' => 'required|in:diajukan,dipinjam,dikembalikan,ditolak',
            'message' => 'nullable|string|max:1000',
            'description' => 'nullable|string|max:500',
        ]);

        $borrow->status = $request->status;
        $borrow->description = $request->description;

        if ($request->filled('message')) {
            $borrow->message = $request->message;
        }

        $borrow->save();

        $book = Book::find($borrow->book_id);
        if ($request->status == 'diajukan' || $request->status == 'dipinjam') {
            $book->status = 1;
            $book->save();
        } elseif ($request->status == 'dikembalikan' || $request->status == 'ditolak') {
            $book->status = 0;
            $book->save();
        }

        return redirect('dashboard/borrow')->with('success', 'Data berhasil diupdate');
    }

    public function destroy(Borrow $borrow)
    {
        Borrow::destroy($borrow->id);
        return redirect('/dashboard/borrow')->with('success', 'Data berhasil dihapus');
    }

    public function detail(Borrow $borrow)
    {
        $borrow->load('comments.user');
        $title = "Detail Borrow";
        return view('borrow-detail', compact('title', 'borrow'));
    }
}