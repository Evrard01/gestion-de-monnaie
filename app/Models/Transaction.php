<?php

namespace App\Models;

use App\Models\Type;
use App\Models\Compte;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'compte_id',
        'type_id',
        'soldeAvant',
        'montantTransaction',
        'soldeApres',
        'recpteur',
    ];


    public function compte()
    {
        return $this->belongsTo(Compte::class);
    }

    public function type()
    {
        return $this->morphOne(Type::class,'typable');
    }
}
