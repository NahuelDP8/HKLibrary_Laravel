@extends('adminView.layout.layout')

@section('title','Listado Pedidos')

@section('content')
    <div class="d-flex justify-content-between">
        <h1 class="mr-auto">Listado de Pedidos</h1>
    </div>
    <div class="table-responsive">
        <table id="dataTablePedidos" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col" class="">Nro. Pedido</th>
                    <th scope="col" class="text-center">Fecha</th>
                    <th scope="col" class="">Cliente</th>
                    <th scope="col" class="">Mail</th>
                    <th scope="col" class="text-center">Precio Total ($)</th>
                    <th scope="col" class=""></th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($pedidos as $pedido)
                    <tr class="">
                        <th scope="row" class="">{{ $pedido->id }}</th>
                        <td class="text-center">{{ $pedido->fecha }}</td>
                        <td class="">{{ $pedido->cliente->nombre_completo}}</td>
                        <td class="">{{ $pedido->cliente->mail }}</td>
                        <td class="text-center">{{ $pedido->precio_total }}</td>
                        <td class="text-center align-middle p-0">
                            <a class="btn btn-primary" href="{{ route('pedidos.show',$pedido->id) }}">Ver detalle</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

