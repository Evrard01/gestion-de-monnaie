<?php

namespace App\Models;

use App\Models\Monaie;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Compte extends Model
{
    use HasFactory;



    protected $fillable = [
        'numero',
        'createur',
        'user_id',
        'solde',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function monaies()
    {
        return $this->belongsToMany(Monaie::class,'compte_monaies','compte_id','monaie_id')->withPivot('compte_id','monaie_id');
    }

}
