@extends('adminView.layout.layout')

@section('title','Listado Pedidos')

@section('content')
<div class="container justify-content-center py-2">
    <div class="d-flex justify-content-between">
        <h1 class="mr-auto">Listado de Pedidos</h1>
    </div>
    <div class="table table-sm">
        <table class="table table-condensed table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="table-header">Nro. Pedido</th>
                    <th class="table-header text-center">Fecha</th>
                    <th class="table-header">Cliente</th>
                    <th class="table-header">Mail</th>
                    <th class="table-header text-center">Precio Total ($)</th>
                    <th class="table-header"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pedidos as $pedido)
                    <tr class="table-row p-0">
                        <td class="px-1 py-0 text-middle align-middle">{{ $pedido->id }}</td>
                        <td class="px-1 py-0 text-center align-middle">{{ $pedido->fecha }}</td>
                        <td class="px-1 py-0 align-middle">{{ $pedido->cliente->nombre_completo}}</td>
                        <td class="px-1 py-0 align-middle">{{ $pedido->cliente->mail }}</td>
                        <td class="px-1 py-0 text-center align-middle">{{ $pedido->precio_total }}</td>
                        <td class="px-1 py-0 text-center align-middle"><button class="btn btn-primary">Ver detalle</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $pedidos->links() }}
    </div>
</div>
@endsection

