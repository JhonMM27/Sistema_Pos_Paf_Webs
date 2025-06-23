<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Venta;
use Illuminate\Validation\Rule;

class VentaRequest extends FormRequest
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
            'cliente_id' => 'nullable|exists:users,id',
            'metodo_pago' => [
                Rule::requiredIf($this->estado === Venta::ESTADO_COMPLETADA),
                'nullable',
                Rule::in(Venta::getMetodosPago())
            ],
            'total' => 'required|numeric|min:0',
            'estado' => 'required|in:' . implode(',', [
                Venta::ESTADO_PENDIENTE,
                Venta::ESTADO_COMPLETADA,
                Venta::ESTADO_ANULADA
            ]),
            'productos' => 'required|array|min:1',
            'productos.*.producto_id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1',
            'productos.*.precio_unitario' => 'required|numeric|min:0',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'cliente_id.exists' => 'El cliente seleccionado no existe.',
            'metodo_pago.required' => 'El método de pago es obligatorio.',
            'metodo_pago.in' => 'El método de pago seleccionado no es válido.',
            'total.required' => 'El total de la venta es obligatorio.',
            'total.numeric' => 'El total debe ser un número válido.',
            'total.min' => 'El total no puede ser negativo.',
            'estado.required' => 'El estado de la venta es obligatorio.',
            'estado.in' => 'El estado seleccionado no es válido.',
            'productos.required' => 'Debe agregar al menos un producto a la venta.',
            'productos.array' => 'Los productos deben ser una lista válida.',
            'productos.min' => 'Debe agregar al menos un producto.',
            'productos.*.producto_id.required' => 'El producto es obligatorio.',
            'productos.*.producto_id.exists' => 'El producto seleccionado no existe.',
            'productos.*.cantidad.required' => 'La cantidad es obligatoria.',
            'productos.*.cantidad.integer' => 'La cantidad debe ser un número entero.',
            'productos.*.cantidad.min' => 'La cantidad debe ser mayor a 0.',
            'productos.*.precio_unitario.required' => 'El precio unitario es obligatorio.',
            'productos.*.precio_unitario.numeric' => 'El precio unitario debe ser un número válido.',
            'productos.*.precio_unitario.min' => 'El precio unitario no puede ser negativo.',
        ];
    }
} 