<?php

namespace App\Http\Controllers\api\client;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(){
        return "Login.";
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
            $jsonResponse = $this->error($validator->errors(),"Error en la validación", 422);
        }else{
            $client = Cliente::create([
                'nombre' => $request->name,
                'apellido' => $request->lastname,
                'direccion' => $request->address,
                'mail' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $jsonResponse = $this->success([
                'client' => $client,
                'token' => $client->createToken('API token of '. $client->nombre)->plainTextToken,
            ]);
        }

        return $jsonResponse;
    }
}
