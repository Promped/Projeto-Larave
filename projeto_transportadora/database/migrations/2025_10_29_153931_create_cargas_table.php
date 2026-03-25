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
    Schema::create('cargas', function (Blueprint $table) {
        $table->id();
        $table->string('tipo'); // Ex: Eucalipto, Pinus, Areia
        $table->string('unidade_medida')->default('ton'); // Ex: ton, kg, m3
        $table->string('descricao')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cargas');
    }
};
