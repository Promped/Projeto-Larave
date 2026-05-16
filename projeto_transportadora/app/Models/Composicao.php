<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Composicao extends Model
{
    use HasFactory;

    // Define explicitamente o nome da tabela no banco de dados
    protected $table = 'composicoes';

    // Libera os campos para gravação em massa (Resolve o erro MassAssignmentException)
    protected $fillable = [
        'carga_origem_id',
        'quantidade_usada',
        'produto_resultante',
        'quantidade_produzida',
    ];
}