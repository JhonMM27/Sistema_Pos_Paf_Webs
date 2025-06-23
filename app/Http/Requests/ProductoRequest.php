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
        $productoId = $this->route('producto');
        return [
            'nombre' => 'required|string|max:100',
            'codigo_barras' => 'required|string|max:50|unique:productos,codigo_barras,' . ($productoId ? $productoId : 'NULL'),
            'descripcion' => 'nullable|string|max:255',
            'precio' => 'required|numeric|min:0',
            'precio_compra' => 'required|numeric|min:0|lte:precio',
            'stock' => 'required|integer|min:0',
            'estado' => 'required|boolean',
            'categoria_id' => 'required|exists:categorias,id',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser texto.',
            'nombre.max' => 'El nombre no debe exceder los 100 caracteres.',
            'codigo_barras.required' => 'El código de barras es obligatorio.',
            'codigo_barras.string' => 'El código de barras debe ser texto.',
            'codigo_barras.max' => 'El código de barras no debe exceder los 50 caracteres.',
            'codigo_barras.unique' => 'El código de barras ya está registrado.',
            'descripcion.string' => 'La descripción debe ser texto.',
            'descripcion.max' => 'La descripción no debe exceder los 255 caracteres.',
            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número.',
            'precio.min' => 'El precio debe ser mayor o igual a 0.',
            'precio_compra.required' => 'El precio de compra es obligatorio.',
            'precio_compra.numeric' => 'El precio de compra debe ser un número.',
            'precio_compra.min' => 'El precio de compra debe ser mayor o igual a 0.',
            'precio_compra.lte' => 'El precio de compra no puede ser mayor al precio de venta.',
            'stock.required' => 'El stock es obligatorio.',
            'stock.integer' => 'El stock debe ser un número entero.',
            'stock.min' => 'El stock debe ser mayor o igual a 0.',
            'estado.required' => 'El estado es obligatorio.',
            'estado.boolean' => 'El estado debe ser válido.',
            'categoria_id.required' => 'La categoría es obligatoria.',
            'categoria_id.exists' => 'La categoría seleccionada no es válida.',
        ];
    }
}
