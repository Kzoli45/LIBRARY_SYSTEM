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

// Show login

Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// Log user in

Route::post('/users/authenticate', [UserController::class, 'authenticate']);

// Log user out

Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');
