@extends('layouts.app')

@section('title', 'Lista de Livros')

@section('content')
<div class="container my-5">
  <h1>Lista de Livros</h1>
  <h5 class="subtitle"><a href="{{ route('books.create') }}">Cadastrar novo</a></h5>

  @if(session('success'))
    <div class="alert alert-success" id="success-message">
      {{ session('success') }}
    </div>
  @endif

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
            <td class="d-flex justify-content-end">
              <a href="{{ route('books.edit', $book->id) }}" class="btn btn-secondary btn-sm me-2">Editar</a>
              <form action="{{ route('books.destroy', $book->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Você tem certeza que deseja excluir este livro?')">Excluir</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
  </table>
</div>
@endsection
