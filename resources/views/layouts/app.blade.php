<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Books Manager - Ínicio')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>
  <body class="d-flex flex-column min-vh-100">
    <div class="d-flex flex-grow-1" id="wrapper">

      @auth
        <div class="border-right" id="sidebar-wrapper" style="width: 250px;">
          <div class="logo text-center py-4"><img width="230" src="https://www.inovcorp.com/site/imagens/logo_1.png" alt="InovCorp"></div>
          <div class="list-group list-group-flush">
            <a href="{{ route('books.index') }}" class="list-group-item list-group-item-action py-3">Livros</a>
            <a href="{{ route('authors.index') }}" class="list-group-item list-group-item-action py-3">Autores</a>
          </div>
        </div>
      @endauth

      <div id="page-content-wrapper" class="flex-grow-1">

        @auth
          <nav class="navbar navbar-expand-lg navbar-light border-bottom">
            <div class="collapse navbar-collapse justify-content-end px-3" id="navbarSupportedContent">
              <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                <li class="nav-item">
                  <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-link nav-link">Logout</button>
                  </form>
                </li>
              </ul>
            </div>
          </nav>
        @endauth

        <div class="container-fluid">
          @yield('content')
        </div>
      </div>
    </div>

  </body>
</html>
