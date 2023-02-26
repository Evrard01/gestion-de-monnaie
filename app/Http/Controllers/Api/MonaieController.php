<?php

namespace App\Http\Controllers\Api;

use App\Models\Monaie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MonaieResource;

class MonaieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (auth()->user()->type->libelle == "Administrateur") {
            return response()->json([
                "status" => true,
                "monaies" => MonaieResource::collection(monaie::all())
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
        if (auth()->user()->type->libelle == "Administrateur") {
            $validation = $request->validate([
                "designation" => "required|string",
                "type_id" => "required"
            ]);

            $monaie = Monaie::create([
                "designation" => $request->designation,
                "type_id" => $request->type_id,
                "user_id" => auth()->user()->id
            ]);

            return response([
                "status" => true,
                "message" => "Ajout reussit",
                "monaie" => new MonaieResource($monaie)
            ]);
        } else {
            return response([
                "status" => false,
                "message" => "Vou n'avez pas les autorisation"
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
        if (auth()->user()->type->libelle == "Administrateur") {
            $monaie = Monaie::find($id);
            if (isset($monaie)) {
                return response()->json([
                    "status" => true,
                    // "message"=>"Ajout reussit",
                    "monaie" => new MonaieResource($monaie)
                ]);
            } else {
                return response([
                    "status" => false,
                    "message" => "Cet identifiant n'existe pas"
                ]);
            }
        } else {
            return response([
                "status" => false,
                "message" => "Vous n'avez pas les autorisation"
            ]);
        }
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
        $monaie = Monaie::find($id);
        if (auth()->user()->type->libelle == "Administrateur" && $monaie->user_id == auth()->user()->id) {
            if (isset($monaie)) {
                $validation = $request->validate([
                    "designation" => "required|string",
                    "type_id" => "required"
                ]);

                $monaie->designation = $request->designation;
                $monaie->type_id = $request->type_id;
                return response([
                    "status" => true,
                    "message" => "Modification reussit",
                    "monaie" => new MonaieResource($monaie)
                ]);
            } else {
                return response([
                    "status" => false,
                    "message" => "Cet identifiant n'existe pas"
                ]);
            }
        } else {
            return response([
                "status" => false,
                "message" => "Vous n'avez pas les autorisation"
            ]);
        }
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
        $monaie = Monaie::find($id);
        if (auth()->user()->type->libelle == "Administrateur" && $monaie->user_id == auth()->user()->id) {
            if (isset($monaie) && count($monaie->comptes)<1) {
                $monaie->delete();
                return response([
                    "status" => true,
                    "message" => "Suppression reussit",
                ]);
            } else {
                return response([
                    "status" => false,
                    "message" => "Cet identifiant n'existe pas"
                ]);
            }
        } else {
            return response([
                "status" => false,
                "message" => "Vous n'avez pas les autorisation"
            ]);
        }
    }
}
