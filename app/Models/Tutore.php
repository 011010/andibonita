<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tutore
 *
 * @property $id
 * @property $division
 * @property $nombre
 * @property $a_paterno
 * @property $a_materno
 * @property $correo_electronico
 * @property $contraseña
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Tutore extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['division', 'nombre', 'a_paterno', 'a_materno', 'correo_electronico', 'contraseña'];


}
