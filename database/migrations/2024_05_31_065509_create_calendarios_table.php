<?php

// database/migrations/xxxx_xx_xx_create_calendarios_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendariosTable extends Migration
{
    public function up()
    {
        Schema::create('calendarios', function (Blueprint $table) {
            $table->id();
            $table->string('documento');
            $table->string('periodo');
            $table->date('fecha_entrega');
            $table->date('inicio_tutorias')->nullable();
            $table->date('reac_1')->nullable();
            $table->date('resa_1')->nullable();
            $table->date('reac_2')->nullable();
            $table->date('resa_2')->nullable();
            $table->date('reac_3')->nullable();
            $table->date('resa_3')->nullable();
            $table->date('reac_4')->nullable();
            $table->date('resa_4')->nullable();
            $table->date('fin_tutorias')->nullable();
            $table->date('informe_asistencia')->nullable();
            $table->date('evidencia_canalizacion')->nullable();
            $table->date('reporte_semestral')->nullable();
            $table->date('copias_actas')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('calendarios');
    }
}
