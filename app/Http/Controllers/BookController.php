<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::select('title', 'author', 'year',  DB::raw('COUNT(*) as quantity'))
            ->groupBy('title', 'author', 'year')
            ->latest()
            ->get();

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

    public function showManage(Request $request)
    {
        $author = $request->input('author');
        $title = $request->input('title');
        $year = $request->input('year');

        $books = Book::where('author', $author)
            ->where('title', $title)
            ->where('year', $year)
            ->firstOrFail();

        $copies = Book::where('author', $author)
            ->where('title', $title)
            ->where('year', $year)
            ->get();

        return view('content.manage', compact('books', 'copies'));
    }
}
