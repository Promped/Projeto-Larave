<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaPatio extends Model
{
    protected $table = "areaspatio";
    protected $fillable = [
        'nome',
        'descricao',
        'capacidade',
        'tipo',
        'status'
    ];

    protected $casts = [
        'capacidade' => 'integer',
    ];
}
