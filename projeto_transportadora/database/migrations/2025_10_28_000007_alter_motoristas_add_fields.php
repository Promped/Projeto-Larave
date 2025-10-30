<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('motoristas', function (Blueprint $table) {
            if (!Schema::hasColumn('motoristas', 'nome')) {
                $table->string('nome')->after('id');
            }
            if (!Schema::hasColumn('motoristas', 'cpf')) {
                $table->string('cpf')->unique()->after('nome');
            }
            if (!Schema::hasColumn('motoristas', 'cnh')) {
                $table->string('cnh')->nullable()->after('cpf');
            }
            if (!Schema::hasColumn('motoristas', 'telefone')) {
                $table->string('telefone')->nullable()->after('cnh');
            }
            if (!Schema::hasColumn('motoristas', 'transportadora_id')) {
                $table->foreignId('transportadora_id')->nullable()->constrained('transportadoras')->onDelete('cascade')->after('telefone');
            }
            if (!Schema::hasColumn('motoristas', 'deleted_at')) {
                $table->softDeletes();
            }
        });
    }

    public function down(): void
    {
        Schema::table('motoristas', function (Blueprint $table) {
            if (Schema::hasColumn('motoristas', 'transportadora_id')) {
                $table->dropForeign(['transportadora_id']);
                $table->dropColumn('transportadora_id');
            }
            if (Schema::hasColumn('motoristas', 'telefone')) {
                $table->dropColumn('telefone');
            }
            if (Schema::hasColumn('motoristas', 'cnh')) {
                $table->dropColumn('cnh');
            }
            if (Schema::hasColumn('motoristas', 'cpf')) {
                $table->dropUnique(['cpf']);
                $table->dropColumn('cpf');
            }
            if (Schema::hasColumn('motoristas', 'nome')) {
                $table->dropColumn('nome');
            }
            if (Schema::hasColumn('motoristas', 'deleted_at')) {
                $table->dropColumn('deleted_at');
            }
        });
    }
};