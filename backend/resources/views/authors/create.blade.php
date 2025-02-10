@extends('layouts.app')

@section('title', 'Cadastrar Autor')

@section('content')
<div class="container my-5">
  <h1>Cadastrar Autor</h1>
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

  <form action="{{ route('authors.store') }}" method="POST">
    @include('authors.form')
  </form>
</div>
@endsection
