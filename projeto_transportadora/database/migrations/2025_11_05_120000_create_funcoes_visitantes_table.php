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
        // Se a tabela já existir (migração anterior), apenas adiciona as colunas que faltam.
        if (Schema::hasTable('funcoes_visitantes')) {
            Schema::table('funcoes_visitantes', function (Blueprint $table) {
                if (!Schema::hasColumn('funcoes_visitantes', 'nome')) {
                    $table->string('nome')->after('id');
                }
                if (!Schema::hasColumn('funcoes_visitantes', 'documento')) {
                    $table->string('documento')->nullable()->after('nome');
                }
                if (!Schema::hasColumn('funcoes_visitantes', 'empresa')) {
                    $table->string('empresa')->nullable()->after('documento');
                }
                if (!Schema::hasColumn('funcoes_visitantes', 'motivo_visita')) {
                    $table->text('motivo_visita')->nullable()->after('empresa');
                }
                if (!Schema::hasColumn('funcoes_visitantes', 'area_visitada')) {
                    $table->unsignedBigInteger('area_visitada')->nullable()->after('motivo_visita');
                }
                if (!Schema::hasColumn('funcoes_visitantes', 'hora_entrada')) {
                    $table->time('hora_entrada')->nullable()->after('area_visitada');
                }
                if (!Schema::hasColumn('funcoes_visitantes', 'hora_saida')) {
                    $table->time('hora_saida')->nullable()->after('hora_entrada');
                }
            });
        } else {
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
