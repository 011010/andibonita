<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
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
			'imagendeperfil' => 'nullable|string',
			'nombres' => 'nullable|string',
			'a_paterno' => 'nullable|string',
			'a_materno' => 'nullable|string',
			'teléfono' => 'nullable|string',
			'perfil' => 'nullable|string',
			'correoelectronico' => 'required|string',
			'contraseña' => 'required|string',
			'role' => 'required|string',
        ];
    }
}
