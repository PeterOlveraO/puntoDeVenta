<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmpleadoRequest extends FormRequest
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
            'nombre' => 'sometimes|required|string|max:255',
            'apellido_paterno' => 'sometimes|required|string|max:255',
            'apellido_materno' => 'sometimes|required|string|max:255',
            'telefono' => 'sometimes|required|string|max:255',
            'usuario' => 'sometimes|required|string|max:255',
            'contrasena' => 'sometimes|required|string|max:255',
            'administrador' => 'sometimes|required|boolean',
            'activo' => 'sometimes|required|boolean'
        ];
    }
}
