<?php

namespace App\Http\Controllers\Web;

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

  public function index()
  {
    $authors = Authors::all();
    return view('authors.index', compact('authors'));
  }

  public function create()
  {
    return view('authors.create');
  }

  public function edit(string $id)
  {
    $author = $this->authorService->getAuthorById($id);
    return view('authors.edit', compact('author'));
  }

  public function destroy(string $id)
  {
    try {
      $this->authorService->deleteAuthor($id);
      return redirect()->route('authors.index')->with('success', 'Autor deletado com sucesso!');
    } catch (ValidationException $e) {
      return redirect()->route('authors.index')->withErrors($e->errors());
    }
  }

  public function store(RequestAuthor $request)
  {
    $author = $this->authorService->createAuthor($request);
    return redirect()->route('authors.index')->with('success', 'Autor criado com sucesso.');
  }

  public function update(RequestAuthor $request, string $id)
  {
    $author = $this->authorService->updateAuthor($request, $id);
    return redirect()->route('authors.index')->with('success', 'Autor editado com sucesso.');
  }
}
