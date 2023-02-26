<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       $users = User::all();
       if ($users->count()>=1) {
        return response()->json([
            "status"=>true,
            "message"=>"Tous les utilisateurs",
            "utilisateurs"=> UserResource::collection(User::all())
        ]);
       }else{
        return response([
            "status"=>false,
            "message"=>"Aucun utilisateur n'est trouve",
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
        if(auth()->user()->type->libelle == "Administrateur"){
            $validation = $request->validate([
                "nom"=>"required|string",
                "prenom"=>"required|string",
                "type_id"=>"required",
                "dateNaissance"=>"required|date",
                "lieuNaissance"=>"required",
                "email"=>"required|email"
            ]);

            $user = User::create([
                "nom"=>$request->nom,
                "prenom"=>$request->prenom,
                "type_id"=>$request->type_id,
                "dateNaissance"=>$request->dateNaissance,
                "lieuNaissance"=>$request->lieuNaissance,
                "email"=>$request->email,
                "password"=>'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
            ]);

            return response([
                "status"=>true,
                "message"=>"Utilisateur ajouter avec succes",
                "utilisateur"=>new UserResource($user)
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
        $user = user::where('id',$id)->first();
        if(isset($user)){
            return response()->json([
                "status"=>true,
                "message"=>"Utilisateur trouvé",
                "utilisateur"=>new UserResource($user)
            ]);
        }else{
           return response([
                "status"=>true,
                "message"=>"Utilisateur non trouvé",
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
        $user = user::where('id',$id)->first();
        if(isset($user)){
            $validation = $request->validate([
                "nom"=>"required|string",
                "prenom"=>"required|string",
                "type_id"=>"required",
                "dateNaissance"=>"required|date",
                "lieuNaissance"=>"required",
                "email"=>"required|email"
            ]);

            $user->nom=$request->nom;
            $user->prenom=$request->prenom;
            $user->type_id=$request->type_id;
            $user->dateNaissance=$request->dateNaissance;
            $user->lieuNaissance=$request->lieuNaissance;
            $user->email=$request->email;
            $user->save();

            return response([
                "status"=>true,
                "message"=>"Utilisateur modifié avec succes",
                "utilisateur"=>new UserResource($user)
            ]);
        }else{
            return response([
                "status"=>true,
                "message"=>"Utilisateur non trouvé",
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
        $user = user::where('id',$id)->first();

        if(isset($user)){
            $user->delete();
            return response([
                "status"=>true,
                "message"=>"Utilisateur supprimé avec succes",
            ]);
        }else{
            return response([
                "status"=>true,
                "message"=>"Utilisateur non trouvé",
            ]);
        }
    }
}
