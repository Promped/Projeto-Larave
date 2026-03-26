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
        Schema::create('movimentacoes_patio', function (Blueprint $table) {
    $table->id();
    $table->foreignId('agendamento_id')->constrained('agendamentos');
    $table->dateTime('horario_entrada')->nullable();
    $table->dateTime('horario_saida')->nullable();
    $table->decimal('peso_real_descarga', 10, 2)->nullable(); // O que realmente entrou
    $table->string('status')->default('Em Espera'); // Em Espera, Em Descarga, Finalizado, Ocorrência
    $table->text('observacoes')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimentacoes_patio');
    }
};
