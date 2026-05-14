<?php

namespace App\Http\Livewire;

use App\Models\Book;
use App\Models\Borrow;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddBorrow extends Component
{
    public int $bookId;
    public Book $book;
    public string $successMessage = '';

    public function mount(int $bookId)
    {
        $this->bookId = $bookId;
        $this->book = Book::findOrFail($bookId);
    }

    public function borrowBook()
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        if ($this->book->status == 1) {
            $this->successMessage = 'Maaf, buku sedang tidak tersedia.';
            return;
        }

        Borrow::create([
            'user_id' => Auth::id(),
            'book_id' => $this->book->id,
            'borrow_date' => now(),
            'due_date' => now()->addDays(7),
            'status' => 'diajukan',
        ]);

        $this->book->status = 1;
        $this->book->save();
        $this->book->refresh();

        $this->successMessage = 'Permintaan pinjam berhasil dikirim.';
    }

    public function render()
    {
        return view('livewire.add-borrow');
    }
}
