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
    Schema::create('ocorrencias_patio', function (Blueprint $table) {
        $table->id();
        $table->foreignId('movimentacao_id')->nullable()->constrained('movimentacoes_patio');
        $table->enum('tipo', ['seguranca', 'avaria', 'atraso', 'nao_conformidade']); // F_F04
        $table->text('descricao');
        $table->string('evidencias')->nullable(); // Para fotos/docs F_F04
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ocorrencias_patio');
    }
};
