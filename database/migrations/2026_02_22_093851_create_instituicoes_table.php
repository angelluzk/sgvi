<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('instituicoes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('nome');
            $table->string('cnpj')->nullable();
            $table->string('telefone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('cep')->nullable();
            $table->string('endereco');
            $table->foreignId('cidade_id')->constrained('cidades');
            $table->foreignId('inspetoria_id')->constrained('inspetorias');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('instituicoes');
    }
};
