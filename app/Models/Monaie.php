<?php

namespace App\Models;

use App\Models\Type;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Monaie extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type_id',
        'designation',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comptes()
    {
        return $this->belongsToMany(Compte::class,'compte_monaies','monaie_id','compte_id')->withPivot('compte_id','monaie_id');
    }

    public function type()
    {
        return $this->morphOne(Type::class,'typable');
    }
}
