<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: Update REAC table structure
 *
 * Esta migración corrige la estructura de la tabla REAC:
 * - Elimina campos de sesiones individuales (ahora están en tabla separada)
 * - Agrega relación con división
 * - Mejora tipos de datos y constraints
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Si la tabla existe, la modificamos
        if (Schema::hasTable('reacs')) {
            Schema::table('reacs', function (Blueprint $table) {
                // Eliminar campos de sesión individual (ahora están en sesiones_reac)
                if (Schema::hasColumn('reacs', 'no_sesion')) {
                    $table->dropColumn(['no_sesion', 'fecha_sesion', 'hora_sesion', 'modalidad', 'grupal', 'tema']);
                }

                // Agregar relación con división si no existe
                if (!Schema::hasColumn('reacs', 'division_id')) {
                    $table->foreignId('division_id')
                          ->nullable()
                          ->after('division')
                          ->constrained('divisions')
                          ->nullOnDelete();
                }

                // Agregar relación con tutor si no existe
                if (!Schema::hasColumn('reacs', 'tutor_id')) {
                    $table->foreignId('tutor_id')
                          ->nullable()
                          ->after('tutor')
                          ->constrained('tutores')
                          ->nullOnDelete();
                }

                // Mejorar campos existentes
                $table->string('tutor', 255)->change();
                $table->string('division', 100)->nullable()->change();
            });
        } else {
            // Si no existe, crear la tabla con la estructura correcta
            Schema::create('reacs', function (Blueprint $table) {
                $table->id();

                // Información del tutor
                $table->foreignId('tutor_id')
                      ->nullable()
                      ->constrained('tutores')
                      ->nullOnDelete();
                $table->string('tutor', 255); // Nombre del tutor (redundante por seguridad)

                // Información de la división
                $table->foreignId('division_id')
                      ->nullable()
                      ->constrained('divisions')
                      ->nullOnDelete();
                $table->string('division', 100)->nullable();

                // Información general del reporte
                $table->integer('num_tutorados')->unsigned();
                $table->date('fecha_entrega');
                $table->string('semestre_grupo', 50);
                $table->decimal('horas_tutorias_semana', 5, 2)->unsigned();

                // Archivos
                $table->string('firma', 255); // Ruta a la imagen de la firma
                $table->json('evidencias_fotograficas')->nullable();
                $table->json('evidencias_lista')->nullable();

                // Metadatos
                $table->enum('estado', ['borrador', 'enviado', 'revisado', 'aprobado', 'rechazado'])
                      ->default('borrador');
                $table->text('observaciones')->nullable();

                $table->timestamps();
                $table->softDeletes();

                // Índices para búsquedas rápidas
                $table->index('fecha_entrega');
                $table->index('estado');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('reacs')) {
            Schema::table('reacs', function (Blueprint $table) {
                // Restaurar campos antiguos si se hace rollback
                if (!Schema::hasColumn('reacs', 'no_sesion')) {
                    $table->string('no_sesion')->nullable();
                    $table->date('fecha_sesion')->nullable();
                    $table->time('hora_sesion')->nullable();
                    $table->string('modalidad')->nullable();
                    $table->boolean('grupal')->default(false);
                    $table->string('tema')->nullable();
                }

                // Eliminar foreign keys si existen
                if (Schema::hasColumn('reacs', 'division_id')) {
                    $table->dropForeign(['division_id']);
                    $table->dropColumn('division_id');
                }

                if (Schema::hasColumn('reacs', 'tutor_id')) {
                    $table->dropForeign(['tutor_id']);
                    $table->dropColumn('tutor_id');
                }
            });
        }
    }
};
