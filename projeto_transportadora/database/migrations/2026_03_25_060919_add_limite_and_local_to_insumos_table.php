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
    Schema::table('insumos', function (Blueprint $table) {
        // Limite para alertar pátio lotado
        $table->decimal('limite_maximo', 10, 2)->default(100); 
        
        // Define se é 'Almoxarifado', 'Pátio de Madeira', etc.
        $table->string('local_armazenagem')->default('Almoxarifado'); 
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('insumos', function (Blueprint $table) {
            //
        });
    }
};
