<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pedidos = Pedido::with('cliente','libros')->get();
        return view('adminView.pedidosIndex',[
            'pedidos' => $pedidos
        ]);
    }


    public function show(Pedido $pedido)
    {
        return view('adminView.pedidosShow', [
            'pedido' => $pedido,
        ]);
    }

  
}
