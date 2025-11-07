<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: Create sesiones_reac table
 *
 * Esta tabla almacena las múltiples sesiones de tutoría de un reporte REAC.
 * Soluciona el problema de querer guardar arrays en campos individuales.
 *
 * Relación: Una REAC puede tener muchas sesiones (1:N)
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sesiones_reac', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reac_id')
                  ->constrained('reacs')
                  ->onDelete('cascade'); // Si se elimina el REAC, se eliminan las sesiones

            $table->integer('no_sesion');
            $table->date('fecha_sesion');
            $table->time('hora_sesion');
            $table->enum('modalidad', ['presencial', 'virtual', 'hibrida'])->default('presencial');
            $table->boolean('es_grupal')->default(false);
            $table->string('tema', 255);
            $table->text('observaciones')->nullable();

            $table->timestamps();

            // Índice compuesto para búsquedas rápidas
            $table->index(['reac_id', 'no_sesion']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sesiones_reac');
    }
};
