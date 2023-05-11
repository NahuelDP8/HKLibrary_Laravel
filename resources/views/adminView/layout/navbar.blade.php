<nav class="navbar sticky-top bg-dark navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
        <img src="{{ asset('images/logoBookShop.png') }}" alt="Logo" class="navbarlogo">
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 fs-3" >
                <li class="nav-item">
                    <a class="nav-link link-light menuHover rounded" href="{{ route('pedidos.index') }}">Pedidos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-light menuHover rounded" href="{{ route('libros.index') }}">Libros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-light menuHover rounded" href="{{ route('autores.index') }}">Autores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-light menuHover rounded" href="{{ route('generos.index') }}">Géneros</a>
                </li>
            </ul>
        </div>
    </div>
  </nav>