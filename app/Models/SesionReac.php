<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model: SesionReac
 *
 * Representa una sesión de tutoría dentro de un reporte REAC.
 * Cada REAC puede tener múltiples sesiones.
 *
 * Relaciones:
 * - belongsTo: REAC (reporte padre)
 *
 * @property int $id
 * @property int $reac_id
 * @property int $no_sesion
 * @property string $fecha_sesion
 * @property string $hora_sesion
 * @property string $modalidad
 * @property bool $es_grupal
 * @property string $tema
 * @property string|null $observaciones
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class SesionReac extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sesiones_reac';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'reac_id',
        'no_sesion',
        'fecha_sesion',
        'hora_sesion',
        'modalidad',
        'es_grupal',
        'tema',
        'observaciones',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fecha_sesion' => 'date',
        'hora_sesion' => 'datetime:H:i',
        'es_grupal' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Valores permitidos para modalidad
     */
    const MODALIDAD_PRESENCIAL = 'presencial';
    const MODALIDAD_VIRTUAL = 'virtual';
    const MODALIDAD_HIBRIDA = 'hibrida';

    /**
     * Relación: Una sesión pertenece a un REAC
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reac()
    {
        return $this->belongsTo(REAC::class, 'reac_id');
    }

    /**
     * Scope: Ordenar por número de sesión
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrdenadas($query)
    {
        return $query->orderBy('no_sesion');
    }

    /**
     * Scope: Solo sesiones grupales
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeGrupales($query)
    {
        return $query->where('es_grupal', true);
    }

    /**
     * Scope: Solo sesiones individuales
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeIndividuales($query)
    {
        return $query->where('es_grupal', false);
    }

    /**
     * Obtener el tipo de sesión formateado
     *
     * @return string
     */
    public function getTipoSesionAttribute()
    {
        return $this->es_grupal ? 'Grupal' : 'Individual';
    }

    /**
     * Obtener modalidad capitalizada
     *
     * @return string
     */
    public function getModalidadFormateadaAttribute()
    {
        return ucfirst($this->modalidad);
    }
}
