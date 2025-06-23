@extends('layout.app')

@section('title', 'Realizar Devolución')

@push('estilos')
<style>
    .quantity-input {
        width: 80px;
    }
</style>
@endpush

@section('contenido')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-xl shadow-lg p-8 max-w-4xl mx-auto">

        <!-- Header -->
        <div class="border-b pb-6 mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Realizar Devolución</h1>
            <p class="text-gray-500 mt-2">
                Devolución para la Venta <a href="{{ route('ventas.show', $venta->id) }}" class="text-blue-600 hover:underline font-semibold">#{{ $venta->id }}</a>
            </p>
        </div>

        <!-- Información de la Venta Original -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <h3 class="font-semibold text-gray-700 mb-2">Detalles de la Venta</h3>
                <p><strong class="w-24 inline-block">Fecha:</strong> {{ $venta->fecha->format('d/m/Y h:i A') }}</p>
                <p><strong class="w-24 inline-block">Cliente:</strong> {{ $venta->cliente->name ?? 'Cliente General' }}</p>
                <p><strong class="w-24 inline-block">Vendedor:</strong> {{ $venta->vendedor->name ?? 'N/A' }}</p>
            </div>
            <div class="text-right">
                <h3 class="font-semibold text-gray-700 mb-2">Total Original</h3>
                <p class="text-3xl font-bold text-gray-800">{{ $venta->total_formateado }}</p>
            </div>
        </div>

        <form action="{{ route('devoluciones.store', $venta->id) }}" method="POST" id="form-devolucion">
            @csrf

            <!-- Tabla de Productos -->
            <div class="overflow-x-auto mb-6">
                <h3 class="font-semibold text-gray-700 mb-4">Selecciona los productos a devolver</h3>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Producto</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Cant. Vendida</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Cant. Devuelta</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Cant. a Devolver</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Precio Unit.</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Subtotal Devolución</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($venta->detalles as $detalle)
                            @php
                                $max_devolucion = $detalle->cantidad - $detalle->cantidad_devuelta;
                            @endphp
                            <tr>
                                <td class="px-6 py-4">{{ $detalle->producto->nombre }}</td>
                                <td class="px-6 py-4 text-center">{{ $detalle->cantidad }}</td>
                                <td class="px-6 py-4 text-center">{{ $detalle->cantidad_devuelta }}</td>
                                <td class="px-6 py-4 text-center">
                                    <input type="number" 
                                           name="productos[{{ $detalle->producto_id }}][cantidad]" 
                                           class="quantity-input text-center border rounded-md py-1"
                                           value="0" 
                                           min="0" 
                                           max="{{ $max_devolucion }}"
                                           data-precio="{{ $detalle->precio_unitario }}"
                                           onchange="calcularTotales()">
                                </td>
                                <td class="px-6 py-4 text-right">S/ {{ number_format($detalle->precio_unitario, 2) }}</td>
                                <td class="px-6 py-4 text-right subtotal-devolucion">S/ 0.00</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Motivo y Total -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label for="motivo" class="block font-medium text-gray-700 mb-2">Motivo de la Devolución (Opcional)</label>
                    <textarea name="motivo" id="motivo" rows="4" class="w-full border rounded-md p-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
                <div class="text-right">
                    <h3 class="font-semibold text-gray-700 mb-2">Total a Devolver</h3>
                    <p id="total-devolucion" class="text-4xl font-bold text-blue-600">S/ 0.00</p>
                </div>
            </div>

            <!-- Acciones -->
            <div class="flex justify-end gap-4 mt-8 border-t pt-6">
                <a href="{{ route('ventas.show', $venta->id) }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Cancelar</a>
                <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700" id="btn-submit">
                    <i class="fas fa-undo-alt mr-2"></i>Confirmar Devolución
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function calcularTotales() {
        let totalDevolucion = 0;
        const filas = document.querySelectorAll('tbody tr');

        filas.forEach(fila => {
            const input = fila.querySelector('.quantity-input');
            const cantidad = parseInt(input.value);
            const precio = parseFloat(input.dataset.precio);
            const subtotal = cantidad * precio;

            fila.querySelector('.subtotal-devolucion').textContent = `S/ ${subtotal.toFixed(2)}`;
            totalDevolucion += subtotal;
        });

        document.getElementById('total-devolucion').textContent = `S/ ${totalDevolucion.toFixed(2)}`;
    }

    document.getElementById('form-devolucion').addEventListener('submit', function(e) {
        let totalCantidad = 0;
        document.querySelectorAll('.quantity-input').forEach(input => {
            totalCantidad += parseInt(input.value);
        });

        if (totalCantidad <= 0) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Debes seleccionar al menos un producto para devolver.',
            });
            return;
        }

        e.target.querySelector('#btn-submit').disabled = true;
        e.target.querySelector('#btn-submit').innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Procesando...';
    });
</script>
@endpush 