@extends('adminView.layout.layout')
    @if(isset($autor))
        @section('title','Editar autor')
    @else
        @section('title','Crear autor')
    @endif
@section('content')
    <h1>{{ isset($autor) ? 'Editar autor' : 'Crear autor' }}</h1>
    
    <form class="me-4" method="POST" action="{{ isset($autor) ? route('autores.update', $autor->id) : route('autores.store') }}" enctype="multipart/form-data">
        @csrf
        @if(isset($autor))
            @method('PUT')
        @endif

        <div class="mb-2 ">
            <label for="titulo" class="form-label">Nombre/s </label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ isset($autor) ? $autor->nombre : "" }}">
            <label for="titulo" class="form-label">Apellido/s </label>
            <input type="text" class="form-control" id="apellido" name="apellido" value="{{ isset($autor) ? $autor->apellido : "" }}">
        </div>




        <div class="d-grid my-3">
                <button type="submit" class="btn btn-primary">{{ isset($autor) ? 'Actualizar' : 'Guardar' }}</button>
        </div>
    </form>

@endsection
