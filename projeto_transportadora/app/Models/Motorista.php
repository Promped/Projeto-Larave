<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transportadora;

class Motorista extends Model
{
    protected $table = "motoristas";
    
    protected $fillable = [
        'nome',
        'cpf',
        'cnh',
        'telefone',
        'transportadora_id'
    ];

    public function transportadora()
    {
        return $this->belongsTo(Transportadora::class);
    }
}
