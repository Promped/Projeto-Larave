<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovimentacaoPatio extends Model {
    
    protected $table = 'movimentacoes_patio';

    protected $fillable = [
        'agendamento_id', 
        'horario_entrada', 
        'horario_saida', 
        'peso_real_descarga', 
        'status', 
        'observacoes'
    ];

    // Indica ao Laravel que estes campos são datas (ajuda na formatação na View)
    protected $casts = [
        'horario_entrada' => 'datetime',
        'horario_saida' => 'datetime',
    ];

    /**
     * Relacionamento com o Agendamento (Pai da movimentação)
     */
    public function agendamento() {
        return $this->belongsTo(Agendamento::class, 'agendamento_id');
    }

    /**
     * Atalho para acessar a carga diretamente (Opcional, mas ajuda no Controller)
     * Permite usar $movimentacao->carga->tipo
     */
    public function carga() {
        return $this->hasOneThrough(
            Carga::class, 
            Agendamento::class, 
            'id', // Chave estrangeira em Agendamento
            'id', // Chave estrangeira em Carga
            'agendamento_id', // Chave local em MovimentacaoPatio
            'carga_id' // Chave local em Agendamento
        );
    }
}