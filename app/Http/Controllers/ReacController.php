<?php

namespace App\Http\Controllers;

use App\Models\REAC;
use Illuminate\Http\Request;
use App\Models\Tutore;
use App\Models\Tutorado;
use Illuminate\Support\Facades\Storage;
use Mpdf\Mpdf;
use PDF;

class ReacController extends Controller
{
    public function create()
    {
        $tutors = Tutore::all();
        $tutorados = Tutorado::all();
        $fecha_entrega = date('Y-m-d'); 
        return view('reac', compact('tutors', 'tutorados', 'fecha_entrega'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tutor' => 'required',
            'firma' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'division' => 'required',
            'num_tutorados' => 'required',
            'fecha_entrega' => 'required|date',
            'semestre_grupo' => 'required',
            'horas_tutorias_semana' => 'required|numeric',
            'no_sesion' => 'required|array',
            'fecha_sesion' => 'required|array',
            'hora_sesion' => 'required|array',
            'modalidad' => 'required|array',
            'tema' => 'required|array',
            'evidencia_fotografica.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'evidencia_lista.*' => 'file|mimes:pdf,doc,docx|max:2048',
        ]);

        $firmaPath = $request->file('firma')->store('firmas', 'public');

        $evidenciasFotograficas = [];
        if ($request->hasFile('evidencia_fotografica')) {
            foreach ($request->file('evidencia_fotografica') as $file) {
                $path = $file->store('evidencias_fotograficas', 'public');
                $evidenciasFotograficas[] = $path;
            }
        }

        $evidenciasLista = [];
        if ($request->hasFile('evidencia_lista')) {
            foreach ($request->file('evidencia_lista') as $file) {
                $path = $file->store('evidencias_lista', 'public');
                $evidenciasLista[] = $path;
            }
        }


        $data = $request->all();
        $data['firma'] = $firmaPath;
        $data['evidencias_fotograficas'] = $evidenciasFotograficas;
        $data['evidencias_lista'] = $evidenciasLista;

        $pdf = Mpdf::loadView('reac_pdf', compact('data'));
        return $pdf->download('reac.pdf');
    }
}
