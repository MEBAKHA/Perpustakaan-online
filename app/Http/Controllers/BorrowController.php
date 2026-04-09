<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BorrowController extends Controller
{
    public function store(Request $request)
    {
        //return dd($request->all());
        $borrowDate = Carbon::today();
        $dueDate = $borrowDate->copy()->addDays(7);

        Borrow::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'borrow_date' => $borrowDate,
            'due_date' => $dueDate,
            'status' => 'diajukan'
        ]);

        $book = Book::find($request->book_id);
        $book->status = '1';
        $book->save();

        return redirect('/');
    }

}
