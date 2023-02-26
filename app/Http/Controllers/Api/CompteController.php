<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Compte;
use App\Models\Monaie;
use App\Models\CompteMonaie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Resources\CompteResource;
use App\Http\Resources\MonaieResource;

class CompteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        if(Gate::allows('Administrateur',auth()->user())){
            return response()->json([
                "status"=>true,
                "comptes"=>Compte::all()
            ]);
        }else{
            return response([
                "status"=>false,
                "message"=>"Vous n'avez pas les autorisations nécessaire"
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $user = User::find($request->user_id);
        if(Gate::allows('Administrateur',auth()->user()) && count($user->comptes)!=2){
            $validation = $request->validate([
                "numero"=>"required|unique:comptes",
                "user_id"=>"required",
                "solde"=>"nullable",
                "monaie_id"=>"required"
            ]);

            $compte = Compte::create([
                "numero"=>$request->numero,
                "createur"=>auth()->user()->id,
                "user_id"=>$request->user_id,
                "solde"=>0.00
            ]);

            $compteMonaie = CompteMonaie::create([
                "compte_id"=>$compte->id,
                "monaie_id"=>$request->monaie_id
            ]);

            return response([
                "status"=>true,
                "message"=>"Le compte a ete creer avec succes !",
                "compte"=> new CompteResource($compte),
            ]);
        }else{
            return response([
                "status"=>false,
                "message"=>"Vous n'avez pas les autorisations nécessaire ou vous avez plus d'un compte"
            ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
