<?php
// app/Http/Controllers/BorrowController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrow;
use App\Models\Book;
use App\Models\Member;

class BorrowController extends Controller {
    public function showBorrowPage() {
        return view('books.borrows');
    }

    public function borrow(Request $request){
        $request->validate([
            'member_id'=>'required|exists:members,id',
            'book_id'=>'required|exists:books,id',
            'quantity'=>'required|integer|min:1'
        ]);

        $book = Book::findOrFail($request->book_id);
        if($book->quantity < $request->quantity){
            return response()->json(['success'=>false,'message'=>'Not enough books available']);
        }

        Borrow::create([
            'member_id'=>$request->member_id,
            'book_id'=>$request->book_id,
            'quantity'=>$request->quantity,
        ]);

        $book->decrement('quantity', $request->quantity);

        return response()->json(['success'=>true,'message'=>'Book borrowed successfully']);
    }

    public function showBorrows() {
        $borrows = Borrow::with('member','book')->get();
        return response()->json(['success'=>true,'borrows'=>$borrows]);
    }

    public function returnBook(Request $request,$id){
        $borrow = Borrow::findOrFail($id);
        $borrow->update(['status'=>'returned','return_date'=>now()]);
        $borrow->book->increment('quantity',$borrow->quantity);
        return response()->json(['success'=>true,'message'=>'Book returned successfully']);
    }
}
