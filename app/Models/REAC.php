<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Model: REAC
 *
 * Representa un Reporte de Actividades de Tutoría (REAC).
 * Contiene información general del reporte y está relacionado con múltiples sesiones.
 *
 * Relaciones:
 * - belongsTo: Tutore (tutor)
 * - belongsTo: Division (división)
 * - hasMany: SesionReac (sesiones de tutoría)
 *
 * @property int $id
 * @property int|null $tutor_id
 * @property string $tutor
 * @property int|null $division_id
 * @property string|null $division
 * @property int $num_tutorados
 * @property string $fecha_entrega
 * @property string $semestre_grupo
 * @property float $horas_tutorias_semana
 * @property string $firma
 * @property array|null $evidencias_fotograficas
 * @property array|null $evidencias_lista
 * @property string $estado
 * @property string|null $observaciones
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 */
class REAC extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'reacs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'tutor_id',
        'tutor',
        'division_id',
        'division',
        'num_tutorados',
        'fecha_entrega',
        'semestre_grupo',
        'horas_tutorias_semana',
        'firma',
        'evidencias_fotograficas',
        'evidencias_lista',
        'estado',
        'observaciones',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'evidencias_fotograficas' => 'array',
        'evidencias_lista' => 'array',
        'fecha_entrega' => 'date',
        'horas_tutorias_semana' => 'decimal:2',
        'num_tutorados' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Estados posibles del REAC
     */
    const ESTADO_BORRADOR = 'borrador';
    const ESTADO_ENVIADO = 'enviado';
    const ESTADO_REVISADO = 'revisado';
    const ESTADO_APROBADO = 'aprobado';
    const ESTADO_RECHAZADO = 'rechazado';

    /**
     * Relación: Un REAC pertenece a un tutor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tutore()
    {
        return $this->belongsTo(Tutore::class, 'tutor_id');
    }

    /**
     * Relación: Un REAC pertenece a una división
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function divisionRelacion()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    /**
     * Relación: Un REAC tiene muchas sesiones
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sesiones()
    {
        return $this->hasMany(SesionReac::class, 'reac_id')->ordenadas();
    }

    /**
     * Scope: Filtrar por estado
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $estado
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePorEstado($query, $estado)
    {
        return $query->where('estado', $estado);
    }

    /**
     * Scope: REACs enviados o posteriores
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeEnviados($query)
    {
        return $query->whereIn('estado', [
            self::ESTADO_ENVIADO,
            self::ESTADO_REVISADO,
            self::ESTADO_APROBADO,
            self::ESTADO_RECHAZADO
        ]);
    }

    /**
     * Scope: REACs pendientes de revisión
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePendientes($query)
    {
        return $query->where('estado', self::ESTADO_ENVIADO);
    }

    /**
     * Obtener la ruta completa de la firma
     *
     * @return string
     */
    public function getRutaFirmaAttribute()
    {
        return storage_path('app/public/' . $this->firma);
    }

    /**
     * Verificar si el REAC puede ser editado
     *
     * @return bool
     */
    public function esEditable()
    {
        return in_array($this->estado, [self::ESTADO_BORRADOR, self::ESTADO_RECHAZADO]);
    }

    /**
     * Verificar si el REAC está aprobado
     *
     * @return bool
     */
    public function estaAprobado()
    {
        return $this->estado === self::ESTADO_APROBADO;
    }

    /**
     * Obtener el total de sesiones
     *
     * @return int
     */
    public function getTotalSesionesAttribute()
    {
        return $this->sesiones()->count();
    }

    /**
     * Obtener el estado formateado
     *
     * @return string
     */
    public function getEstadoFormateadoAttribute()
    {
        return ucfirst($this->estado);
    }
}
