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
            'nombre' => 'required|min:3|max:50',
            'email' => 'required|min:3|email',
            'password' => 'required|min:8',
            'rol' => 'required|in:admin,user',
            'permissions' => 'required|array',
        ];
    }
    public function messages(): array
    {
        return [
            'nombre.required' => 'El campo nombre es obligatorio',
            'nombre.min' => 'El campo nombre debe tener al menos 3 caracteres',
            'nombre.max' => 'El campo nombre debe tener como maximo 50 caracteres',
            'email.required' => 'El campo email es obligatorio',
            'email.min' => 'El correo electrónico debe tener al menos 3 caracteres',
            'email.email' => 'El campo email debe ser un correo electrónico',
            'password.required' => 'El campo contraseña es obligatorio',
            'password.min' => 'El campo contraseña debe tener al menos 8 caracteres',
            'rol.required' => 'El campo rol es obligatorio',
            'rol.in' => 'El campo rol debe ser admin o user',
            'permissions.required' => 'El campo permisos es obligatorio',
            'permissions.array' => 'El campo permisos debe ser un arreglo',
        ];
    }
}
