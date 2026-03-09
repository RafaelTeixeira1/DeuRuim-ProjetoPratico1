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
    Schema::table('chamados', function (Blueprint $table) {
        $table->foreignId('tecnico_id')
              ->nullable()
              ->constrained('tecnicos')
              ->nullOnDelete();

        $table->foreignId('categoria_id')
              ->nullable()
              ->constrained('categorias')
              ->nullOnDelete();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::table('chamados', function (Blueprint $table) {
        $table->dropForeign(['tecnico_id']);
        $table->dropForeign(['categoria_id']);
        $table->dropColumn(['tecnico_id','categoria_id']);
    });
}
};
