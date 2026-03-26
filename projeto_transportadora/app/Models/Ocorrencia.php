<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ocorrencia extends Model
{
    protected $table = 'ocorrencias_patio';

    protected $fillable = [
        'movimentacao_id',
        'tipo',
        'descricao',
        'evidencias'
    ];

    public function movimentacao()
    {
        return $this->belongsTo(MovimentacaoPatio::class, 'movimentacao_id');
    }
}