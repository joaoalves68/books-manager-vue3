<!-- filepath: /home/joao/projects/books-manager/resources/views/books/index.blade.php -->
@extends('layouts.app')

@section('title', 'Cadastrar Livro')

@section('content')
<div class="container mt-5">
  <h1>Cadastrar Livro</h1>
  <form action="{{ route('books.store') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label for="title" class="form-label">Título</label>
        <input type="text" class="form-control" id="title" name="title" required>
      </div>
      <div class="mb-3">
        <label for="description" class="form-label">Descrição</label>
        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
      </div>
      <div class="mb-3">
        <label for="published_at" class="form-label">Publicado em</label>
        <input type="date" class="form-control" id="published_at" name="published_at" required>
      </div>
      <div class="mb-3">
        <label for="author_id" class="form-label">Autor</label>
        <select class="form-control" id="author_id" name="author_id" required>
          {{-- @foreach($authors as $author)
            <option value="{{ $author->id }}">{{ $author->name }}</option>
          @endforeach --}}
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Enviar</button>
  </form>
</div>
@endsection
