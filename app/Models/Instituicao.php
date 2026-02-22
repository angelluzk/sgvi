<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Instituicao extends Model
{
    protected $fillable = [
        'nome',
        'cnpj',
        'telefone',
        'whatsapp',
        'cep',
        'endereco',
        'cidade_id',
        'inspetoria_id',
    ];

    public function cidade(): BelongsTo
    {
        return $this->belongsTo(Cidade::class);
    }

    public function inspetoria(): BelongsTo
    {
        return $this->belongsTo(Inspetoria::class);
    }

    public function vinculados(): HasMany
    {
        return $this->hasMany(Vinculado::class);
    }
}
