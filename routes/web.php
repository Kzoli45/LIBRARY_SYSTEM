<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserController;
use Database\Factories\MemberFactory;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Homepage

Route::get('/', [HomeController::class, 'home'])->middleware('auth');

// Books home page

Route::get('/books', [BookController::class, 'index'])->middleware('auth');

// Show createbook form

Route::get('/books/create', [BookController::class, 'showBookCreate'])->middleware('auth');

// Store new book

Route::post('/books/new', [BookController::class, 'storeNewBook'])->middleware('auth');

// Show single book

Route::get('/books/manage', [BookController::class, 'showManage'])->middleware('auth')->name('manage.book');

// Show Edit form

Route::get('/books/{book}/edit', [BookController::class, 'showEdit'])->middleware('auth');

// Edit Book

Route::patch('/books/{book}', [BookController::class, 'editBook'])->middleware(('auth'));

// Delete book

Route::delete('/books/{book}', [BookController::class, 'destroy'])->middleware('auth');

// Delete All
Route::delete('/books/delete/{book}', [BookController::class, 'destroyAll'])->middleware('auth')->name('books.delete');

// show members

Route::get('/members', [MemberController::class, 'index'])->middleware('auth');

// Show Members Create form

Route::get('/members/create', [MemberController::class, 'showCreateForm'])->middleware('auth');

// Store new member

Route::post('/members/new', [MemberController::class, 'storeNewMember'])->middleware('auth');

// Show single member

Route::get('/members/{member}', [MemberController::class, 'show'])->middleware('auth');

// Show member edit form

Route::get('/members/{member}/edit', [MemberController::class, 'showEditForm'])->middleware('auth');

// Edit Member

Route::patch('/members/{member}', [MemberController::class, 'update'])->middleware('auth');

// Show members for assign

Route::get('/books/{books}/assign', [MemberController::class, 'showAssign'])->middleware('auth');

// show assign form

Route::get('/books/{bookId}/assign/{memberId}/loan', [MemberController::class, 'showAssignForm'])->name('show.assign.form')->middleware('auth');

//Delete Member

Route::delete('/members/{member}', [MemberController::class, 'destroy'])->middleware('auth');

// Register loan

Route::post('/lending/{book}/{member}', [MemberController::class, 'store'])->name('lending.store')->middleware('auth');

// Show login

Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// Log user in

Route::post('/users/authenticate', [UserController::class, 'authenticate']);

// Log user out

Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');
