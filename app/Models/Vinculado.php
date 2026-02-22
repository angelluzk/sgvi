<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vinculado extends Model
{
    protected $fillable = [
        'pessoa_id',
        'instituicao_id',
        'cargo_id',
        'ativo',
    ];

    public function pessoa(): BelongsTo
    {
        return $this->belongsTo(Pessoa::class);
    }

    public function instituicao(): BelongsTo
    {
        return $this->belongsTo(Instituicao::class);
    }

    public function cargo(): BelongsTo
    {
        return $this->belongsTo(Cargo::class);
    }
}
