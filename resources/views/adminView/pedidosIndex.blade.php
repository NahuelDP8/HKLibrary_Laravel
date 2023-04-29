@extends('adminView.layout.layout')

@section('title','Listado Pedidos')

@section('content')
<div class="container justify-content-center px-5 py-4">
    <div class="d-flex justify-content-between">
        <h1 class="mr-auto">Listado de Libros</h1>
    </div>
    <div class="table-responsive table-lg">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="table-header col-1">Nro. Pedido</th>
                    <th class="table-header col-1 text-center">Fecha</th>
                    <th class="table-header col-2">Cliente</th>
                    <th class="table-header col-4">Mail</th>
                    <th class="table-header col-1 text-center">Precio Total ($)</th>
                    <th class="table-header col-1"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pedidos as $pedido)
                    <tr class="table-row">
                        <td>{{ $pedido->id }}</td>
                        <td class="text-center">{{ $pedido->fecha }}</td>
                        <td>{{ $pedido->id }}</td>
                        <td>{{ $pedido->id }}</td>
                        <td class="text-center">{{ $pedido->id }}</td>
                        <td class="text-center"><button class="btn btn-primary">Ver detalle</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

