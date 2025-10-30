<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Veiculo extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'placa',
        'tipo',
        'modelo',
        'transportadora_id',
        'status_acesso',
    ];

    public function transportadora()
    {
        return $this->belongsTo(Transportadora::class);
    }

    public function motoristas()
    {
        return $this->belongsToMany(Motorista::class, 'motorista_veiculo')
                    ->withPivot('is_atual')
                    ->withTimestamps();
    }

    public function motoristaAtual()
    {
        return $this->belongsToMany(Motorista::class, 'motorista_veiculo')
                    ->wherePivot('is_atual', true)
                    ->first();
    }

    public function cargas()
    {
        return $this->hasMany(Carga::class);
    }
}
