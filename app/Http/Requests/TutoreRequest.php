<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TutoreRequest extends FormRequest
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
			'division' => 'required|string',
			'nombre' => 'required|string',
			'a_paterno' => 'required|string',
			'a_materno' => 'required|string',
			'correo_electronico' => 'required|string',
			'contraseña' => 'required|string',
        ];
    }
}
