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
        // Pivot table para motoristas e veículos
        Schema::create('motorista_veiculo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('motorista_id');
            $table->unsignedBigInteger('veiculo_id');
            $table->boolean('is_atual')->default(false);
            $table->timestamps();

            $table->foreign('motorista_id')->references('id')->on('motoristas')->onDelete('cascade');
            $table->foreign('veiculo_id')->references('id')->on('veiculos')->onDelete('cascade');

            $table->unique(['motorista_id', 'veiculo_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('veiculos_relationships');
    }
};
