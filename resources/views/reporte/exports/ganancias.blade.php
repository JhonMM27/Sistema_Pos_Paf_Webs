<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Ganancias</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; color: #333; }
        @page { margin: 180px 50px; }
        header { position: fixed; top: -140px; left: 0; right: 0; height: 120px; text-align: center; }
        header .logo { width: 100px; height: auto; position: absolute; left: 0; }
        header .title-container { position: absolute; top: 0; left: 120px; right: 0; text-align: center; }
        header h1 { font-size: 24px; margin: 0; color: #2e7d32; }
        header h2 { font-size: 16px; margin: 5px 0; }
        header p { font-size: 12px; margin: 5px 0; }
        footer { position: fixed; bottom: -60px; left: 0; right: 0; height: 50px; font-size: 10px; text-align: center; }
        footer .page-number:before { content: "Página " counter(page); }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; font-size: 11px; }
        th { background-color: #2e7d32; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        .summary { background-color: #e8f5e9; padding: 15px; border-left: 5px solid #2e7d32; margin-bottom: 20px; }
        .summary h3 { margin-top: 0; font-size: 16px; color: #2e7d32;}
        .summary p { margin: 8px 0; font-size: 14px; display: flex; justify-content: space-between; }
        .summary p strong { font-weight: bold; }
        .section-title { font-size: 18px; color: #2e7d32; border-bottom: 2px solid #2e7d32; padding-bottom: 5px; margin-top: 25px; margin-bottom: 15px;}
    </style>
</head>
<body>
    <header>
        <img src="{{ public_path('img/Logo-Tienda.jpg') }}" alt="Logo" class="logo">
        <div class="title-container">
            <h1>Reporte de Ganancias</h1>
            <h2>Nombre de la Tienda</h2>
            <p>Período del {{ $data['fechaInicio']->format('d/m/Y') }} al {{ $data['fechaFin']->format('d/m/Y') }}</p>
            <p>Generado el: {{ now()->format('d/m/Y H:i') }}</p>
        </div>
    </header>

    <footer>
        Sistema de Punto de Venta | <span class="page-number"></span>
    </footer>

    <main>
        <div class="summary">
            <h3>Resumen Financiero</h3>
            <p><span>Ingresos Totales (Ventas):</span> <strong>S/ {{ number_format($data['ingresos'], 2) }}</strong></p>
            <p><span>Costos Totales (Compras):</span> <strong>S/ {{ number_format($data['costos'], 2) }}</strong></p>
            <p><span>Ganancia Bruta:</span> <strong>S/ {{ number_format($data['gananciaBruta'], 2) }}</strong></p>
            <p><span>Margen de Ganancia:</span> <strong>{{ number_format($data['margenGanancia'], 2) }}%</strong></p>
        </div>

        <h3 class="section-title">Análisis de Ganancia por Producto</h3>
        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cant. Vendida</th>
                    <th>Ingresos</th>
                    <th>Costos</th>
                    <th>Ganancia</th>
                    <th>Margen</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data['analisisProductos'] as $item)
                    <tr>
                        <td>{{ $item['producto'] ? $item['producto']->nombre : 'N/A' }}</td>
                        <td style="text-align: center;">{{ $item['cantidad_vendida'] }}</td>
                        <td>S/ {{ number_format($item['ingresos'], 2) }}</td>
                        <td>S/ {{ number_format($item['costos'], 2) }}</td>
                        <td>S/ {{ number_format($item['ganancia'], 2) }}</td>
                        <td style="text-align: right;">{{ number_format($item['margen'], 2) }}%</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center;">No hay datos de productos para el período seleccionado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </main>
</body>
</html> 