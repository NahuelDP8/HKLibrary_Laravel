@extends('adminView.layout.layout')

@section('title',"Pedido Nro. $pedido->id")

@section('content')
<div class="container">
  <h1 class="row m-0">Pedido</h1>
  <div class="row m-0 mb-3">
    <div class="col p-0 me-2">
        <div class="fw-bold">Nro. Pedido:</div> 
        <div class="border border-3 rounded bg-light"> {{ $pedido->id }}</div>
    </div>
    <div class="col p-0 ms-2">
      <div class="fw-bold">Fecha: </div> 
      <div class="border border-3 rounded bg-light">{{ $pedido->fecha }}</div>
    </div>
  </div>

  <div class="row m-0 mb-3">
    <div class="col p-0 me-2">
        <div class="fw-bold">Cliente: </div> 
        <div class="border border-3 rounded bg-light">{{ $pedido->cliente->nombre_completo }}</div>
    </div>
    <div class="col p-0 ms-2">
      <div class="fw-bold">Email:</div>
      <div class="border border-3 rounded bg-light"> {{ $pedido->cliente->mail }}</div>
    </div>
  </div>

  <div class="row m-0 mb-3">
    <div class="col p-0">
      <div class="fw-bold p-0">Dirección: </div>
      <div class="border border-3 rounded bg-light">{{ $pedido->cliente->direccion }}</div>
    </div>
  </div>

  <table class="table table-striped table-hover mt-4">
    <thead>
      <tr>
        <th>Libro</th>
        <th class="text-center">Cantidad</th>
        <th>Precio Unitario</th>
        <th>Subtotal</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($pedido->libros as $libro)
        <tr>
          <td>{{ $libro->titulo }}</td>
          <td class="text-center">{{ $libro->pivot->cantidadUnidades }}</td>
          <td>${{ $libro->pivot->precioUnitario }}</td>
          <td>${{ $libro->pivot->precioUnitario * $libro->pivot->cantidadUnidades }}</td>
        </tr>
      @endforeach
    </tbody>
    <tfoot>
      <tr>
        <td colspan="3" class="text-right">Total:</td>
        <td>${{ $pedido->precio_total }}</td>
      </tr>
    </tfoot>
  </table>
</div>

@endsection