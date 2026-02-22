<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pessoa extends Model
{
    protected $fillable = [
        'nome_completo',
        'email',
        'telefone',
    ];

    public function vinculados(): HasMany
    {
        return $this->hasMany(Vinculado::class);
    }

    // Relacionamento Many-to-Many direto com Instituições via tabela pivô vinculados..
    public function instituicoes(): BelongsToMany
    {
        return $this->belongsToMany(Instituicao::class, 'vinculados')
            ->withPivot('cargo_id', 'ativo')
            ->withTimestamps();
    }
}
