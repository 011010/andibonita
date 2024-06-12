<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReacsTable extends Migration
{
    public function up()
    {
        Schema::create('Reacs', function (Blueprint $table) {
            $table->id();
            $table->string('tutor');
            $table->string('division');
            $table->integer('num_tutorados');
            $table->date('fecha_entrega');
            $table->string('semestre_grupo');
            $table->integer('horas_tutorias_semana');
            $table->string('firma');
            $table->string('no_sesion');
            $table->date('fecha_sesion');
            $table->time('hora_sesion');
            $table->string('modalidad');
            $table->boolean('grupal')->default(false);
            $table->string('tema');
            $table->json('evidencias_fotograficas')->nullable();
            $table->json('evidencias_lista')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('Reacs');
    }
}
