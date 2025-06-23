@extends('layout.app')

@section('title', 'Eliminar Compra')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-md mx-auto">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center mb-6">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-triangle text-red-600 text-3xl"></i>
                </div>
                <div class="ml-3">
                    <h1 class="text-xl font-semibold text-gray-800">Confirmar Eliminación</h1>
                </div>
            </div>

            <div class="mb-6">
                <p class="text-gray-600 mb-4">
                    ¿Estás seguro de que deseas eliminar la compra #{{ $compra->id }}?
                </p>
                
                <div class="bg-red-50 border border-red-200 rounded-md p-4">
                    <h3 class="text-sm font-medium text-red-800 mb-2">Información de la Compra:</h3>
                    <ul class="text-sm text-red-700 space-y-1">
                        <li><strong>Proveedor:</strong> {{ $compra->proveedor->nombre }}</li>
                        <li><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($compra->fecha)->format('d/m/Y') }}</li>
                        <li><strong>Total:</strong> ${{ number_format($compra->total, 2) }}</li>
                        <li><strong>Productos:</strong> {{ $compra->detalles->count() }} productos</li>
                    </ul>
                </div>

                <div class="bg-yellow-50 border border-yellow-200 rounded-md p-4 mt-4">
                    <h3 class="text-sm font-medium text-yellow-800 mb-2">⚠️ Advertencia:</h3>
                    <p class="text-sm text-yellow-700">
                        Esta acción eliminará la compra y revertirá el stock de todos los productos involucrados. 
                        Esta operación no se puede deshacer.
                    </p>
                </div>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('compras.show', $compra) }}" 
                   class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                    Cancelar
                </a>
                
                <form action="{{ route('compras.destroy', $compra) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                        <i class="fas fa-trash mr-2"></i>
                        Eliminar Compra
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 