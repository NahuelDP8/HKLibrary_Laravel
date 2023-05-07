<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PedidoResource;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Libro;
use App\Models\Pedido;
use Carbon\CarbonImmutable;

class PedidoController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        //Validar datos del cliente
        $request->validate([
            'cliente' =>'present|array:mail,nombre,apellido,direccion',
            'cliente.mail' => 'required|email',
            'cliente.nombre' => 'required|string|max:255',
            'cliente.apellido' => 'required|string|max:255',
            'cliente.direccion' => 'required|string|max:255'
        ]);

        //Validación de los libros
        $request->validate([
            'libros' => 'present|array',
            'libros.*.id' => [
                'distinct',
                'exists:libro,id', 
                function ($attribute, $value, $fail){
                    $libro = Libro::where('id', $value)->first();
                    if(!$libro->disponible){
                        $fail("The book $attribute is not available");
                    }
                },
            ]
        ]);

        //Si el cliente existe, obtenerlo, sino crear nuevo cliente
        $clientMail = $request->input('cliente.mail');
        if(Cliente::where('mail', $clientMail)->exists()){
            $client = Cliente::where('mail', $clientMail)->first();
        }else{
            $client = new Cliente();
            $client->mail = $clientMail;
            $client->nombre = $request->input('cliente.nombre');
            $client->apellido = $request->input('cliente.apellido');
            $client->direccion = $request->input('cliente.direccion');
            $client->save();
        }

        //Crear pedido y asociarle el cliente
        $pedido = new Pedido();
        $pedido->fecha = CarbonImmutable::today()->format('Y-m-d');
        $pedido->cliente()->associate($client);
        $pedido->save();

        //Crear colleccion de libros para vincularlos al pedido
        $books = collect($request->input('libros'));
        $booksAttach = $books->mapWithKeys(function(array $item, int $key){
            $LibroModel = Libro::find($item['id']);
            return [$item['id'] => ['cantidadUnidades' => $item['cantidad'], 'precioUnitario' => $LibroModel->precio]];
        });

        $pedido->libros()->attach($booksAttach);

        return new PedidoResource($pedido);
    }
}
