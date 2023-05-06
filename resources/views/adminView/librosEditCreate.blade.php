@extends('adminView.layout.layout')

@section('title', 'Editar Libro')
@section('content')
    <div class="container">
        <h1>{{ isset($libro) ? 'Editar Libro' : 'Crear Libro' }}</h1>
        <form method="POST" action="{{ isset($libro) ? route('libros.update', $libro->id) : route('libros.store') }}" enctype="multipart/form-data">
            @csrf
            @if(isset($libro))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="title" class="form-label">Título</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ isset($libro) ? $libro->titulo : "" }}">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descripción</label>
                <textarea class="form-control" id="description" name="description" rows="4">{{ isset($libro) ? $libro->descripcion : "" }}</textarea>
            </div> 

            <div class="mb-3">
                <label for="image" class="form-label">Imagen</label>
                <input type="url" class="form-control-file" id="image" name="urlImg" value="{{ isset($libro) ? $libro->urlImagen : "" }}">
                @if(isset($libro) && $libro->urlImagen)
                    <img src="{{ $libro->urlImagen }}" alt="Libro Image" class="mt-2 img-fluid">
                @endif
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="cantPag" class="form-label">Cantidad de Páginas</label>
                        <input type="number" class="form-control" id="cantPag" name="cantPag" value="{{ isset($libro) ? $libro->cantidadPaginas : "" }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="price" class="form-label">Precio</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ isset($libro) ? $libro->precio : "" }}">
                    </div>
                </div>
            </div>

            <div class="mb-3">
    <label for="autor" class="form-label">Autores</label>
    <select class="form-select" id="autor" name="autor[]" multiple>
        @foreach ($libro->autores as $autor)
            <option value="{{ $autor->id }}">{{ $autor->nombre }} {{ $autor->apellido }}</option>
        @endforeach
    </select>
    <div class="mb-3">
    <label for="new_autor" class="form-label">Nuevo Autor</label>
     <select class="form-select" id="new_autor" name="new_autor">
      <option value="">Seleccione un autor existente</option>
    </select>
</div>
</div>


            <div class="d-grid">
                <button type="submit" class="btn btn-primary">{{ isset($libro) ? 'Actualizar' : 'Guardar' }}</button>
            </div>
        </form>
    </div>
@endsection
