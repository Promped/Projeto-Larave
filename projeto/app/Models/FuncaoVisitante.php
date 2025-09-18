<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuncaoVisitante extends Model
{
    
    protected $table = "funcoes_visitantes";
    protected $fillable = ["descricao"];

}
