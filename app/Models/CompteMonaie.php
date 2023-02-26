<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompteMonaie extends Model
{
    use HasFactory;

    protected $fillable = [
        'compte_id',
        'monaie_id',
    ];
}
