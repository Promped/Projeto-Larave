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
        Schema::table('funcoes_visitantes', function (Blueprint $table) {
            if (!Schema::hasColumn('funcoes_visitantes', 'funcao')) {
                $table->string('funcao')->nullable()->after('empresa');
            }
            if (!Schema::hasColumn('funcoes_visitantes', 'periodo')) {
                $table->string('periodo')->nullable()->after('funcao');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('funcoes_visitantes', function (Blueprint $table) {
            if (Schema::hasColumn('funcoes_visitantes', 'funcao')) {
                $table->dropColumn('funcao');
            }
            if (Schema::hasColumn('funcoes_visitantes', 'periodo')) {
                $table->dropColumn('periodo');
            }
        });
    }
};
