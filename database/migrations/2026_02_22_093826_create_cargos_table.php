<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cargos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('nome');
            $table->string('nivel_perfil')->nullable(); // Adicionado nullable caso o perfil não seja obrigatório de início
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cargos');
    }
};
