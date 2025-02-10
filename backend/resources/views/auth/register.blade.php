@extends('layouts.app')

@section('title', 'Books Manager - Registre-se')

@section('content')
<div class="row justify-content-center align-items-center min-vh-100">
  <div class="col-md-4">
    <div class="card shadow-sm">
      <div class="card-body">
        <h3 class="text-center">Registre-se</h3>

        @if ($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="name" class="form-control" name="name" required value="{{ old('name') }}">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" name="email" required value="{{ old('email') }}">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Senha</label>
            <input type="password" class="form-control" name="password" required>
          </div>
          <div class="mb-3">
            <label for="password_confirm" class="form-label">Confirme sua senha</label>
            <input type="password" class="form-control" name="password_confirm" required>
          </div>
          <button type="submit" class="btn btn-primary w-100">Registrar</button>
        </form>
        <p class="mt-3 text-center">
          Já possui uma conta? <a href="{{ route('login') }}">Faça o login</a>
        </p>
      </div>
    </div>
  </div>
</div>
@endsection
