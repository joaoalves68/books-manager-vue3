<?php

namespace App\Services;
use App\Models\Authors;

use App\Http\Requests\RequestAuthor;

class AuthorService
{
  protected function findAuthorOrFail(string $id)
  {
    $author = Authors::find($id);
    if (!$author) {
      abort(404, 'Autor não encontrado');
    }
    return $author;
  }

  public function createAuthor(RequestAuthor $request)
  {
    return Authors::create($request->validated());
  }

  public function updateAuthor(RequestAuthor $request, string $id)
  {
    $author = $this->findAuthorOrFail($id);
    $author->update($request->validated());

    return $author;
  }

  public function deleteAuthor(string $id)
  {
    $author = $this->findAuthorOrFail($id);
    $author->delete();

    return true;
  }

  public function getAuthorById(string $id)
  {
    return $this->findAuthorOrFail($id);
  }
}
