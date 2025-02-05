<?php

namespace App\Services;
use App\Models\Books;

class BookService
{
  protected function findBookOrFail($id)
  {
    $book = Books::find($id);
    if (!$book) {
      abort(404, 'Livro não encontrado');
    }
    return $book;
  }

  public function createBook($request)
  {
    return Books::create($request->validated());
  }

  public function updateBook($request, $id)
  {
    $book = $this->findBookOrFail($id);
    $book->update($request->validated());

    return $book;
  }

  public function deleteBook($id)
  {
    $book = $this->findBookOrFail($id);
    $book->delete();

    return true;
  }

  public function getBookById($id)
  {
    return $this->findBookOrFail($id);
  }
}
