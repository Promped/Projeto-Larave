<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    use HasFactory;

    protected $table = 'insumos'; 

    protected $fillable = [
        'nome',
        'quantidade_atual',
        'quantidade_minima',
        'unidade_medida',
        'limite_maximo',
        'local_armazenagem'
    ];
}