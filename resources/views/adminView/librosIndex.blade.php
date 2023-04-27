<!DOCTYPE html>
<html>
<head>
    <title>Listado de Libros</title>
    <!-- Agregar enlaces a los estilos de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Listado de Libros</h1>

        <div class="row">
            <div class="col-auto">Id</div>
            <div class="col-auto">Título</div>
            <div class="col-auto">Descripción</div>
            <div class="col-auto">Cantidad de Páginas</div>
            <div class="col-auto">Precio</div>
            <div class="col-auto">Disponible</div>
            <div class="col-auto">Imagen</div>
        </div>

        @foreach ($libros as $libro)
            <div class="row">
                <div class="col-auto">{{ $libro->id }}</div>
                <div class="col-auto">{{ $libro->titulo }}</div>
                <div class="col-auto overflow-scroll" style="max-height: 300px; max-width: 500px">{{ $libro->descripcion }}</div>
                <div class="col-auto">{{ $libro->cantidadPaginas }}</div>
                <div class="col-auto">{{ $libro->precio }}</div>
                <div class="col-auto">{{ $libro->disponible }}</div>
                <div class="col-auto"><img src="{{ $libro->urlImagen }}" alt="Imagen del Libro"></div>
            </div>
        @endforeach
    </div>

    <!-- Agregar enlaces a los scripts de Bootstrap (jQuery y Popper.js) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
