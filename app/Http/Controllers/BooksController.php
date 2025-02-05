<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Authors;
use App\Models\Books;

class BooksController extends Controller
{
  public function index()
  {
    $books = Books::all();
    return view('books.index', compact('books'));
  }

  public function create()
  {
    return view('books.create');
  }

  public function edit($id)
  {
    dd('edit', $id);
    // return view('books.create');
  }

  public function destroy($id)
  {
    dd('destroy', $id);
    // $book = Books::find($id);
    // $book->delete();
    // return redirect('/books');
  }

  // public function store()
  // public function update()
}
