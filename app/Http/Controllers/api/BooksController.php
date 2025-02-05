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

    return response()->json($book, 201);
  }

  public function show($id) {
    $book = $this->bookService->getBookById($id);

    return response()->json($book, 200);
  }

  public function update(RequestBook $request, $id) {
    $book = $this->bookService->updateBook($request, $id);

    return response()->json($book, 200);
  }

  public function destroy($id) {
    $this->bookService->deleteBook($id);

    return response()->json(null, 204);
  }
}
