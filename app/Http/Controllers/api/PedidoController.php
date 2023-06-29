<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PedidoResource;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Libro;
use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;
use Carbon\CarbonImmutable;
use Symfony\Component\Mime\Part\Multipart\FormDataPart;
use MercadoPago;

class PedidoController extends Controller
{
    
    /**
     * @OA\Post(
     *     path="/pedidos",
     *     tags={"Pedido"},
     *     summary="Crear un nuevo pedido",  
     *     description="Crear un nuevo pedido con la información del cliente y los libros elegidos",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             ref="#/components/schemas/PedidoBody",
     *         ),
     *     ),
     *     @OA\Response(
     *         response="201",
     *         description="Pedido creado exitosamente",
     *         @OA\JsonContent(
     *             ref="#/components/schemas/PedidoCreado"
     *         ),
     *     ),
     *     @OA\Response(
     *         response="422",
     *         description="Formato invalido para los datos",
     *     ),
     * )
     * 
     * 
     * 
     * @OA\Schema(
     *     schema="PedidoBody",
     *     @OA\Property(
     *         property="cliente",
     *         type="object",
     *         @OA\Property(
     *             property="nombre",
     *             type="string",
     *             example="Tom"
     *         ),
     *         @OA\Property(
     *             property="apellido",
     *             type="string",
     *             example="Perez"
     *         ),
     *         @OA\Property(
     *             property="mail",
     *             type="string",
     *             format="email"
     *         ),
     *         @OA\Property(
     *             property="direccion",
     *             type="string",
     *             example="Calle Bonita 1234"
     *         )
     *     ),
     *     @OA\Property(
     *         property="libros",
     *         type="array",
     *         @OA\Items(
     *             type="object",
     *             @OA\Property(
     *                 property="id",
     *                 type="integer",
     *                 example="2"
     *             ),
     *             @OA\Property(
     *                 property="cantidad",
     *                 type="integer",
     *                 example="4"
     *             )
     *         )
     *     )
     * )
     * 
     * @OA\Schema(
     *     schema="PedidoCreado",
     *     type="object",
     *     required={"data"},
     *     @OA\Property(
     *         property="data",
     *         type="object",
     *         @OA\Property(
     *             property="id",
     *             type="integer",
     *             example=149,
     *         ),
     *         @OA\Property(
     *             property="fecha",
     *             type="string",
     *             example="2023-05-08",
     *         ),
     *         @OA\Property(
     *             property="precio_total",
     *             type="number",
     *             example=2095442.58,
     *         ),
     *         @OA\Property(
     *             property="cliente",
     *             type="object",
     *             @OA\Property(
     *                 property="id",
     *                 type="integer",
     *                 example=107,
     *             ),
     *             @OA\Property(
     *                 property="nombre",
     *                 type="string",
     *                 example="Tom",
     *             ),
     *             @OA\Property(
     *                 property="apellido",
     *                 type="string",
     *                 example="Perez",
     *             ),
     *             @OA\Property(
     *                 property="direccion",
     *                 type="string",
     *                 example="Calle Bonita 1234",
     *             ),
     *             @OA\Property(
     *                 property="mail",
     *                 description="The email of the client",
     *                 type="string",
     *                 example="user@example.com",
     *             ),
     *         ),
     *         @OA\Property(
     *             property="libros",
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(
     *                     property="titulo",
     *                     type="string",
     *                     example="Enim quia culpa nihil est.",
     *                 ),
     *                 @OA\Property(
     *                     property="precio_unitario",
     *                     type="string",
     *                     example="698480.86",
     *                 ),
     *                 @OA\Property(
     *                     property="cantidad_unidades",
     *                     type="integer",
     *                     example=3,
     *                 ),
     *             ),
     *         ),
     *     ),
     * )
     *
     *
     */

    public function store(Request $request)
    {  
        //Validación de los libros
        $request->validate([
            'libros' => 'required|array',
            'libros.*.id' => [
                'required',
                'numeric',
                'distinct',
                'exists:libro,id,disponible,true'
            ],
            'libros.*.cantidad' => 'required|integer|min:1'
        ]);
        $this->checkMercadoPagoStatus($request->formData);
        dd("hola",$request->formData);
        $client = $request->user();

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

    private function checkMercadoPagoStatus($formData){
        dd($formData);
        dd( $contents = $formData->json()->all());
       
        MercadoPago\SDK::setAccessToken('TEST-4515228768272673-062018-62a67988a77c5b1d9e16d60db78985fc-607933933');
        $contents = $formData->json()->all();
        
        $payment = new MercadoPago\Payment();
        $payment->transaction_amount = $contents['transaction_amount'];
        $payment->token = $contents['token'];
        $payment->installments = $contents['installments'];
        $payment->payment_method_id = $contents['payment_method_id'];
        $payment->issuer_id = $contents['issuer_id'];
        $payer = new MercadoPago\Payer();
        $payer->email = $contents['payer']['email'];
        $payer->identification = [
            "type" => $contents['payer']['identification']['type'],
            "number" => $contents['payer']['identification']['number']
        ];
        
        $payment->payer = $payer;
        $payment->save();
        
        $response = [
            'status' => $payment->status,
            'status_detail' => $payment->status_detail,
            'id' => $payment->id
        ];
        
        return response()->json($response);
    }
    

    


}
