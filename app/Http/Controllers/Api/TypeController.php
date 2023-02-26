<?php

namespace App\Http\Controllers\Api;

use App\Models\Type;
use App\Models\User;
// use
// use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TypeResource;

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


    public function monaie(Request $request)
    {
        $validation = $request->validate([
            "libelle"=>"required|string"
        ]);

        $type = Type::create([
            "libelle"=>$request->libelle,
            "typable_type"=>"App\Models\Monaie",
            "typable_id"=>auth()->user()->id,
        ]);


        return response([
            "status"=>true,
            "message"=>"Un type de monaie a été ajouté",
            "type"=>$type
        ]);

    }


    public function transaction(Request $request)
    {
        $validation = $request->validate([
            "libelle"=>"required|string"
        ]);

        $type = Type::create([
            "libelle"=>$request->libelle,
            "typable_type"=>"App\Models\Transaction",
            "typable_id"=>auth()->user()->id,
        ]);


        return response([
            "status"=>true,
            "message"=>"Un type de transaction a été ajouté",
            "type"=>$type
        ]);

    }


    public function index()
    {
        $type = Type::all();
        if ($type->count()>=1) {
            return response(
                [
                    "status"=>true,
                    "message"=>"Tous les types possibles sont :",
                    "type"=>TypeResource::collection($type),
                ]
                );
        }else{
            return response([
                "status"=>false,
                "message"=>"Aucun type pour le moment"
            ]);
        }
    }

}
