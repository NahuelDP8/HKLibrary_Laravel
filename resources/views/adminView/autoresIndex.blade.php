@extends('adminView.layout.layout')

@section('title','Autores')
@section('content')
    <!DOCTYPE html>
    <html>
    <head>
        <title>Listado de Autores</title>
        <!-- Agregar enlaces a los estilos de Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container-fluid maxWidth800">
            <div class="d-flex justify-content-between mb-3 maxWidth800">
                <h1 class="mx-auto">Listado de autores</h1>
                <a href="{{ route('autores.create') }}" class="btn btn-primary ml-auto me-3">Nuevo autor</a>
            </div>
            <div class="table-responsive table-lg mx-3 maxWidth800">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="table-header maxWidth100">Id</th>
                            <th class="table-header">Nombre/s y Apellido/es</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($autores as $autor)
                            <tr class="table-row">
                                <td class="maxWidth100">{{ $autor->id }}</td>
                                <td>
                                    {{$autor->nombre}},  {{$autor->apellido}}
                                </td>
                               <td class="row mx-1"><a href="{{ route('autores.edit',$autor->id) }}" class=" btn btn-primary mx-1 ">Editar</a></td>
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
