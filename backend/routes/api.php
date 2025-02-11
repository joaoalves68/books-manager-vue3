<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\BooksController;
use App\Http\Controllers\Api\AuthorsController;
use App\Http\Controllers\Api\UsersController;

use App\Models\User;

Route::post('/login', [UsersController::class, 'login']);
Route::post('/register', [UsersController::class, 'register']);

Route::group(['middleware' => 'auth:sanctum'], function () {
  Route::resource('/books', BooksController::class);
  Route::resource('/authors', AuthorsController::class);

  Route::get('/authors/{id}/books', [AuthorsController::class, 'getBooksAuthor']);
});
