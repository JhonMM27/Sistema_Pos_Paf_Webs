@extends('layout.app')

@section('title', 'Comprobante de Compra - #' . $compra->id)

@php
    $hideSidebar = true;
@endphp

@push('estilos')
    <style>
    body {
        background-color: #f4f6f9;
    }
    .receipt-main-container {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        padding: 20px;
        margin: 0 auto;
        max-width: 100%;
    }
    .receipt-modern-container {
        width: 100%;
        max-width: 800px;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #333;
        overflow: hidden;
    }
    .receipt-modern-header {
        background-color: #4a5568;
        color: #fff;
        padding: 30px;
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .receipt-logo img {
        max-height: 60px;
        border-radius: 8px;
    }
    .receipt-title h1 {
        margin: 0;
        font-size: 2rem;
        font-weight: 300;
        text-transform: uppercase;
        letter-spacing: 2px;
    }
    .receipt-body {
        padding: 30px;
    }
    .receipt-section {
        margin-bottom: 25px;
    }
    .receipt-section h5 {
        font-size: 1rem;
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 15px;
        text-transform: uppercase;
        letter-spacing: 1px;
        border-bottom: 1px solid #e2e8f0;
        padding-bottom: 8px;
    }
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 10px 20px;
    }
    .info-grid p {
        margin: 0;
        font-size: 0.95rem;
    }
    .info-grid strong {
        color: #555;
    }
    .receipt-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    .receipt-table thead {
        background-color: #edf2f7;
    }
    .receipt-table th, .receipt-table td {
        padding: 12px 15px;
        text-align: left;
    }
    .receipt-table th {
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
    }
    .receipt-table tbody tr {
        border-bottom: 1px solid #e2e8f0;
    }
    .receipt-table .text-center { text-align: center; }
    .receipt-table .text-right { text-align: right; }
    .receipt-totals {
        margin-top: 30px;
        display: flex;
        justify-content: flex-end;
    }
    .totals-table {
        width: 100%;
        max-width: 300px;
    }
    .totals-table td {
        padding: 8px 0;
        font-size: 1rem;
    }
    .totals-table .total-label {
        font-weight: 600;
    }
    .totals-table .grand-total td {
        border-top: 2px solid #4a5568;
        padding-top: 10px;
        font-size: 1.4rem;
        font-weight: bold;
        color: #4a5568;
    }
    .receipt-footer {
        text-align: center;
        padding: 30px;
        border-top: 1px solid #e2e8f0;
        font-size: 0.9rem;
        color: #718096;
    }
    .action-buttons {
        padding: 20px;
        background-color: #f8f9fa;
        border-bottom-left-radius: 12px;
        border-bottom-right-radius: 12px;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 1rem;
    }

    @media (max-width: 640px) {
        .receipt-modern-header {
            flex-direction: column;
            text-align: center;
            gap: 1rem;
        }
        .receipt-body {
            padding: 15px;
        }
        .receipt-table {
            display: block;
            overflow-x: auto;
            width: 100%;
        }
        .receipt-table table {
            min-width: 600px;
        }
    }

    @media print {
        body { background-color: #fff; }
        .no-print, .action-buttons {
            display: none !important;
        }
        .receipt-main-container {
            padding: 0;
        }
        .receipt-modern-container {
            box-shadow: none;
            border: none;
            border-radius: 0;
            max-width: 100%;
            margin: 0;
            padding: 0;
        }
        .receipt-body {
            padding: 20px 10px;
        }
    }
    </style>
@endpush

@section('contenido')
<div class="receipt-main-container">
    <div class="print-section receipt-modern-container">
        <div class="no-print p-4 border-b border-gray-200">
            <h1 class="text-xl font-bold">Detalle de Compra</h1>
            <ol class="breadcrumb mt-2 text-sm text-gray-500">
                <li class="breadcrumb-item inline-block"><a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a></li>
                <li class="breadcrumb-item inline-block mx-2">/</li>
                <li class="breadcrumb-item inline-block"><a href="{{ route('compras.index') }}" class="hover:underline">Compras</a></li>
                <li class="breadcrumb-item inline-block mx-2">/</li>
                <li class="breadcrumb-item active inline-block">Comprobante #{{ $compra->id }}</li>
            </ol>
        </div>

        <div class="receipt-modern-header">
            <div class="receipt-logo">
                <img src="{{ asset('img/Logo-Tienda.jpg') }}" alt="Logo de la Tienda">
            </div>
            <div class="receipt-title">
                <h1>Comprobante</h1>
            </div>
        </div>

        <div class="receipt-body">
            <div class="receipt-section info-section">
                <div class="info-grid">
                    <p><strong>Nº de Compra:</strong> #{{ $compra->id }}</p>
                    <p><strong>Fecha y Hora:</strong> {{ \Carbon\Carbon::parse($compra->fecha_compra)->format('d/m/Y h:i A') }}</p>
                    <p><strong>Registrado por:</strong> {{ $compra->user->name ?? 'N/A' }}</p>
                    <p><strong>Estado:</strong>
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ ($compra->estado === 'registrada' || $compra->estado === 'activo') ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ ucfirst($compra->estado) }}
                        </span>
                    </p>
                </div>
            </div>

            <div class="receipt-section client-section">
                <h5>Proveedor</h5>
                <div class="info-grid">
                    <p><strong>Nombre:</strong> {{ $compra->proveedor->nombre_o_razon_social ?? 'N/A' }}</p>
                    <p><strong>RUC/DNI:</strong> {{ $compra->proveedor->ruc_dni ?? 'N/A' }}</p>
                </div>
            </div>

            <div class="receipt-section items-section">
                <h5>Resumen de la Compra</h5>
                <div class="overflow-x-auto">
                    <table class="receipt-table">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th class="text-center">Cant.</th>
                                <th class="text-right">Costo Unitario</th>
                                <th class="text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($compra->detalles as $detalle)
                            <tr>
                                <td>{{ $detalle->producto->nombre ?? 'Producto no encontrado' }}</td>
                                <td class="text-center">{{ $detalle->cantidad }}</td>
                                <td class="text-right">S/ {{ number_format($detalle->precio_unitario, 2) }}</td>
                                <td class="text-right">S/ {{ number_format($detalle->cantidad * $detalle->precio_unitario, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="receipt-totals">
                <table class="totals-table">
                    @php
                        $impuestoDecimal = $compra->impuesto > 0 ? $compra->impuesto / 100 : 0;
                        $subtotal = $compra->total / (1 + $impuestoDecimal);
                        $impuestoCalculado = $compra->total - $subtotal;
                    @endphp
                    <tr>
                        <td class="total-label">Subtotal</td>
                        <td class="text-right">S/ {{ number_format($subtotal, 2) }}</td>
                    </tr>
                    <tr>
                        <td class="total-label">Impuesto ({{$compra->impuesto}}%)</td>
                        <td class="text-right">S/ {{ number_format($impuestoCalculado, 2) }}</td>
                    </tr>
                    <tr class="grand-total">
                        <td class="total-label">Total</td>
                        <td class="text-right">S/ {{ number_format($compra->total, 2) }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="receipt-footer">
            <p>Comprobante de Ingreso de Mercancía.</p>
        </div>

        <div class="action-buttons no-print">
            <button onclick="window.print()" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors flex items-center">
                <i class="fas fa-print mr-2"></i> Imprimir Comprobante
            </button>

            <a href="{{ route('compras.index') }}" class="px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Volver
            </a>

            @if($compra->estado !== 'anulada')
                <form action="{{ route('compras.destroy', $compra->id) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de anular esta compra? La acción revertirá el stock de los productos.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors flex items-center">
                        <i class="fas fa-ban mr-2"></i> Anular Compra
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
