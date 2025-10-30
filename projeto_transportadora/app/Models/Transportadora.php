<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Motorista;

class Transportadora extends Model
{
    protected $table = "transportadoras";
    protected $fillable = [
        'razao_social',
        'cnpj',
        'endereco',
        'telefone',
        'email'
    ];

    /**
     * Relacionamento: transportadora tem muitos motoristas
     *
     * @return HasMany
     */
    public function motoristas(): HasMany
    {
        return $this->hasMany(Motorista::class);
    }

}