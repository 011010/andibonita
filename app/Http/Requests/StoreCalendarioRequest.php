<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request: StoreCalendarioRequest
 *
 * Maneja la validación de datos para crear un calendario de tutorías.
 * Valida todas las fechas importantes del semestre.
 */
class StoreCalendarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Todos los usuarios autenticados pueden crear calendarios
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'documento' => 'required|string|max:255',
            'periodo' => 'required|string|max:255',
            'fecha_entrega' => 'required|date|before_or_equal:today',
            'inicio_tutorias' => 'nullable|date|after_or_equal:fecha_entrega',
            'reac_1' => 'nullable|date|after_or_equal:inicio_tutorias',
            'resa_1' => 'nullable|date|after_or_equal:reac_1',
            'reac_2' => 'nullable|date|after_or_equal:resa_1',
            'resa_2' => 'nullable|date|after_or_equal:reac_2',
            'reac_3' => 'nullable|date|after_or_equal:resa_2',
            'resa_3' => 'nullable|date|after_or_equal:reac_3',
            'reac_4' => 'nullable|date|after_or_equal:resa_3',
            'resa_4' => 'nullable|date|after_or_equal:reac_4',
            'fin_tutorias' => 'nullable|date|after_or_equal:resa_4',
            'informe_asistencia' => 'nullable|date',
            'evidencia_canalizacion' => 'nullable|date',
            'reporte_semestral' => 'nullable|date',
            'copias_actas' => 'nullable|date',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'documento.required' => 'El nombre del documento es obligatorio.',
            'periodo.required' => 'El período es obligatorio.',
            'fecha_entrega.required' => 'La fecha de entrega es obligatoria.',
            'fecha_entrega.before_or_equal' => 'La fecha de entrega no puede ser futura.',
            'inicio_tutorias.after_or_equal' => 'El inicio de tutorías debe ser después de la fecha de entrega.',
            'reac_1.after_or_equal' => 'REAC 1 debe ser después del inicio de tutorías.',
            'resa_1.after_or_equal' => 'RESA 1 debe ser después de REAC 1.',
            'reac_2.after_or_equal' => 'REAC 2 debe ser después de RESA 1.',
            'resa_2.after_or_equal' => 'RESA 2 debe ser después de REAC 2.',
            'reac_3.after_or_equal' => 'REAC 3 debe ser después de RESA 2.',
            'resa_3.after_or_equal' => 'RESA 3 debe ser después de REAC 3.',
            'reac_4.after_or_equal' => 'REAC 4 debe ser después de RESA 3.',
            'resa_4.after_or_equal' => 'RESA 4 debe ser después de REAC 4.',
            'fin_tutorias.after_or_equal' => 'El fin de tutorías debe ser después de RESA 4.',
        ];
    }
}
