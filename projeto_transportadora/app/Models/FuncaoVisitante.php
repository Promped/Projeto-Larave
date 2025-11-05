<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuncaoVisitante extends Model
{
    use HasFactory;

    protected $table = 'funcoes_visitantes';

    protected $fillable = [
        'descricao',
        'nome',
        'documento',
        'empresa',
        'motivo_visita',
        'area_visitada',
        'hora_entrada',
        'hora_saida'
    ];

    /**
     * Casts
     */
    protected $casts = [
        'hora_entrada' => 'datetime:H:i',
        'hora_saida' => 'datetime:H:i',
    ];

    /**
     * Relacionamento com a área (se existir a model Areaspatio)
     */
    public function area()
    {
        return $this->belongsTo(Areaspatio::class, 'area_visitada');
    }
}