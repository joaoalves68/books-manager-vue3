<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\RequestAuthor;
use App\Services\AuthorService;

class AuthorsController extends Controller
{
  protected $authorService;

  public function __construct(AuthorService $authorService) {
    $this->authorService = $authorService;
  }

  public function index()
  {
  }

  public function create()
  {
  }

  public function edit(string $id)
  {
  }

  public function destroy(string $id)
  {
  }

  public function store(RequestAuthor $request)
  {
  }

  public function update(RequestAuthor $request, string $id)
  {
  }
}
