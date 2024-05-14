<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tutorado
 *
 * @property $id
 * @property $semestre
 * @property $grupo
 * @property $carrera
 * @property $numerocontrol
 * @property $nombre
 * @property $a_paterno
 * @property $a_materno
 * @property $correoelectronico
 * @property $contraseña
 * @property $role
 * @property $tutor_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Tutore $tutore
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Tutorado extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['semestre', 'grupo', 'carrera', 'numerocontrol', 'nombre', 'a_paterno', 'a_materno', 'correoelectronico', 'contraseña', 'role', 'tutor_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tutore()
    {
        return $this->belongsTo(\App\Models\Tutore::class, 'tutor_id', 'id');
    }
    
}
