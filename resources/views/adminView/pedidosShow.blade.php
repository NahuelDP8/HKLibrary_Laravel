@extends('adminView.layout.layout')

@section('title',"Pedido Nro. $pedido->id")

@section('content')
  <h1 class="row m-0 py-2">Pedido</h1>
  <div class="row m-0 mb-3">
    <div class="col p-0 me-2">
        <h5 class="fw-bold m-0">Nro. Pedido:</h5> 
        <div class="border border-3 rounded bg-light p-2"> {{ $pedido->id }}</div>
    </div>
    <div class="col p-0 ms-2">
      <h5 class="fw-bold m-0">Fecha: </h5> 
      <div class="border border-3 rounded bg-light p-2">{{ $pedido->fecha }}</div>
    </div>
  </div>

  <div class="row m-0 mb-3">
    <div class="col p-0 me-2">
        <h5 class="fw-bold m-0">Cliente: </h5> 
        <div class="border border-3 rounded bg-light p-2">{{ $pedido->cliente->nombre_completo }}</div>
    </div>
    <div class="col p-0 ms-2">
      <h5 class="fw-bold m-0">Email:</h5  >
      <div class="border border-3 rounded bg-light p-2"> {{ $pedido->cliente->mail }}</div>
    </div>
  </div>

  <div class="row m-0 mb-3">
    <div class="col p-0">
      <h5 class="fw-bold p-0 m-0">Dirección: </h5>
      <div class="border border-3 rounded bg-light p-2">{{ $pedido->cliente->direccion }}</div>
    </div>
  </div>

  <table class="table table-striped table-hover mt-4">
    <thead>
      <tr>
        <th class="fs-5">Libro</th>
        <th class="fs-5 text-center">Cantidad</th>
        <th class="fs-5">Precio Unitario</th>
        <th class="fs-5 text-end">Subtotal</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($pedido->libros as $libro)
        <tr>
          <td>{{ $libro->titulo }}</td>
          <td class="text-center">{{ $libro->pivot->cantidadUnidades }}</td>
          <td>${{ number_format($libro->pivot->precioUnitario, 2, ',', '.') }}</td>
          <td class="text-end">${{ number_format($libro->pivot->precioUnitario * $libro->pivot->cantidadUnidades, 2, ',', '.') }}</td>
        </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr>
        <td colspan="3" class="text-right">Total:</td>
        <td class="text-end">${{ number_format($pedido->precio_total, 2, ',', '.') }}</td>
      </tr>
    </tfoot>
  </table>
  <div class="d-flex flex-column align-items-end">
    <a class="btn btn-info" href="{{ route('pedidos.index') }}" role="button">Volver</a>
  </div>
@endsection