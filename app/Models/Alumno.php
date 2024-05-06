<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Alumno
 *
 * @property $id
 * @property $semestre
 * @property $grupo
 * @property $numerodecontrol
 * @property $nombre
 * @property $a_paterno
 * @property $a_materno
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Alumno extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['semestre', 'grupo', 'numerodecontrol', 'nombre', 'a_paterno', 'a_materno'];


}
