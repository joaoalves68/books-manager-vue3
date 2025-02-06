<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\BooksController;
use App\Http\Controllers\Api\AuthorsController;

Route::get('/user', function (Request $request) {
  return $request->user();
})->middleware('auth:sanctum');

Route::resource('/books', BooksController::class);
Route::resource('/authors', AuthorsController::class);

Route::get('authors/{id}/books', [AuthorsController::class, 'getBooksAuthor']);
