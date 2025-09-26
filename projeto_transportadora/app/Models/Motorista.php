<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Motorista extends Model
{
    protected $table = "motoristas";
    protected $fillable = ["descricao"];
}
