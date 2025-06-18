<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaRequest extends FormRequest
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
            'nombre' => 'required|string|max:50',
            'descripcion' => 'required|string',
            'estado' => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            // Nombre
            'nombre.required' => 'El campo nombre es obligatorio',
            'nombre.string' => 'El campo nombre debe ser texto',
            'nombre.max' => 'El campo nombre no debe exceder los 50 caracteres',

            // Descripción
            'descripcion.required' => 'El campo descripción es obligatorio',
            'descripcion.string' => 'El campo descripción debe ser texto',

            // Estado
            'estado.required' => 'Debe seleccionar un estado',
            'estado.boolean' => 'El valor del estado debe ser válido (Activo o Inactivo)',
        ];
    }
}