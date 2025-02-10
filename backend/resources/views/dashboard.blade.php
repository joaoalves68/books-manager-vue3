@extends('layouts.app')

@section('title', 'Books Manager - Dashboard')

@section('content')
<div class="container my-5">
  <h1>Dashboard</h1>

  @if(session('success'))
    <div class="alert alert-success" id="success-message">
      {{ session('success') }}
    </div>
  @endif

</div>
@endsection
