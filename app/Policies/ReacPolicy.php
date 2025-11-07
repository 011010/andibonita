<?php

namespace App\Policies;

use App\Models\REAC;
use App\Models\Tutorado;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Policy: ReacPolicy
 *
 * Define las reglas de autorización para las operaciones CRUD de REAC.
 * Sigue el principio de que:
 * - Administradores pueden hacer todo
 * - Coordinadores pueden ver y revisar todo
 * - Tutores solo pueden gestionar sus propios REACs
 * - Estudiantes solo pueden ver sus propios REACs
 */
class ReacPolicy
{
    use HandlesAuthorization;

    /**
     * Determine si el usuario puede ver cualquier REAC.
     */
    public function viewAny(Tutorado $user): bool
    {
        // Todos los usuarios autenticados pueden ver la lista
        return true;
    }

    /**
     * Determine si el usuario puede ver un REAC específico.
     */
    public function view(Tutorado $user, REAC $reac): bool
    {
        // Administradores y coordinadores pueden ver todo
        if (in_array($user->role, ['admin', 'coordinador'])) {
            return true;
        }

        // Tutores pueden ver sus propios REACs
        if ($user->role === 'tutor' && $reac->tutor_id === $user->id) {
            return true;
        }

        // Estudiantes pueden ver REACs de su tutor
        if ($user->role === 'estudiante' && $user->tutor_id === $reac->tutor_id) {
            return true;
        }

        return false;
    }

    /**
     * Determine si el usuario puede crear REACs.
     */
    public function create(Tutorado $user): bool
    {
        // Solo tutores, coordinadores y administradores pueden crear REACs
        return in_array($user->role, ['tutor', 'coordinador', 'admin']);
    }

    /**
     * Determine si el usuario puede actualizar un REAC.
     */
    public function update(Tutorado $user, REAC $reac): bool
    {
        // Administradores pueden editar cualquier REAC
        if ($user->role === 'admin') {
            return true;
        }

        // Coordinadores pueden editar cualquier REAC
        if ($user->role === 'coordinador') {
            return true;
        }

        // Tutores solo pueden editar sus propios REACs y solo si están en estado editable
        if ($user->role === 'tutor' && $reac->tutor_id === $user->id) {
            return $reac->esEditable();
        }

        return false;
    }

    /**
     * Determine si el usuario puede eliminar un REAC.
     */
    public function delete(Tutorado $user, REAC $reac): bool
    {
        // Solo administradores pueden eliminar REACs
        if ($user->role === 'admin') {
            return true;
        }

        // Coordinadores pueden eliminar REACs en borrador
        if ($user->role === 'coordinador' && $reac->estado === REAC::ESTADO_BORRADOR) {
            return true;
        }

        // Tutores pueden eliminar solo sus REACs en borrador
        if ($user->role === 'tutor' &&
            $reac->tutor_id === $user->id &&
            $reac->estado === REAC::ESTADO_BORRADOR) {
            return true;
        }

        return false;
    }

    /**
     * Determine si el usuario puede restaurar un REAC eliminado.
     */
    public function restore(Tutorado $user, REAC $reac): bool
    {
        // Solo administradores pueden restaurar
        return $user->role === 'admin';
    }

    /**
     * Determine si el usuario puede eliminar permanentemente un REAC.
     */
    public function forceDelete(Tutorado $user, REAC $reac): bool
    {
        // Solo administradores pueden eliminar permanentemente
        return $user->role === 'admin';
    }

    /**
     * Determine si el usuario puede aprobar/rechazar un REAC.
     */
    public function review(Tutorado $user, REAC $reac): bool
    {
        // Solo coordinadores y administradores pueden revisar
        return in_array($user->role, ['coordinador', 'admin']);
    }

    /**
     * Determine si el usuario puede exportar REACs a PDF.
     */
    public function export(Tutorado $user, REAC $reac): bool
    {
        // Cualquiera que pueda ver el REAC puede exportarlo
        return $this->view($user, $reac);
    }
}
