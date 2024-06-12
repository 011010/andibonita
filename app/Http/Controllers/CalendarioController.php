<?php

// app/Http/Controllers/CalendarioController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calendario;
use Mpdf\Mpdf;

class CalendarioController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'documento' => 'required|string|max:255',
            'periodo' => 'required|string|max:255',
            'fecha_entrega' => 'required|date',
            'inicio_tutorias' => 'nullable|date',
            'reac_1' => 'nullable|date',
            'resa_1' => 'nullable|date',
            'reac_2' => 'nullable|date',
            'resa_2' => 'nullable|date',
            'reac_3' => 'nullable|date',
            'resa_3' => 'nullable|date',
            'reac_4' => 'nullable|date',
            'resa_4' => 'nullable|date',
            'fin_tutorias' => 'nullable|date',
            'informe_asistencia' => 'nullable|date',
            'evidencia_canalizacion' => 'nullable|date',
            'reporte_semestral' => 'nullable|date',
            'copias_actas' => 'nullable|date',
        ]);

        $calendario = Calendario::create($validated);

        return redirect()->route('calendario.pdf', $calendario->id);
    }

    public function generatePDF($id)
    {
        $calendario = Calendario::findOrFail($id);
        $html = view('pdf_template', compact('calendario'))->render();

        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);
        
        return $mpdf->Output('calendario.pdf', 'D');
    }
}

