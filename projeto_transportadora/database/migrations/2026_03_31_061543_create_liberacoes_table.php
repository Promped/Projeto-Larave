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
            Schema::create('liberacoes', function (Blueprint $table) {
                $table->id();
                // Conexão com a movimentação
                $table->foreignId('movimentacao_id')->constrained('movimentacoes_patio')->onDelete('cascade');
                
                // Fiscal responsável (usuário logado)
                $table->foreignId('user_id')->constrained('users');
                
                // Itens de conferência do F_F05
                $table->boolean('conferencia_documental')->default(false);
                $table->boolean('conferencia_fisica')->default(false);
                
                $table->text('observacoes')->nullable();
                $table->timestamp('data_liberacao');
                $table->timestamps();
            });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('liberacoes');
    }
};
