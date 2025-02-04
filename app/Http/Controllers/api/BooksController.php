<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\RequestBook;
use App\Services\BookService;

use App\Models\Books;

class BooksController extends Controller
{
  protected $bookService;

  public function __construct(BookService $bookService){
    $this->bookService = $bookService;
  }

  public function store(RequestBook $request) {
    $book = $this->bookService->createBook($request);

    return $book;
  }

  public function update(RequestBook $request, $id) {
    $book = $this->bookService->updateBook($request, $id);

    return $book;
  }

  public function destroy($id) {
    $book = Books::find($id);
    if (!$book) {
      return response()->json(['error' => 'Livro não encontrado'], 404);
    }
    $book->delete();

    return response()->json(['success' => 'Livro deletado'], 201);
  }

  public function show($id) {
    $book = Books::find($id);
    if (!$book) {
      return response()->json(['error' => 'Livro não encontrado'], 404);
    }

    return $book;
  }
}
