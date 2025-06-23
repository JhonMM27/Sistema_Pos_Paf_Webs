<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProvedorRequest extends FormRequest
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
            'nombre' => 'required|string|max:255',
            'TipoProveedor_id' => 'required|exists:tipo_proveedors,id',
            'ruc_dni' => 'required|string|max:20|unique:provedors,ruc_dni',
            'telefono' => 'required|string|max:20',
            'direccion' => 'nullable|string|max:500',
            'correo' => 'nullable|email|max:255|unique:provedors,correo',
            'observaciones' => 'nullable|string|max:1000',
        ];
    }

    /**
     * Get the custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'TipoProveedor_id.required' => 'El tipo de proveedor es obligatorio.',
            'TipoProveedor_id.exists' => 'El tipo de proveedor no es válido.',
            'ruc_dni.required' => 'El RUC/DNI es obligatorio.',
            'ruc_dni.unique' => 'El RUC/DNI ya está registrado.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'correo.email' => 'El correo debe tener un formato válido.',
            'correo.unique' => 'El correo electrónico ya está registrado.',
        ];
    }
} 