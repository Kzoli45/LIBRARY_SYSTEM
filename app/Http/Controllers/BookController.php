<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::latest()->get();

        foreach ($books as $book) {
            $book->quantity = Book::where('title', $book->title)
                ->where('author', $book->author)
                ->count();
        }

        return view('content.books', compact('books'));
    }

    public function showBookCreate()
    {
        return view('content.create');
    }

    public function storeNewBook(Request $request)
    {
        $formFields = $request->validate([
            'author' => 'required',
            'title' => 'required',
            'publisher' => 'required',
            'year' => ['required', 'numeric'],
            'release' => ['required', 'numeric'],
            'ISBN' => ['required', 'numeric', Rule::unique('books', 'ISBN'), 'digits:8'],
            'takeable' => 'required'
        ]);

        Book::create($formFields);
        return redirect('/books');
    }
}
