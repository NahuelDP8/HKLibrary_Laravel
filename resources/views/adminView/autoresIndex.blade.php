@extends('adminView.layout.layout')

@section('title','Autores')
@section('content')
    <div class="d-flex justify-content-between py-3">
        <h1 class="">Listado de autores</h1>
        <a href="{{ route('autores.create') }}" class="btn btn-primary">Nuevo autor</a>
    </div>
    <div class="table-responsive-xxl">
        <table id="datatableAutores" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="">Id</th>
                    <th class="">Nombre/s y Apellido/s</th>
                    <th class="text-center">Accion</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($autores as $autor)
                    <tr class="">
                        <td class="">{{ $autor->id }}</td>
                        <td>{{$autor->nombre}},  {{$autor->apellido}}</td>
                        <td class="p-0 align-middle text-center"><a href="{{ route('autores.edit',$autor->id) }}" class=" btn btn-primary">Editar</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endsection
