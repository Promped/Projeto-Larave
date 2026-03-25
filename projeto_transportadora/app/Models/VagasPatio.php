<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VagasPatio extends Model
{
    // MUITO IMPORTANTE: Verifique se o nome da tabela está correto aqui
    protected $table = 'vagas_patio'; 

    protected $fillable = [
        'area_id',
        'identificacao_vaga',
        'status'
    ];

    public function area()
    {
        // Se o seu model de áreas for 'Areaspatio', mantenha assim:
        return $this->belongsTo(Areaspatio::class, 'area_id');
    }
}