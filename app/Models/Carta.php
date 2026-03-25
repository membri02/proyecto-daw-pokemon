<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carta extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'tipo',
        'rareza',
        'imagen_url',
        'hp',
        'peso',
        'altura',
        'pokedex_no',
        'ataque1_name',
        'ataque1_damage',
        'ataque2_name',
        'ataque2_damage',
        'es_holo',
        'es_legendario'
    ];
}