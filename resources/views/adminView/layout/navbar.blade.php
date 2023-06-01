<nav class="navbar sticky-top bg-dark navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand link-light d-flex" href="#">
            <img src="{{ asset('images/logoBookShop.png') }}" alt="Logo" class="navbarlogo">
            <img src="{{ asset('images/HKLibrary.PNG') }}" alt="HK Library" class="maxWidth300">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon navbar-dark"></span>
        </button>
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
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button class="me-3 btn btn-dark fs-5">Log out</button>
            </form>
            
        </div>
    </div>
  </nav>