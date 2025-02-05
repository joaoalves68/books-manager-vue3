@extends('layouts.app')

@section('title', 'Lista de Autores')

@section('content')
<div class="container mt-5">
  <h1>Lista de Autores</h1>
  <h5 class="subtitle"><a href="{{ route('authors.create') }}">Cadastrar novo</a></h5>

  @if(session('success'))
    <div class="alert alert-success" id="success-message">
      {{ session('success') }}
    </div>
  @endif

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <table class="table">
    <thead>
      <tr>
        <th>Nome</th>
        <th>Estado</th>
        <th></th>
      </tr>
    </thead>
      <tbody>
        @foreach($authors as $author)
          <tr>
            <td>{{ $author->name }}</td>
            <td>{{ $author->state }}</td>
            <td class="d-flex justify-content-end">
              <a href="{{ route('authors.edit', $author->id) }}" class="btn btn-secondary btn-sm me-2">Editar</a>
              <form action="{{ route('authors.destroy', $author->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Você tem certeza que deseja excluir este autor?')">Excluir</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
  </table>
</div>
@endsection
