@extends('layouts.app')

@section('title', 'Editar Autor')

@section('content')
<div class="container mt-5">
  <h1>Editar Autor</h1>
  <h5 class="subtitle"><a href="{{ route('authors.index') }}">Voltar</a></h5>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('authors.update', $author->id) }}" method="POST">
    @method('PUT')
    @include('authors.form')
  </form>
</div>
@endsection
