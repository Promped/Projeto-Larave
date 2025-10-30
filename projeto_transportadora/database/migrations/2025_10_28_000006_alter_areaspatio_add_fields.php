<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('areaspatio', function (Blueprint $table) {
            if (!Schema::hasColumn('areaspatio', 'nome')) {
                $table->string('nome')->after('id');
            }
            if (!Schema::hasColumn('areaspatio', 'descricao')) {
                $table->string('descricao')->nullable()->after('nome');
            }
            if (!Schema::hasColumn('areaspatio', 'capacidade')) {
                $table->integer('capacidade')->default(0)->after('descricao');
            }
            if (!Schema::hasColumn('areaspatio', 'tipo')) {
                $table->string('tipo')->nullable()->after('capacidade');
            }
            if (!Schema::hasColumn('areaspatio', 'status')) {
                $table->string('status')->default('disponivel')->after('tipo');
            }
            if (!Schema::hasColumn('areaspatio', 'deleted_at')) {
                $table->softDeletes();
            }
        });
    }

    public function down(): void
    {
        Schema::table('areaspatio', function (Blueprint $table) {
            if (Schema::hasColumn('areaspatio', 'status')) {
                $table->dropColumn('status');
            }
            if (Schema::hasColumn('areaspatio', 'tipo')) {
                $table->dropColumn('tipo');
            }
            if (Schema::hasColumn('areaspatio', 'capacidade')) {
                $table->dropColumn('capacidade');
            }
            if (Schema::hasColumn('areaspatio', 'descricao')) {
                $table->dropColumn('descricao');
            }
            if (Schema::hasColumn('areaspatio', 'nome')) {
                $table->dropColumn('nome');
            }
            if (Schema::hasColumn('areaspatio', 'deleted_at')) {
                $table->dropColumn('deleted_at');
            }
        });
    }
};