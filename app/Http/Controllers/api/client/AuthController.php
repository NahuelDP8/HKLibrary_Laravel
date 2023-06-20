<?php

namespace App\Http\Controllers\api\client;

use App\Http\Controllers\Controller;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(){
        return "Login.";
    }

    public function register(){
        return response()->json("Register. asd");
    }
}
