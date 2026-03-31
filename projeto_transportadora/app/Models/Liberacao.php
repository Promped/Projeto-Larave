<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liberacao extends Model
{
    use HasFactory;

    // Nome da tabela no banco
    protected $table = 'liberacoes';

    // Campos que podem ser salvos em massa
    protected $fillable = [
        'movimentacao_id',
        'user_id',
        'conferencia_documental',
        'conferencia_fisica',
        'observacoes',
        'data_liberacao'
    ];

    // Relacionamento: Uma liberação pertence a uma movimentação
    public function movimentacao()
    {
        return $this->belongsTo(MovimentacaoPatio::class, 'movimentacao_id');
    }

    // Relacionamento: Uma liberação foi feita por um usuário (Fiscal)
    public function fiscal()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}