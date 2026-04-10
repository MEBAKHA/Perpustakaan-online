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
       $borrow->status = $request->status;
       $borrow->save();
       
       $book = Book::find($borrow->book_id);
       if ($request->status == 'diajukan' || $request->status == 'dipinjam') {

       $book->status = 1;
       $book->save();
       }elseif($request->status == 'dikembalikan' || $request->status == 'ditolak') {
           $book->status = 0;
           $book->save();
       }

       return redirect ('dashboard/borrow')->with('success', 'Data berhasil diupdate');
       
    }

    public function destroy(Borrow $borrow)
    {
        Borrow::destroy($borrow->id);
        return redirect ('/dashboard/borrow')->with('success', 'Data berhasil dihapus');
    }
}   