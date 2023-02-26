<?php

namespace App\Http\Controllers\Api;

use App\Models\Type;
use App\Models\Compte;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class TransactionController extends Controller
{
    //

    public function depot(Request $request)
    {
        // if(Gate::allows('Administration',auth()->user())){
        $validation = $request->validate([
            "numero" => "required",
            "montant" => "required|numeric",
        ]);

        $type = Type::where('libelle', 'Depot')->first();
        $compte = Compte::where('numero', $request->numero)->first();

        if (isset($compte)) {
            $transaction = Transaction::create([
                "compte_id" => $compte->id,
                "type_id" => $type->id,
                "soldeAvant" => $compte->solde,
                "montantTransaction" => $request->montant,
                "soldeApres" => $compte->solde + $request->montant,
            ]);

            $compte->solde = $transaction->soldeApres;
            $compte->save();

            return response([
                "status" => true,
                "message" => "Votre depot c'est bien effectue. Votre solde est de :" . $transaction->soldeApres,
            ]);
        } else {
            return response([
                "status" => false,
                "message" => "Ce numero n'existe pas. Veuillez reasayer avec un autre numero !"
            ]);
        }
        // }
    }

    public function retrait(Request $request)
    {
        $validation = $request->validate([
            "numero" => "required",
            "montant" => "required|numeric",
        ]);

        $type = Type::where('libelle', 'Retrait')->first();
        $compte = Compte::where('numero', $request->numero)->first();

        if (isset($compte)) {
            $transaction = Transaction::create([
                "compte_id" => $compte->id,
                "type_id" => $type->id,
                "soldeAvant" => $compte->solde,
                "montantTransaction" => $request->montant,
                "soldeApres" => $compte->solde - $request->montant,
            ]);

            $compte->solde = $transaction->soldeApres;
            $compte->save();

            return response([
                "status" => true,
                "message" => "Votre retrait c'est bien effectue. Votre solde est de :" . $transaction->soldeApres,
            ]);
        } else {
            return response([
                "status" => false,
                "message" => "Ce numero n'existe pas. Veuillez reasayer avec un autre numero !"
            ]);
        }
    }
}
