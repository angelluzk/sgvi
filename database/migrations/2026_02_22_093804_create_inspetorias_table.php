<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inspetorias', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('congregacao');
            $table->string('sigla');
            $table->string('nome');
            $table->boolean('recebe_encomenda')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inspetorias');
    }
};