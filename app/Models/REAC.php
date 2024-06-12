<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class REAC extends Model
{
    use HasFactory;

    protected $fillable = [
        'tutor', 'division', 'num_tutorados', 'fecha_entrega', 'semestre_grupo', 'horas_tutorias_semana', 
        'firma', 'no_sesion', 'fecha_sesion', 'hora_sesion', 'modalidad', 'grupal', 'tema', 
        'evidencias_fotograficas', 'evidencias_lista'
    ];

    protected $casts = [
        'evidencias_fotograficas' => 'array',
        'evidencias_lista' => 'array',
    ];
}
