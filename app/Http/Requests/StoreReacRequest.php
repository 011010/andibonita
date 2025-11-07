<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form Request: StoreReacRequest
 *
 * Maneja la validación de datos para crear un nuevo reporte REAC.
 * Separa la lógica de validación del controlador siguiendo mejores prácticas.
 *
 * Validaciones incluidas:
 * - Datos del tutor y división
 * - Información del reporte
 * - Archivos de firma y evidencias
 * - Arrays de sesiones múltiples
 */
class StoreReacRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // TODO: Implementar lógica de autorización según roles
        // Por ahora permitimos a todos los usuarios autenticados
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            // Información del tutor
            'tutor_id' => 'nullable|exists:tutores,id',
            'tutor' => 'required|string|max:255',

            // Información de la división
            'division_id' => 'nullable|exists:divisions,id',
            'division' => 'required|string|max:100',

            // Información general del reporte
            'num_tutorados' => 'required|integer|min:1|max:100',
            'fecha_entrega' => 'required|date|before_or_equal:today',
            'semestre_grupo' => 'required|string|max:50',
            'horas_tutorias_semana' => 'required|numeric|min:0.5|max:40',

            // Firma del tutor (imagen)
            'firma' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            // Sesiones (arrays)
            'no_sesion' => 'required|array|min:1',
            'no_sesion.*' => 'required|integer|min:1',

            'fecha_sesion' => 'required|array|min:1',
            'fecha_sesion.*' => 'required|date',

            'hora_sesion' => 'required|array|min:1',
            'hora_sesion.*' => 'required|date_format:H:i',

            'modalidad' => 'required|array|min:1',
            'modalidad.*' => 'required|in:presencial,virtual,hibrida',

            'tema' => 'required|array|min:1',
            'tema.*' => 'required|string|max:255',

            // Grupal es opcional (checkbox)
            'grupal' => 'nullable|array',
            'grupal.*' => 'nullable|boolean',

            // Evidencias (opcionales)
            'evidencia_fotografica' => 'nullable|array|max:10',
            'evidencia_fotografica.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',

            'evidencia_lista' => 'nullable|array|max:10',
            'evidencia_lista.*' => 'nullable|file|mimes:pdf,doc,docx|max:10240',

            // Observaciones (opcional)
            'observaciones' => 'nullable|string|max:1000',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            // Mensajes del tutor
            'tutor.required' => 'El nombre del tutor es obligatorio.',
            'tutor_id.exists' => 'El tutor seleccionado no existe.',

            // Mensajes de la división
            'division.required' => 'La división es obligatoria.',
            'division_id.exists' => 'La división seleccionada no existe.',

            // Mensajes de información general
            'num_tutorados.required' => 'El número de tutorados es obligatorio.',
            'num_tutorados.min' => 'Debe haber al menos 1 tutorado.',
            'num_tutorados.max' => 'El número máximo de tutorados es 100.',

            'fecha_entrega.required' => 'La fecha de entrega es obligatoria.',
            'fecha_entrega.before_or_equal' => 'La fecha de entrega no puede ser futura.',

            'semestre_grupo.required' => 'El semestre/grupo es obligatorio.',

            'horas_tutorias_semana.required' => 'Las horas de tutoría por semana son obligatorias.',
            'horas_tutorias_semana.min' => 'El mínimo de horas es 0.5.',
            'horas_tutorias_semana.max' => 'El máximo de horas es 40.',

            // Mensajes de la firma
            'firma.required' => 'La firma del tutor es obligatoria.',
            'firma.image' => 'La firma debe ser una imagen.',
            'firma.mimes' => 'La firma debe ser de tipo: jpeg, png, jpg, gif o svg.',
            'firma.max' => 'La firma no debe pesar más de 2MB.',

            // Mensajes de sesiones
            'no_sesion.required' => 'Debe agregar al menos una sesión.',
            'no_sesion.*.required' => 'El número de sesión es obligatorio.',

            'fecha_sesion.required' => 'La fecha de la sesión es obligatoria.',
            'fecha_sesion.*.date' => 'La fecha de la sesión debe ser válida.',

            'hora_sesion.required' => 'La hora de la sesión es obligatoria.',
            'hora_sesion.*.date_format' => 'La hora debe tener formato HH:MM.',

            'modalidad.required' => 'La modalidad de la sesión es obligatoria.',
            'modalidad.*.in' => 'La modalidad debe ser: presencial, virtual o híbrida.',

            'tema.required' => 'El tema de la sesión es obligatorio.',
            'tema.*.max' => 'El tema no debe exceder 255 caracteres.',

            // Mensajes de evidencias
            'evidencia_fotografica.max' => 'Máximo 10 evidencias fotográficas.',
            'evidencia_fotografica.*.image' => 'Cada evidencia fotográfica debe ser una imagen.',
            'evidencia_fotografica.*.mimes' => 'Las evidencias fotográficas deben ser: jpeg, png, jpg o gif.',
            'evidencia_fotografica.*.max' => 'Cada evidencia fotográfica no debe pesar más de 5MB.',

            'evidencia_lista.max' => 'Máximo 10 evidencias de lista.',
            'evidencia_lista.*.file' => 'Cada evidencia de lista debe ser un archivo.',
            'evidencia_lista.*.mimes' => 'Las evidencias de lista deben ser: pdf, doc o docx.',
            'evidencia_lista.*.max' => 'Cada evidencia de lista no debe pesar más de 10MB.',

            // Observaciones
            'observaciones.max' => 'Las observaciones no deben exceder 1000 caracteres.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes()
    {
        return [
            'tutor' => 'nombre del tutor',
            'division' => 'división',
            'num_tutorados' => 'número de tutorados',
            'fecha_entrega' => 'fecha de entrega',
            'semestre_grupo' => 'semestre/grupo',
            'horas_tutorias_semana' => 'horas de tutoría por semana',
            'firma' => 'firma del tutor',
            'no_sesion.*' => 'número de sesión',
            'fecha_sesion.*' => 'fecha de sesión',
            'hora_sesion.*' => 'hora de sesión',
            'modalidad.*' => 'modalidad',
            'tema.*' => 'tema',
            'evidencia_fotografica.*' => 'evidencia fotográfica',
            'evidencia_lista.*' => 'evidencia de lista',
        ];
    }

    /**
     * Validación adicional después de las reglas básicas
     *
     * @param \Illuminate\Validation\Validator $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Validar que todos los arrays de sesiones tengan la misma longitud
            $noSesion = $this->input('no_sesion', []);
            $fechaSesion = $this->input('fecha_sesion', []);
            $horaSesion = $this->input('hora_sesion', []);
            $modalidad = $this->input('modalidad', []);
            $tema = $this->input('tema', []);

            $counts = [
                count($noSesion),
                count($fechaSesion),
                count($horaSesion),
                count($modalidad),
                count($tema),
            ];

            if (count(array_unique($counts)) > 1) {
                $validator->errors()->add(
                    'sesiones',
                    'Todas las sesiones deben tener datos completos.'
                );
            }

            // Validar que no haya números de sesión duplicados
            if (count($noSesion) !== count(array_unique($noSesion))) {
                $validator->errors()->add(
                    'no_sesion',
                    'Los números de sesión no pueden estar duplicados.'
                );
            }
        });
    }
}
