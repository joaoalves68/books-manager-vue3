<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\BooksController;
use App\Http\Controllers\Web\AuthorsController;

Route::resource('/books', BooksController::class);
Route::resource('/authors', AuthorsController::class);
