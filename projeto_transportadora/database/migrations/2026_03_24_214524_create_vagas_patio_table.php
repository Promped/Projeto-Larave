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
        Schema::create('vagas_patio', function (Blueprint $table) {
    $table->id();
    $table->foreignId('area_id')->constrained('areaspatio'); // SEM underline
    $table->string('identificacao_vaga'); // Ex: Vaga 01, Doca A
    $table->enum('status', ['disponivel', 'ocupada', 'manutencao'])->default('disponivel');
    $table->foreignId('veiculo_id')->nullable()->constrained('veiculos'); // Veículo que está nela
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vagas_patio');
    }
};
