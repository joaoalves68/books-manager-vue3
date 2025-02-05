<!-- filepath: /home/joao/projects/books-manager/resources/views/books/index.blade.php -->
@extends('layouts.app')

@section('title', 'Cadastrar Livro')

@section('content')
<div class="container mt-5">
  <h1>Editar Livro</h1>
  <h5 class="subtitle"><a href="{{ route('books.index') }}">Voltar</a></h5>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('books.update', $book->id) }}" method="POST">
    @method('PUT')
    @include('books.form')
  </form>
</div>
@endsection
