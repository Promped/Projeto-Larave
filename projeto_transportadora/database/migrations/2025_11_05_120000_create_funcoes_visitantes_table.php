<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcoes_visitantes', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('documento')->nullable();
            $table->string('empresa')->nullable();
            $table->text('motivo_visita')->nullable();
            $table->unsignedBigInteger('area_visitada')->nullable();
            $table->time('hora_entrada')->nullable();
            $table->time('hora_saida')->nullable();
            $table->timestamps();

            // se existir tabela de areas (areaspatio / areas_patios), descomente e ajuste abaixo
            // $table->foreign('area_visitada')->references('id')->on('areaspatio')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('funcoes_visitantes');
    }
};
