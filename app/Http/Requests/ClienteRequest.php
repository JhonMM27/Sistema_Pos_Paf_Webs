<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'documento' => 'nullable|string|max:20|unique:users,documento',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del cliente es obligatorio.',
            'name.string' => 'El nombre debe ser texto.',
            'name.max' => 'El nombre no puede tener más de 255 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe tener un formato válido.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
            'documento.string' => 'El documento debe ser texto.',
            'documento.max' => 'El documento no puede tener más de 20 caracteres.',
            'documento.unique' => 'Este documento ya está registrado.',
            'telefono.string' => 'El teléfono debe ser texto.',
            'telefono.max' => 'El teléfono no puede tener más de 20 caracteres.',
            'direccion.string' => 'La dirección debe ser texto.',
            'direccion.max' => 'La dirección no puede tener más de 255 caracteres.',
        ];
    }
} 