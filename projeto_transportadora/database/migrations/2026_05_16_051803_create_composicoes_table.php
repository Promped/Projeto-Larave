<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('composicoes', function (Blueprint $table) {
            $table->id();
            
            // Chave estrangeira que conecta ao insumo de origem do estoque real
            $table->foreignId('carga_origem_id')->constrained('insumos')->onDelete('cascade');
            
            // Quantidades suportando decimais (perfeito para TCC)
            $table->decimal('quantidade_usada', 10, 2);
            $table->string('produto_resultante');
            $table->decimal('quantidade_produzida', 10, 2);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('composicoes');
    }
};