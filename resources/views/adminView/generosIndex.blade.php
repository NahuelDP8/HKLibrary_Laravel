@extends('adminView.layout.layout')

@section('title','Generos')

@section('content')
    <div class="d-flex justify-content-between py-3">
        <h1 class="mr-auto">Generos</h1>
        <a href="{{ route('generos.create') }}" class="btn btn-primary ml-auto me-3">Nuevo Genero</a>
    </div>
    <div class="table table-sm">
        <table id="datatableGeneros" class="table table-condensed table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="table-header">ID Género</th>
                    <th class="table-header text-center">Nombre Genero</th>
                    <th class="table-header text-center">Accion</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($generos as $genero)
                    <tr class="">
                        <th scope="row" class="text-middle align-middle">{{ $genero->id }}</th>
                        <td class="text-center align-middle">{{ $genero->nombreGenero }}</td>
                        <td class="text-center align-middle p-0">
                            <a class="btn btn-primary" href="{{ route('generos.edit',$genero->id) }}">Editar Genero</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
