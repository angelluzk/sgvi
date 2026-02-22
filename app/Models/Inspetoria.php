<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Inspetoria extends Model
{
    protected $fillable = [
        'congregacao',
        'sigla',
        'nome',
        'recebe_encomenda',
    ];

    public function instituicoes(): HasMany
    {
        return $this->hasMany(Instituicao::class);
    }
}
