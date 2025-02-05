<!-- filepath: /home/joao/projects/books-manager/resources/views/books/index.blade.php -->
@extends('layouts.app')

@section('title', 'Lista de Livros')

@section('content')
<div class="container mt-5">
  <h1>Lista de Livros</h1>
  <h5 class="register-new"><a href="{{ route('books.create') }}">Cadastrar novo</a></h5>
  <table class="table">
    <thead>
      <tr>
        <th>Título</th>
        <th>Descrição</th>
        <th>Publicado em</th>
        <th>Autor</th>
        <th></th>
      </tr>
    </thead>
      <tbody>
        @foreach($books as $book)
          <tr>
            <td>{{ $book->title }}</td>
            <td class="text-truncate">{{ $book->description }}</td>
            <td>{{ \Carbon\Carbon::parse($book->published_at)->format('d/m/Y') }}</td>
            <td>{{ $book->author->name }}</td>
            <td>
              <a href="{{ route('books.edit', $book->id) }}" class="btn btn-secondary btn-sm">Editar</a>
              <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
  </table>
</div>
@endsection
