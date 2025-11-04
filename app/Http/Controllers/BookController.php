<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function showBooks() {
        return view('books.books');
    }

    public function register(Request $request) {
        $request->validate([
            'title' => 'required|min:2|max:100',
            'author' => 'required|min:3|max:50',
            'genre' => 'required',
            'quantity' => 'required|integer|min:0',
        ]);

        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'genre' => $request->genre,
            'quantity' => $request->quantity,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Book added successfully'
        ]);
    }

    public function show() {
        $books = Book::all();
        return response()->json([
            'success' => true,
            'books' => $books,
        ]);
    }

    public function update(Request $request, $id) {
        $book = Book::findOrFail($id);

        $book->update([
            'title' => $request->title,
            'author' => $request->author,
            'genre' => $request->genre,
            'quantity' => $request->quantity,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Book updated successfully'
        ]);
    }

    public function destroy($id) {
        $book = Book::findOrFail($id);
        $book->delete();

        return response()->json([
            'success' => true,
            'message' => 'Book deleted successfully'
        ]);
    }

        public function filter(Request $request){
        $search = $request->input('search');
        $genre = $request->input('genre');

        $query = Book::query();

        if ($search) {
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('author', 'like', "%{$search}%");
        }

        if ($genre && $genre !== 'all') {
            $query->where('genre', $genre);
        }

        $books = $query->get();

        return response()->json([
            'success' => true,
            'books' => $books,
        ]);
    }

    public function showGenre(){
        $genres = Book::select('genre')
                ->distinct()
                ->orderBy('genre', 'asc')
                ->pluck('genre');

        return response()->json([
            'success' => true,
            'genres' => $genres
        ]);
    }

}
