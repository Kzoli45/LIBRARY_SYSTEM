<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Routing\RedirectController;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $books = Book::select('title', 'author', 'year',  DB::raw('COUNT(*) as quantity'))
            ->groupBy('title', 'author', 'year')
            ->latest()
            ->where('deleted', 0)
            ->filters($request->all())
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
            ->where('deleted', 0)
            ->firstOrFail();

        $copies = Book::where('author', $author)
            ->where('title', $title)
            ->where('year', $year)
            ->where('deleted', 0)
            ->get();

        return view('content.manage', compact('books', 'copies'));
    }

    public function showEdit(Book $book)
    {
        return view('content.edit', ['book' => $book]);
    }

    public function editBook(Request $request, Book $book)
    {
        $formFields = $request->validate([
            'author' => 'required',
            'title' => 'required',
            'publisher' => 'required',
            'year' => ['required', 'numeric'],
            'release' => ['required', 'numeric'],
            'ISBN' => ['required', 'numeric', 'digits:8'],
            'takeable' => 'required'
        ]);

        $book->update($formFields);
        return redirect(route('manage.book', ['author' => $book->author, 'title' => $book->title, 'year' => $book->year]));
    }

    public function destroy(Book $book)
    {
        if ($book->takeable == 0) {
            return back()->with('error', 'Only books that are currently available can be deleted!');
        } else {
            $book->update(['deleted' => 1]);
            return redirect('/books');
        }
    }

    public function destroyAll(Request $request)
    {
        $title = $request->input('title');
        $author = $request->input('author');
        $year = $request->input('year');

        $countBooksToDelete = Book::where('author', $author)
            ->where('title', $title)
            ->where('year', $year)
            ->where('takeable', 1)
            ->count();

        if ($countBooksToDelete == 0) {
            return back()->with('error', 'Only books that are currently available can be deleted!');
        } else {
            Book::where('author', $author)
                ->where('title', $title)
                ->where('year', $year)
                ->where('takeable', 1)
                ->update(['deleted' => 1]);

            return redirect('/books');
        }
    }
}
