@extends('adminView.layout.layout')

@section('title','Generos')

@section('content')
    <div class="d-flex justify-content-between">
        <h1 class="mr-auto">Generos</h1>
        <a href="{{ route('generos.create') }}" class="btn btn-primary ml-auto me-3">Nuevo Genero</a>
    </div>
    <div class="table table-sm">
        <table class="table table-condensed table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="table-header">ID Genero</th>
                    <th class="table-header text-center">Nombre Genero</th>
                    <th class="table-header"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($generos as $genero)
                    <tr class="table-row p-0">
                        <td class="px-1 py-0 text-middle align-middle">{{ $genero->id }}</td>
                        <td class="px-1 py-0 text-center align-middle">{{ $genero->nombreGenero }}</td>
                        <td class="px-1 py-0 text-center align-middle">
                            <a class="btn btn-primary" href="{{ route('generos.edit',$genero->id) }}">Editar Genero</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $generos->links() }}
    </div>
@endsection
