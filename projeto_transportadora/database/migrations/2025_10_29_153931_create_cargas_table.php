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
            $table->string('tipo');
            $table->decimal('peso', 10, 2)->nullable();
            $table->decimal('volume', 10, 2)->nullable();
            $table->string('origem')->nullable();
            $table->string('destino')->nullable();
            $table->unsignedBigInteger('veiculo_id')->nullable();
            $table->unsignedBigInteger('motorista_id')->nullable();
            $table->timestamps();

            $table->foreign('veiculo_id')->references('id')->on('veiculos')->onDelete('set null');
            $table->foreign('motorista_id')->references('id')->on('motoristas')->onDelete('set null');
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
