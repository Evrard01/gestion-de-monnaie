<?php

namespace App\Http\Controllers\Api;

use App\Models\Type;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TypeController extends Controller
{
    //


    public function user(Request $request)
    {
        $validation = $request->validate([
            "libelle"=>"required|string"
        ]);

        $type = Type::create([
            "libelle"=>$request->libelle,
            "typable_type"=>"App\Models\User",
            "typable_id"=>auth()->user()->id,
        ]);


        return response([
            "status"=>true,
            "message"=>"Un type utilisateur a été ajouté",
            "type"=>$type
        ]);

    }
}
