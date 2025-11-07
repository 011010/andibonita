<?php

namespace App\Http\Controllers;

use App\Models\Calendario;
use App\Http\Requests\StoreCalendarioRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mpdf\Mpdf;

/**
 * Controller: CalendarioController
 *
 * Maneja la gestión de calendarios de tutorías.
 * Permite crear, listar, ver y generar PDFs de calendarios.
 */
class CalendarioController extends Controller
{
    /**
     * Display a listing of calendarios.
     */
    public function index()
    {
        $calendarios = Calendario::orderBy('created_at', 'desc')->paginate(15);

        return view('calendario.index', compact('calendarios'));
    }

    /**
     * Show the form for creating a new calendario.
     */
    public function create()
    {
        return view('calendario.create');
    }

    /**
     * Store a newly created calendario in storage.
     */
    public function store(StoreCalendarioRequest $request)
    {
        try {
            $calendario = Calendario::create($request->validated());

            return redirect()
                ->route('calendario.show', $calendario->id)
                ->with('success', 'Calendario creado exitosamente. Ahora puede generar el PDF.');

        } catch (\Exception $e) {
            Log::error('Error al crear calendario: ' . $e->getMessage(), [
                'exception' => $e,
                'request' => $request->all()
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error al crear el calendario: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified calendario.
     */
    public function show($id)
    {
        $calendario = Calendario::findOrFail($id);

        return view('calendario.show', compact('calendario'));
    }

    /**
     * Show the form for editing the specified calendario.
     */
    public function edit($id)
    {
        $calendario = Calendario::findOrFail($id);

        return view('calendario.edit', compact('calendario'));
    }

    /**
     * Update the specified calendario in storage.
     */
    public function update(StoreCalendarioRequest $request, $id)
    {
        try {
            $calendario = Calendario::findOrFail($id);
            $calendario->update($request->validated());

            return redirect()
                ->route('calendario.show', $calendario->id)
                ->with('success', 'Calendario actualizado exitosamente.');

        } catch (\Exception $e) {
            Log::error('Error al actualizar calendario: ' . $e->getMessage(), [
                'exception' => $e,
                'calendario_id' => $id
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error al actualizar el calendario.');
        }
    }

    /**
     * Remove the specified calendario from storage.
     */
    public function destroy($id)
    {
        try {
            $calendario = Calendario::findOrFail($id);
            $calendario->delete();

            return redirect()
                ->route('calendario.index')
                ->with('success', 'Calendario eliminado exitosamente.');

        } catch (\Exception $e) {
            Log::error('Error al eliminar calendario: ' . $e->getMessage(), [
                'exception' => $e,
                'calendario_id' => $id
            ]);

            return redirect()
                ->back()
                ->with('error', 'Error al eliminar el calendario.');
        }
    }

    /**
     * Generate PDF for the specified calendario.
     */
    public function generatePDF($id)
    {
        try {
            $calendario = Calendario::findOrFail($id);

            // Renderizar la vista del PDF
            $html = view('calendario.pdf_template', compact('calendario'))->render();

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
            $filename = 'Calendario_' . $calendario->periodo . '_' . date('Ymd') . '.pdf';

            // Descargar el PDF
            return $mpdf->Output($filename, 'D');

        } catch (\Exception $e) {
            Log::error('Error al generar PDF del calendario: ' . $e->getMessage(), [
                'exception' => $e,
                'calendario_id' => $id
            ]);

            return redirect()
                ->back()
                ->with('error', 'Error al generar el PDF: ' . $e->getMessage());
        }
    }
}
