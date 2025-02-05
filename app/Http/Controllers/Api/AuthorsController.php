<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\RequestAuthor;
use App\Services\AuthorService;
use App\Models\Authors;

class AuthorsController extends Controller
{
  protected $authorService;

  public function __construct(AuthorService $authorService) {
    $this->authorService = $authorService;
  }

  public function store(RequestAuthor $request)
  {
    $author = $this->authorService->createAuthor($request);

    return response()->json($author, 201);
  }

  public function show(string $id)
  {
    $author = $this->authorService->getAuthorById($id);

    return response()->json($author, 200);
  }

  public function update(RequestAuthor $request, string $id)
  {
    $author = $this->authorService->updateAuthor($request, $id);

    return response()->json($author, 200);
  }

  public function destroy(string $id)
  {
    $this->authorService->deleteAuthor($id);

    return response()->json(null, 204);
  }
}
