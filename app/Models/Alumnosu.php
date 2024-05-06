<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Alumnosu
 *
 * @property $id
 * @property $alumno_id
 * @property $tutor_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Alumno $alumno
 * @property Tutore $tutore
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Alumnosu extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['alumno_id', 'tutor_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function alumno()
    {
        return $this->belongsTo(\App\Models\Alumno::class, 'alumno_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tutore()
    {
        return $this->belongsTo(\App\Models\Tutore::class, 'tutor_id', 'id');
    }
    
}
