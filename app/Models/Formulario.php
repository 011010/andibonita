<?php

// app/Models/Formulario.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class calendario extends Model
{
    use HasFactory;

    protected $fillable = [
        'documento', 'periodo', 'fecha_entrega', 'inicio_tutorias', 
        'reac_1', 'resa_1', 'reac_2', 'resa_2', 'reac_3', 
        'resa_3', 'reac_4', 'resa_4', 'fin_tutorias', 
        'informe_asistencia', 'evidencia_canalizacion', 
        'reporte_semestral', 'copias_actas'
    ];
}

