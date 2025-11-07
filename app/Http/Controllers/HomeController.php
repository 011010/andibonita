<?php

namespace App\Http\Controllers;

use App\Models\REAC;
use App\Models\Calendario;
use App\Models\Tutore;
use App\Models\Tutorado;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * HomeController
 *
 * Controlador del dashboard principal del sistema.
 * Proporciona estadísticas y resúmenes personalizados según el rol del usuario.
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Mostrar el dashboard de la aplicación con estadísticas personalizadas.
     */
    public function index()
    {
        $user = Auth::user();

        // Estadísticas generales
        $stats = $this->getGeneralStats($user);

        // Estadísticas específicas según rol
        $roleStats = $this->getRoleSpecificStats($user);

        // REACs recientes
        $recentReacs = $this->getRecentReacs($user);

        // Calendario actual
        $currentCalendario = Calendario::whereYear('created_at', date('Y'))
            ->orderBy('created_at', 'desc')
            ->first();

        // Actividad reciente
        $recentActivity = $this->getRecentActivity($user);

        return view('home', compact(
            'stats',
            'roleStats',
            'recentReacs',
            'currentCalendario',
            'recentActivity'
        ));
    }

    /**
     * Obtener estadísticas generales del sistema.
     */
    private function getGeneralStats($user)
    {
        $stats = [
            'total_reacs' => 0,
            'reacs_pendientes' => 0,
            'reacs_aprobados' => 0,
            'total_tutores' => 0,
            'total_estudiantes' => 0,
            'total_calendarios' => Calendario::count(),
        ];

        // Filtrar según rol
        if (in_array($user->role, ['admin', 'coordinador'])) {
            // Admin y coordinador ven todo
            $stats['total_reacs'] = REAC::count();
            $stats['reacs_pendientes'] = REAC::whereIn('estado', ['borrador', 'enviado'])->count();
            $stats['reacs_aprobados'] = REAC::where('estado', 'aprobado')->count();
            $stats['total_tutores'] = Tutore::count();
            $stats['total_estudiantes'] = Tutorado::where('role', 'estudiante')->count();
        } elseif ($user->role === 'tutor') {
            // Tutor ve solo sus REACs
            $stats['total_reacs'] = REAC::where('tutor_id', $user->id)->count();
            $stats['reacs_pendientes'] = REAC::where('tutor_id', $user->id)
                ->whereIn('estado', ['borrador', 'enviado'])->count();
            $stats['reacs_aprobados'] = REAC::where('tutor_id', $user->id)
                ->where('estado', 'aprobado')->count();
            $stats['total_estudiantes'] = Tutorado::where('tutor_id', $user->id)
                ->where('role', 'estudiante')->count();
        }

        return $stats;
    }

    /**
     * Obtener estadísticas específicas según el rol del usuario.
     */
    private function getRoleSpecificStats($user)
    {
        $roleStats = [];

        if (in_array($user->role, ['admin', 'coordinador'])) {
            // Estadísticas por división
            $roleStats['divisions'] = Division::withCount('reacs')
                ->having('reacs_count', '>', 0)
                ->orderBy('reacs_count', 'desc')
                ->limit(5)
                ->get();

            // Estadísticas por estado de REAC
            $roleStats['reacs_by_status'] = DB::table('reacs')
                ->select('estado', DB::raw('count(*) as total'))
                ->groupBy('estado')
                ->get();

            // Tutores más activos
            $roleStats['top_tutores'] = DB::table('reacs')
                ->select('tutor', DB::raw('count(*) as total'))
                ->groupBy('tutor')
                ->orderBy('total', 'desc')
                ->limit(5)
                ->get();

        } elseif ($user->role === 'tutor') {
            // Estadísticas del tutor
            $roleStats['mis_reacs_por_estado'] = DB::table('reacs')
                ->select('estado', DB::raw('count(*) as total'))
                ->where('tutor_id', $user->id)
                ->groupBy('estado')
                ->get();

            // Total de sesiones registradas
            $roleStats['total_sesiones'] = DB::table('sesiones_reac')
                ->join('reacs', 'sesiones_reac.reac_id', '=', 'reacs.id')
                ->where('reacs.tutor_id', $user->id)
                ->count();
        }

        return $roleStats;
    }

    /**
     * Obtener REACs recientes según el rol del usuario.
     */
    private function getRecentReacs($user)
    {
        $query = REAC::with(['tutore', 'divisionRelacion'])
            ->orderBy('created_at', 'desc')
            ->limit(5);

        if ($user->role === 'tutor') {
            $query->where('tutor_id', $user->id);
        } elseif ($user->role === 'estudiante') {
            $query->where('tutor_id', $user->tutor_id);
        }

        return $query->get();
    }

    /**
     * Obtener actividad reciente del usuario.
     */
    private function getRecentActivity($user)
    {
        $activity = [];

        // REACs actualizados recientemente
        $recentUpdates = REAC::orderBy('updated_at', 'desc')
            ->limit(10);

        if ($user->role === 'tutor') {
            $recentUpdates->where('tutor_id', $user->id);
        }

        foreach ($recentUpdates->get() as $reac) {
            $activity[] = [
                'type' => 'reac_updated',
                'data' => $reac,
                'timestamp' => $reac->updated_at,
            ];
        }

        // Ordenar por timestamp
        usort($activity, function($a, $b) {
            return $b['timestamp'] <=> $a['timestamp'];
        });

        return array_slice($activity, 0, 5);
    }
}
