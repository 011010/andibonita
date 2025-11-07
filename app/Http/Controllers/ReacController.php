<?php

namespace App\Http\Controllers;

use App\Models\REAC;
use App\Models\SesionReac;
use App\Models\Tutore;
use App\Models\Division;
use App\Http\Requests\StoreReacRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mpdf\Mpdf;

/**
 * Controller: ReacController
 *
 * Maneja todas las operaciones relacionadas con los reportes REAC.
 *
 * Métodos:
 * - index: Lista todos los REACs
 * - create: Muestra el formulario de creación
 * - store: Guarda un nuevo REAC en la base de datos y genera el PDF
 * - show: Muestra un REAC específico
 * - edit: Muestra el formulario de edición
 * - update: Actualiza un REAC existente
 * - destroy: Elimina un REAC
 * - generatePDF: Genera el PDF de un REAC
 */
class ReacController extends Controller
{
    /**
     * Display a listing of the REACs.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reacs = REAC::with(['tutore', 'divisionRelacion', 'sesiones'])
                     ->orderBy('fecha_entrega', 'desc')
                     ->paginate(15);

        return view('reac.index', compact('reacs'));
    }

    /**
     * Show the form for creating a new REAC.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Obtener catálogos necesarios para el formulario
        $tutores = Tutore::orderBy('nombres')->get();
        $divisiones = Division::activas()->orderBy('nombre')->get();
        $fecha_entrega = date('Y-m-d');

        return view('reac.create', compact('tutores', 'divisiones', 'fecha_entrega'));
    }

    /**
     * Store a newly created REAC in storage.
     *
     * @param \App\Http\Requests\StoreReacRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReacRequest $request)
    {
        try {
            // Usar transacción para asegurar integridad de datos
            DB::beginTransaction();

            // 1. Guardar la firma del tutor
            $firmaPath = $request->file('firma')->store('firmas', 'public');

            // 2. Procesar evidencias fotográficas
            $evidenciasFotograficas = [];
            if ($request->hasFile('evidencia_fotografica')) {
                foreach ($request->file('evidencia_fotografica') as $file) {
                    $path = $file->store('evidencias_fotograficas', 'public');
                    $evidenciasFotograficas[] = $path;
                }
            }

            // 3. Procesar evidencias de lista
            $evidenciasLista = [];
            if ($request->hasFile('evidencia_lista')) {
                foreach ($request->file('evidencia_lista') as $file) {
                    $path = $file->store('evidencias_lista', 'public');
                    $evidenciasLista[] = $path;
                }
            }

            // 4. Crear el registro REAC
            $reac = REAC::create([
                'tutor_id' => $request->tutor_id,
                'tutor' => $request->tutor,
                'division_id' => $request->division_id,
                'division' => $request->division,
                'num_tutorados' => $request->num_tutorados,
                'fecha_entrega' => $request->fecha_entrega,
                'semestre_grupo' => $request->semestre_grupo,
                'horas_tutorias_semana' => $request->horas_tutorias_semana,
                'firma' => $firmaPath,
                'evidencias_fotograficas' => $evidenciasFotograficas,
                'evidencias_lista' => $evidenciasLista,
                'estado' => REAC::ESTADO_BORRADOR,
                'observaciones' => $request->observaciones,
            ]);

            // 5. Crear las sesiones asociadas al REAC
            $noSesiones = $request->no_sesion;
            $fechaSesiones = $request->fecha_sesion;
            $horaSesiones = $request->hora_sesion;
            $modalidades = $request->modalidad;
            $temas = $request->tema;
            $grupales = $request->grupal ?? [];

            foreach ($noSesiones as $index => $noSesion) {
                SesionReac::create([
                    'reac_id' => $reac->id,
                    'no_sesion' => $noSesion,
                    'fecha_sesion' => $fechaSesiones[$index],
                    'hora_sesion' => $horaSesiones[$index],
                    'modalidad' => $modalidades[$index],
                    'es_grupal' => isset($grupales[$index]) ? true : false,
                    'tema' => $temas[$index],
                ]);
            }

            // 6. Confirmar la transacción
            DB::commit();

            // 7. Redirigir con mensaje de éxito y opción de generar PDF
            return redirect()
                ->route('reac.show', $reac->id)
                ->with('success', 'REAC creado exitosamente. Ahora puede generar el PDF.');

        } catch (\Exception $e) {
            // Revertir cambios en caso de error
            DB::rollBack();

            // Registrar el error en los logs
            Log::error('Error al crear REAC: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => $request->all()
            ]);

            // Redirigir con mensaje de error
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error al crear el REAC: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified REAC.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reac = REAC::with(['tutore', 'divisionRelacion', 'sesiones'])
                    ->findOrFail($id);

        return view('reac.show', compact('reac'));
    }

    /**
     * Show the form for editing the specified REAC.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reac = REAC::with('sesiones')->findOrFail($id);

        // Verificar si el REAC puede ser editado
        if (!$reac->esEditable()) {
            return redirect()
                ->route('reac.show', $reac->id)
                ->with('warning', 'Este REAC no puede ser editado en su estado actual.');
        }

        $tutores = Tutore::orderBy('nombres')->get();
        $divisiones = Division::activas()->orderBy('nombre')->get();

        return view('reac.edit', compact('reac', 'tutores', 'divisiones'));
    }

    /**
     * Update the specified REAC in storage.
     *
     * @param \App\Http\Requests\StoreReacRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreReacRequest $request, $id)
    {
        try {
            $reac = REAC::findOrFail($id);

            // Verificar si el REAC puede ser editado
            if (!$reac->esEditable()) {
                return redirect()
                    ->route('reac.show', $reac->id)
                    ->with('error', 'Este REAC no puede ser editado en su estado actual.');
            }

            DB::beginTransaction();

            // Actualizar firma si se proporciona una nueva
            $firmaPath = $reac->firma;
            if ($request->hasFile('firma')) {
                $firmaPath = $request->file('firma')->store('firmas', 'public');
            }

            // Actualizar evidencias fotográficas
            $evidenciasFotograficas = $reac->evidencias_fotograficas ?? [];
            if ($request->hasFile('evidencia_fotografica')) {
                foreach ($request->file('evidencia_fotografica') as $file) {
                    $path = $file->store('evidencias_fotograficas', 'public');
                    $evidenciasFotograficas[] = $path;
                }
            }

            // Actualizar evidencias de lista
            $evidenciasLista = $reac->evidencias_lista ?? [];
            if ($request->hasFile('evidencia_lista')) {
                foreach ($request->file('evidencia_lista') as $file) {
                    $path = $file->store('evidencias_lista', 'public');
                    $evidenciasLista[] = $path;
                }
            }

            // Actualizar el REAC
            $reac->update([
                'tutor_id' => $request->tutor_id,
                'tutor' => $request->tutor,
                'division_id' => $request->division_id,
                'division' => $request->division,
                'num_tutorados' => $request->num_tutorados,
                'fecha_entrega' => $request->fecha_entrega,
                'semestre_grupo' => $request->semestre_grupo,
                'horas_tutorias_semana' => $request->horas_tutorias_semana,
                'firma' => $firmaPath,
                'evidencias_fotograficas' => $evidenciasFotograficas,
                'evidencias_lista' => $evidenciasLista,
                'observaciones' => $request->observaciones,
            ]);

            // Eliminar sesiones antiguas y crear las nuevas
            $reac->sesiones()->delete();

            $noSesiones = $request->no_sesion;
            $fechaSesiones = $request->fecha_sesion;
            $horaSesiones = $request->hora_sesion;
            $modalidades = $request->modalidad;
            $temas = $request->tema;
            $grupales = $request->grupal ?? [];

            foreach ($noSesiones as $index => $noSesion) {
                SesionReac::create([
                    'reac_id' => $reac->id,
                    'no_sesion' => $noSesion,
                    'fecha_sesion' => $fechaSesiones[$index],
                    'hora_sesion' => $horaSesiones[$index],
                    'modalidad' => $modalidades[$index],
                    'es_grupal' => isset($grupales[$index]) ? true : false,
                    'tema' => $temas[$index],
                ]);
            }

            DB::commit();

            return redirect()
                ->route('reac.show', $reac->id)
                ->with('success', 'REAC actualizado exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error al actualizar REAC: ' . $e->getMessage(), [
                'exception' => $e,
                'reac_id' => $id
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error al actualizar el REAC: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified REAC from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $reac = REAC::findOrFail($id);

            // Verificar si el REAC puede ser eliminado
            if ($reac->estado === REAC::ESTADO_APROBADO) {
                return redirect()
                    ->back()
                    ->with('error', 'No se puede eliminar un REAC aprobado.');
            }

            // Eliminación suave (soft delete)
            $reac->delete();

            return redirect()
                ->route('reac.index')
                ->with('success', 'REAC eliminado exitosamente.');

        } catch (\Exception $e) {
            Log::error('Error al eliminar REAC: ' . $e->getMessage(), [
                'exception' => $e,
                'reac_id' => $id
            ]);

            return redirect()
                ->back()
                ->with('error', 'Error al eliminar el REAC.');
        }
    }

    /**
     * Generate PDF for the specified REAC.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function generatePDF($id)
    {
        try {
            $reac = REAC::with(['tutore', 'divisionRelacion', 'sesiones'])
                        ->findOrFail($id);

            // Renderizar la vista del PDF
            $html = view('reac.pdf_template', compact('reac'))->render();

            // Crear instancia de mPDF
            $mpdf = new Mpdf([
                'format' => 'Letter',
                'margin_left' => 15,
                'margin_right' => 15,
                'margin_top' => 20,
                'margin_bottom' => 20,
            ]);

            // Escribir el HTML en el PDF
            $mpdf->WriteHTML($html);

            // Generar nombre del archivo
            $filename = 'REAC_' . $reac->semestre_grupo . '_' . date('Ymd', strtotime($reac->fecha_entrega)) . '.pdf';

            // Descargar el PDF
            return $mpdf->Output($filename, 'D');

        } catch (\Exception $e) {
            Log::error('Error al generar PDF del REAC: ' . $e->getMessage(), [
                'exception' => $e,
                'reac_id' => $id
            ]);

            return redirect()
                ->back()
                ->with('error', 'Error al generar el PDF: ' . $e->getMessage());
        }
    }
}
