<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::table('ocorrencias_patio', function (Blueprint $table) {
        // Alteramos para string para aceitar qualquer categoria de erro
        $table->string('tipo')->change(); 
    });
}

public function down(): void
{
    Schema::table('ocorrencias_patio', function (Blueprint $table) {
        // Caso precise voltar atrás, você define o que era antes (exemplo: enum)
        // $table->enum('tipo', ['Aviso', 'Grave'])->change();
    });
}
};
