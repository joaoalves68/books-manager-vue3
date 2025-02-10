@extends('layouts.app')

@section('title', 'Books Manager - Login')

@section('content')
<div class="row justify-content-center align-items-center min-vh-100">
  <div class="col-md-4">
    <div class="card shadow-sm">
      <div class="card-body">
        <h3 class="text-center">Login</h3>

        @if ($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" class="form-control" name="email" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Senha</label>
            <input type="password" class="form-control" name="password" required>
          </div>
          <button type="submit" class="btn btn-primary w-100">Entrar</button>
        </form>
        <p class="mt-3 text-center">
          Ainda não possui uma conta? <a href="{{ route('register') }}">Cadastre-se</a>
        </p>
      </div>
    </div>
  </div>
</div>
@endsection
