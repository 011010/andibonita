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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('imagendeperfil')->nullable();
            $table->string('nombres')->nullable();
            $table->string('a_paterno')->nullable();
            $table->string('a_materno')->nullable();
            $table->string('teléfono')->nullable();
            $table->string('perfil')->nullable();
            $table->string('correoelectronico')->unique();
            $table->string('contraseña');
            $table->string('role');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
