<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

use App\Models\Authors;
use App\Models\Books;
use App\Services\BookService;
use App\Http\Requests\RequestBook;
use App\Http\Controllers\Controller;

class BooksController extends Controller
{
  protected $bookService;

  public function __construct(BookService $bookService){
    $this->bookService = $bookService;
  }

  public function index()
  {
    $books = Books::all();
    return view('books.index', compact('books'));
  }

  public function create()
  {
    $authors = Authors::all();
    return view('books.create', compact('authors'));
  }

  public function edit(string $id)
  {
    $book = $this->bookService->getBookById($id);
    $authors = Authors::all();
    return view('books.edit', compact('book', 'authors'));
  }

  public function destroy(string $id)
  {
    $book = $this->bookService->deleteBook($id);
    return redirect()->route('books.index')->with('success', 'Livro deletado com sucesso');
  }

  public function store(RequestBook $request)
  {
    $book = $this->bookService->createBook($request);
    return redirect()->route('books.index')->with('success', 'Livro criado com sucesso');
  }

  public function update(RequestBook $request, string $id)
  {
    $book = $this->bookService->updateBook($request, $id);
    return redirect()->route('books.index')->with('success', 'Livro editado com sucesso');
  }
}
