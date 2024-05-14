<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Tutore
 *
 * @property $id
 * @property $imagendeperfil
 * @property $nombres
 * @property $a_paterno
 * @property $a_materno
 * @property $division
 * @property $teléfono
 * @property $perfil
 * @property $correoelectronico
 * @property $contraseña
 * @property $role
 * @property $created_at
 * @property $updated_at
 *
 * @property Tutorado[] $tutorados
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
    protected $fillable = ['imagendeperfil', 'nombres', 'a_paterno', 'a_materno', 'division', 'teléfono', 'perfil', 'correoelectronico', 'contraseña', 'role'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tutorados()
    {
        return $this->hasMany(\App\Models\Tutorado::class, 'id', 'tutor_id');
    }
    
}
