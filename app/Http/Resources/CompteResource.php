<?php

namespace App\Http\Resources;

use App\Models\Monaie;
use App\Models\CompteMonaie;
use Illuminate\Http\Resources\Json\JsonResource;

class CompteResource extends JsonResource
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
        $comptemonaie = CompteMonaie::where('compte_id',$this->id)->first();
        $monaie = Monaie::where('id',$comptemonaie->monaie_id)->first();
        return [
            "numero"=>$this->numero,
            "solde"=>$this->solde,
            "type_monaie"=>new MonaieResource($monaie)
        ];
    }
}
