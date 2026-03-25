<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome', 
        'local_armazenagem', 
        'quantidade_atual', 
        'quantidade_minima', 
        'limite_maximo', 
        'unidade_medida'
    ];

    protected $casts = [
        'quantidade_atual' => 'float',
        'quantidade_minima' => 'float',
        'limite_maximo' => 'float',
    ];
}