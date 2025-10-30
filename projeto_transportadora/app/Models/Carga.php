<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Carga extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo',
        'peso',
        'volume',
        'origem',
        'destino',
        'veiculo_id',
        'motorista_id'
    ];

    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class);
    }

    public function motorista()
    {
        return $this->belongsTo(Motorista::class);
    }
}
