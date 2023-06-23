<?php

namespace App\Http\Controllers\api\client;

use App\Http\Controllers\Controller;
use App\Http\Resources\PedidoResource;
use App\Models\Cliente;
use App\Models\Pedido;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ClientAPIController extends Controller
{
    use HttpResponses;

    public function login(Request $request){
        $jsonResponse = null;
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if($validator->fails()){
            $jsonResponse = $this->error($validator->errors(),"Credenciales invalidos.", 422);

        }else if($this->isUserValid($request)){
            $client = Cliente::where('mail', $request->email)->first();

            $request->session()->regenerate();

            $jsonResponse = $this->success([
                'client' => $client,
                'token' => $client->createToken('Api token of '. $client->mail)->plainTextToken
            ]);
        }else{
            $jsonResponse = $this->error('', 'Credenciales incorrectas', 401);
        }

        return $jsonResponse;
    }

    private function isUserValid($request){
        return Auth::guard('clients')->attempt([
            "mail" => $request->email, 
            "password" => $request->password
        ]);
    }

    public function register(Request $request){
        $jsonResponse = null;
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:cliente,mail',
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'password' => ['required', 'confirmed', Password::defaults()]
        ]);

        if($validator->fails()){
            $jsonResponse = $this->error($validator->errors(),"Error en la validación al registrarse.", 422);
        }else{
            $client = Cliente::create([
                'nombre' => $request->name,
                'apellido' => $request->lastname,
                'direccion' => $request->address,
                'mail' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            Auth::guard('clients')->login($client);

            $jsonResponse = $this->success([
                'client' => $client,
                'token' => $client->createToken('API token of '. $client->mail)->plainTextToken,
            ]);
        }

        return $jsonResponse;
    }

    public function logout(Request $request){
        Auth::guard('clients')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return $this->success([], "Sesion cerrada exitosamente");
    }

    public function showClientOrders(){
        $jsonResponse = null;

        $pedidos = Pedido::where('idCliente', Auth::guard('clients')->user()->id)->get();     
        $jsonResponse = PedidoResource::collection($pedidos);

        return $jsonResponse;
    }
}
