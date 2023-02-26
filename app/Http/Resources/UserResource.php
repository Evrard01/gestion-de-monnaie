<?php

namespace App\Http\Resources;

use App\Models\Type;
use App\Http\Resources\TypeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        $type = Type::find($this->type_id);
        return [
            "nom"=>$this->nom,
            "prenom"=>$this->prenom,
            "dateNaissance"=>$this->dateNaissance,
            "lieuNaissance"=>$this->lieuNaissance,
            "email"=>$this->email,
            "Type "=>[
                "libelle"=>$type->libelle
            ]
        ];
    }
}
