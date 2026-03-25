<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('visitantes', function (Blueprint $table) {
    $table->id();
    $table->string('nome');
    $table->string('cpf')->unique();
    $table->string('empresa')->nullable();
    $table->string('motivo_visita');
    $table->string('responsavel_interno'); // Nome de quem vai receber o visitante
    $table->timestamp('data_hora_entrada')->nullable();
    $table->timestamp('data_hora_saida')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitantes');
    }
};
