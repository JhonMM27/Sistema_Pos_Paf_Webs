<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
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
            // 'nombre' => 'required|min:3|max:50',
            // 'codigo' => 'required|numeric|min:0',
            // 'stock' => 'required|numeric|min:0',
            // 'categoria_id' => 'required|exists:categorias,id',
        ];
    }

    public function messages(): array
    {
        return [
            // 'nombre.required' => 'El campo nombre es obligatorio',
            // 'nombre.min' => 'El campo nombre debe tener al menos 3 caracteres',
            // 'nombre.max' => 'El campo nombre debe tener como maximo 50 caracteres',
            // 'precio.required' => 'El campo precio es obligatorio',
            // 'precio.numeric' => 'El campo precio debe ser un número',
            // 'precio.min' => 'El campo precio debe ser mayor o igual a 0',
            // 'stock.required' => 'El campo stock es obligatorio',
            // 'stock.numeric' => 'El campo stock debe ser un número',
            // 'stock.min' => 'El campo stock debe ser mayor o igual a 0',
            // 'categoria_id.required' => 'El campo categoría es obligatorio',
            // 'categoria_id.exists' => 'La categoría seleccionada no es válida',
        ];
    }
}
