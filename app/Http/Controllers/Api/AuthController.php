<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //


    public function login(Request $request)
    {
        $validation = $request->validate([
            "email"=>"required|email",
            "password"=>"required"
        ]);


        if (!Auth::attempt($validation)) {

           return response([
            'status'=>false,
            'message'=>"Les informations fournies ne sont pas valides. Veuillez reasayer"
           ]);
        }

        $token = auth()->user()->createToken("auth_token")->accessToken;


        return response([
            "status"=>true,
            "message"=>"Soyez la bienvenue",
            "token"=>$token
        ]);
    }


    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();

        return response([
            "status"=>true,
            "message"=>"Aurevoir"
        ]);
    }
}
