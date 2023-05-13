@extends('adminView.layout.layout')
@section('title','Libros')
@section('content')
    <div class="d-flex justify-content-between py-3">
        <h1 class="">Listado de Libros</h1>
        <a class="btn btn-primary" href="{{ route('libros.create') }}">Nuevo Libro </a>
    </div>  
    <div class="table-responsive-xxl">
        <table id="dataTableLibros" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col" class="">Id</th>
                    <th scope="col" class="maxWidth300">Título</th>
                    <th scope="col" class="maxWidth300">Autor/es</th>
                    <th scope="col" class="maxWidth300">Genero/s</th>
                    <th scope="col" class="">Descripción</th>
                    <th scope="col" class="text-center">Nro. de Páginas</th>
                    <th scope="col" class="text-center">Precio ($)</th>
                    <th scope="col" class="text-center">Disponible</th>
                    <th scope="col" class="text-center">Imagen</th>
                    <th scope="col" class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody  class="table-group-divider">
                @foreach ($libros as $libro)
                    <tr class="">
                        <th scope="row">{{ $libro->id }}</th>
                        <td class="text-center">{{ $libro->titulo }}</td>
                        <td class="text-center">
                        @foreach ($libro->autores as $autor)
                            {{$autor->nombre}},  {{$autor->apellido}};    
                        @endforeach
                        </td>
                        <td class="text-center">
                                @foreach ($libro->generos as $genero)
                                    {{$genero->nombreGenero}};    
                                @endforeach
                                </td>
                        <td class="text-truncate" >{{ Str::limit($libro->descripcion, 40) }}</td>
                        <td class="text-center">{{ $libro->cantidadPaginas }}</td>
                        <td class="text-center">{{ number_format($libro->precio, 2,'.') }}</td>
                        @if ($libro->disponible == 1) 
                            <td class="table-success text-center"> Disponible </td>
                        @else 
                            <td class="table-danger text-center"> NO Disponible </td>
                        @endif
                        <td class="text-center"><img class="text-center img-fluid maxSize100" src="{{ $libro->urlImagen }}" alt="Imagen del Libro"></td> 
                        <td class="text-center"><a href="{{ route('libros.edit',$libro->id) }}" class="btn btn-primary">Editar</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
