<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Usuario
 *
 * @property $id
 * @property $imagendeperfil
 * @property $nombres
 * @property $a_paterno
 * @property $a_materno
 * @property $teléfono
 * @property $perfil
 * @property $correoelectronico
 * @property $contraseña
 * @property $role
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Usuario extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['imagendeperfil', 'nombres', 'a_paterno', 'a_materno', 'teléfono', 'perfil', 'correoelectronico', 'contraseña', 'role'];


}
