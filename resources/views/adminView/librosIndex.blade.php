@extends('adminView.layout.layout')

@section('title','LibrosEditCreate')
@section('content')
    <!DOCTYPE html>
    <html>
    <head>
        <title>Listado de Libros</title>
        <!-- Agregar enlaces a los estilos de Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container-fluid">
            <div class="d-flex justify-content-between mb-3">
                <h1 class="mx-auto">Listado de Libros</h1>
                <a href="{{ route('libros.create') }}" class="btn btn-primary ml-auto me-3">Nuevo Libro</a>
            </div>
            <div class="table-responsive table-lg mx-3">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="table-header">Id</th>
                            <th class="table-header">Título</th>
                            <th class="table-header">Autor/es</th>
                            <th class="table-header">Descripción</th>
                            <th class="table-header">Cantidad de Páginas</th>
                            <th class="table-header">Precio ($)</th>
                            <th class="table-header">Disponible</th>
                            <th class="table-header">Imagen</th>
                            <th class="table-header">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($libros as $libro)
                            <tr class="table-row">
                                <td>{{ $libro->id }}</td>
                                <td>{{ $libro->titulo }}</td>
                                <td>
                                @foreach ($libro->autores as $autor)
                                    {{$autor->nombre}},  {{$autor->apellido}}<br>   
                                @endforeach
                                </td>
                                <td class="text-truncate" style="max-width: 500px">{{ $libro->descripcion }}</td>
                                <td>{{ $libro->cantidadPaginas }} pags</td>
                                <td>{{ $libro->precio }}</td>
                                <td>
                                    @if ($libro->disponible == 1) 
                                        Disponible
                                    @else 
                                        NO Disponible
                                    @endif
                                </td>
                                <td><img style="max-height: 50px" src="{{ $libro->urlImagen }}" alt="Imagen del Libro" class="img-fluid"></td> 
                                <td class=raw><a href="{{ route('libros.edit',$libro->id) }}" class="btn btn-primary btn-lg">Editar</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Agregar enlaces a los scripts de Bootstrap (jQuery y Popper.js) -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
@endsection
