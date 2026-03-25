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
        $table->foreignId('veiculo_id')->constrained('veiculos');
        $table->timestamp('data_hora_entrada')->nullable(); // F_F03
        $table->timestamp('data_hora_saida')->nullable();   // F_F03
        $table->foreignId('user_id_responsavel')->constrained('users'); // Auditoria F_F03/F_F05
        $table->text('checklist_conferencia')->nullable(); // F_F05
        $table->string('protocolo_auditoria')->unique(); // F_F03
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
