<?php

namespace App\Services;
use App\Models\Books;

class BookService
{
  public function createBook($request)
  {
    $book = new Books($request->validated());
    $book->save();

    return $book;
  }

  public function updateBook($request, $id){
    $book = Books::find($id);
    if(!$book){
      return response()->json(['error' => 'Livro não encontrado'], 404);
    }

    $book->update($request->validated());

    return $book;
  }
}
