<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Model: Division
 *
 * Representa una división académica del instituto.
 *
 * Relaciones:
 * - hasMany: Tutore (tutores)
 * - hasMany: REAC (reportes)
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $codigo
 * @property string|null $descripcion
 * @property bool $activo
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 */
class Division extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'divisions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'nombre',
        'codigo',
        'descripcion',
        'activo',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'activo' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Relación: Una división tiene muchos tutores
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tutores()
    {
        return $this->hasMany(Tutore::class, 'division_id');
    }

    /**
     * Relación: Una división tiene muchos reportes REAC
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reacs()
    {
        return $this->hasMany(REAC::class, 'division_id');
    }

    /**
     * Scope: Solo divisiones activas
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActivas($query)
    {
        return $query->where('activo', true);
    }

    /**
     * Obtener el nombre completo de la división (código + nombre)
     *
     * @return string
     */
    public function getNombreCompletoAttribute()
    {
        if ($this->codigo) {
            return "{$this->codigo} - {$this->nombre}";
        }
        return $this->nombre;
    }
}
