<?php

namespace App\Services;

use App\Models\Authors;
use App\Http\Requests\RequestAuthor;
use Illuminate\Validation\ValidationException;
class AuthorService
{
  protected function findAuthorOrFail(string $id)
  {
    $author = Authors::find($id);
    if (!$author) {
      abort(response()->json([
        'error' => 'Autor não encontrado'
      ], 404));
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

    if($author->books->count() > 0) {
      throw ValidationException::withMessages([
        'error' => 'Autor possui livros cadastrados'
      ]);
    }

    $author->delete();

    return true;
  }

  public function getAuthorById(string $id)
  {
    return $this->findAuthorOrFail($id);
  }
}
