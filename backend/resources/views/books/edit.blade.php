@extends('layouts.app')

@section('title', 'Editar Livro')

@section('content')
<div class="container my-5">
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

  <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @include('books.form')
  </form>
</div>
@endsection
