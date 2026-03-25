<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    protected $fillable = ['nome', 'quantidade_atual', 'quantidade_minima', 'unidade_medida'];
}
