<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\BooksController;
use App\Http\Controllers\Web\AuthorsController;
use App\Http\Controllers\Auth\AuthController;

Route::middleware('auth')->group(function () {
  Route::get('/', function () {
    return view('dashboard');
  })->name('dashboard');

  Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

  Route::resource('/authors', AuthorsController::class);
  Route::resource('/books', BooksController::class);
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
