<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware: CheckRole
 *
 * Verifica que el usuario autenticado tenga uno de los roles permitidos
 * para acceder a la ruta protegida.
 *
 * Uso:
 * Route::middleware(['auth', 'role:admin,coordinador'])->group(...);
 */
class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles  Lista de roles permitidos separados por coma
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Verificar que el usuario esté autenticado
        if (!auth()->check()) {
            return redirect()->route('login')
                ->with('error', 'Debe iniciar sesión para acceder a esta página.');
        }

        $user = auth()->user();

        // Si no se especificaron roles, permitir acceso
        if (empty($roles)) {
            return $next($request);
        }

        // Verificar si el usuario tiene uno de los roles permitidos
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // Si el usuario no tiene permiso, redirigir con mensaje de error
        abort(403, 'No tiene permisos para acceder a esta sección.');
    }
}
