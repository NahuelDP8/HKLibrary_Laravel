@extends('adminView.layout.layout')

@section('title', 'Genero')
@section('content')
<div class="container vh-100 my-3 mx-2">
        <h1>{{ isset($genero) ? 'Editar Genero' : 'Crear Genero' }}</h1>
        <form class="me-4" method="POST" action="{{ isset($genero) ? route('generos.update', $genero->id) : route('generos.store') }}" enctype="multipart/form-data">
            @csrf
            @if(isset($genero))
                @method('PUT')
            @endif

            @if(isset($genero))    
                <label for="id">ID</label>
                <label>{{ $genero->id }}</label>
            @endif

            <div class="mb-2">
                <label for="titulo" class="form-label">Nombre Genero</label>
                <input type="text" class="form-control" id="titulo" name="nombre_genero" value="{{ isset($genero) ? $genero->nombreGenero : "" }}">
                @if($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="text-danger">{{ $error }}</div>
                    @endforeach
                @endif
            </div>

            <div class="d-grid my-3">
                    <button type="submit" class="btn btn-primary">{{ isset($genero) ? 'Actualizar' : 'Guardar' }}</button>
            </div>
        </form>
</div>
@endsection