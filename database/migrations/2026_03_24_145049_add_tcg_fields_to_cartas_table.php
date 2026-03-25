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
        Schema::table('cartas', function (Blueprint $table) {
            $table->integer('hp')->nullable();
            $table->string('peso')->nullable();
            $table->string('altura')->nullable();
            $table->integer('pokedex_no')->nullable();
            $table->string('ataque1_name')->nullable();
            $table->string('ataque1_damage')->nullable();
            $table->string('ataque2_name')->nullable();
            $table->string('ataque2_damage')->nullable();
            $table->boolean('es_holo')->default(false);
            $table->boolean('es_legendario')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cartas', function (Blueprint $table) {
            $table->dropColumn([
                'hp', 'peso', 'altura', 'pokedex_no',
                'ataque1_name', 'ataque1_damage',
                'ataque2_name', 'ataque2_damage',
                'es_holo', 'es_legendario'
            ]);
        });
    }
};
