<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('insumos', function (Blueprint $table) {
        $table->id();
        $table->string('nome'); // Ex: Aço, Plástico
        $table->decimal('quantidade_atual', 10, 2);
        $table->decimal('quantidade_minima', 10, 2); // Para o alerta F_S04
        $table->string('unidade_medida'); // kg, m, un
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insumos');
    }
};
