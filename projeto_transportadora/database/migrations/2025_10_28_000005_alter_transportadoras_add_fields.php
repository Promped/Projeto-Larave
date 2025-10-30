<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transportadoras', function (Blueprint $table) {
            if (!Schema::hasColumn('transportadoras', 'razao_social')) {
                $table->string('razao_social')->after('id');
            }
            if (!Schema::hasColumn('transportadoras', 'cnpj')) {
                $table->string('cnpj')->unique()->after('razao_social');
            }
            if (!Schema::hasColumn('transportadoras', 'endereco')) {
                $table->string('endereco')->nullable()->after('cnpj');
            }
            if (!Schema::hasColumn('transportadoras', 'telefone')) {
                $table->string('telefone')->nullable()->after('endereco');
            }
            if (!Schema::hasColumn('transportadoras', 'email')) {
                $table->string('email')->unique()->nullable()->after('telefone');
            }
            if (!Schema::hasColumn('transportadoras', 'deleted_at')) {
                $table->softDeletes();
            }
        });
    }

    public function down(): void
    {
        Schema::table('transportadoras', function (Blueprint $table) {
            if (Schema::hasColumn('transportadoras', 'email')) {
                $table->dropColumn('email');
            }
            if (Schema::hasColumn('transportadoras', 'telefone')) {
                $table->dropColumn('telefone');
            }
            if (Schema::hasColumn('transportadoras', 'endereco')) {
                $table->dropColumn('endereco');
            }
            if (Schema::hasColumn('transportadoras', 'cnpj')) {
                $table->dropUnique(['cnpj']);
                $table->dropColumn('cnpj');
            }
            if (Schema::hasColumn('transportadoras', 'razao_social')) {
                $table->dropColumn('razao_social');
            }
            if (Schema::hasColumn('transportadoras', 'deleted_at')) {
                $table->dropColumn('deleted_at');
            }
        });
    }
};