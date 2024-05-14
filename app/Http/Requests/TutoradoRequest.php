<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TutoradoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
			'semestre' => 'required|string',
			'grupo' => 'required|string',
			'carrera' => 'required|string',
			'numerocontrol' => 'required|string',
			'nombre' => 'required|string',
			'a_paterno' => 'required|string',
			'a_materno' => 'required|string',
			'correoelectronico' => 'required|string',
			'contraseña' => 'required|string',
			'role' => 'required|string',
        ];
    }
}
