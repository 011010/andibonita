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
        Schema::create('tutorados', function (Blueprint $table) {
            $table->id();
            $table->string('semestre');
            $table->string('grupo');
            $table->string('carrera');
            $table->string('numerocontrol');
            $table->string('nombre');
            $table->string('a_paterno');
            $table->string('a_materno');
            $table->string('correoelectronico')->unique();
            $table->string('contraseña');
            $table->string('role')->default('tutorado');
            $table->unsignedBigInteger('tutor_id')->nullable(); // Puede ser nulo
            $table->foreign('tutor_id')->references('id')->on('tutores')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutorados');
    }
};
