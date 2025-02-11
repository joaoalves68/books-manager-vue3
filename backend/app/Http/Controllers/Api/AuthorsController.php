<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\RequestAuthor;
use App\Services\AuthorService;
use App\Services\LogService;

class AuthorsController extends Controller
{
  protected $authorService;

  public function __construct(AuthorService $authorService) {
    $this->authorService = $authorService;
  }

  public function store(RequestAuthor $request)
  {
    $author = $this->authorService->createAuthor($request);

    new LogService(auth()->user()->id, 'Usuário '.auth()->user()->name.' cadastrou o autor id: '.$author->id);
    return response()->json($author, 201);
  }

  public function show(string $id)
  {
    $author = $this->authorService->getAuthorById($id);

    new LogService(auth()->user()->id, 'Usuário '.auth()->user()->name.' buscou pelo autor id: '.$id);
    return response()->json($author, 200);
  }

  public function update(RequestAuthor $request, string $id)
  {
    $author = $this->authorService->updateAuthor($request, $id);

    new LogService(auth()->user()->id, 'Usuário '.auth()->user()->name.' alterou o autor id: '.$id);
    return response()->json($author, 200);
  }

  public function destroy(string $id)
  {
    $this->authorService->deleteAuthor($id);

    new LogService(auth()->user()->id, 'Usuário '.auth()->user()->name.' deletou o autor id: '.$id);
    return response()->json(['success' => 'Autor deletado com sucesso'], 201);
  }

  public function index()
  {
    $authors = $this->authorService->getAuthors();

    new LogService(auth()->user()->id, 'Usuário '.auth()->user()->name.' buscou pelos livros');
    return response()->json($authors, 200);
  }

  public function getBooksAuthor(string $id)
  {
    $books = $this->authorService->getBooksAuthor($id);

    new LogService(auth()->user()->id, 'Usuário '.auth()->user()->name.' buscou os livros do autor id: '.$id);
    return response()->json($books, 200);
  }
}
