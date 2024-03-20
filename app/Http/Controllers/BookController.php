<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::latest()->get();

        foreach ($books as $book) {
            $book->quantity = Book::where('title', $book->title)->count();
        }

        return view('content.books', compact('books'));
    }
}
