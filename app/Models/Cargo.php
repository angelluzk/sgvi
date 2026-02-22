<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cargo extends Model
{
    protected $fillable = [
        'nome',
        'nivel_perfil',
    ];

    public function vinculados(): HasMany
    {
        return $this->hasMany(Vinculado::class);
    }
}
