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
    Schema::create('agendamentos', function (Blueprint $table) {
    $table->id();
    $table->foreignId('veiculo_id')->constrained('veiculos');
    $table->foreignId('motorista_id')->constrained('motoristas');
    $table->foreignId('carga_id')->constrained('cargas');
    $table->foreignId('vaga_id')->constrained('vagas_patio'); // ADICIONE ESTA LINHA
    $table->date('data_agendamento');
    $table->time('horario_inicio');
    $table->time('horario_fim');
    $table->string('status')->default('pendente');
    $table->timestamps();
});
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendamentos');
    }
};
