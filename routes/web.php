<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
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

// Show login

Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// Log user in

Route::post('/users/authenticate', [UserController::class, 'authenticate']);

// Log user out

Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');
