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
        Schema::create('tutores', function (Blueprint $table) {
            $table->id();
            $table->string('imagendeperfil')->nullable();
            $table->string('nombres');
            $table->string('a_paterno');
            $table->string('a_materno');
            $table->string('division');
            $table->string('teléfono');
            $table->string('perfil');
            $table->string('correoelectronico')->unique();
            $table->string('contraseña');
            $table->string('role')->default('tutor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutores');
    }
};
