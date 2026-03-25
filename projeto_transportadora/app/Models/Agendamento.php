<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    protected $fillable = [
        'veiculo_id', 
        'motorista_id', 
        'vaga_id', 
        'carga_id',
        'data_agendamento', 
        'horario_inicio', 
        'horario_fim', 
        'status'
    ];

    // Relacionamento com Veículo (F_B01)
    public function veiculo() {
        return $this->belongsTo(Veiculo::class);
    }

    // Relacionamento com Motorista (F_B02)
    public function motorista() {
        return $this->belongsTo(Motorista::class);
    }

    // Relacionamento com a Vaga (F_B07)
    public function vaga() {
        return $this->belongsTo(VagasPatio::class, 'vaga_id');
    }
}