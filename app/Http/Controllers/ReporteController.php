<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Compra;
use App\Models\Producto;
use App\Models\DetalleVenta;
use App\Models\DetalleCompra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\CarbonPeriod;

class ReporteController extends Controller
{
    public function index()
    {
        return view('reporte.index');
    }

    // Reporte de Ventas
    public function ventas(Request $request)
    {
        $fechaInicio = $request->get('fecha_inicio', Carbon::now()->startOfMonth());
        $fechaFin = $request->get('fecha_fin', Carbon::now()->endOfMonth());
        $tipoReporte = $request->get('tipo', 'diario'); // diario, semanal, mensual

        // Convertir fechas si son strings
        if (is_string($fechaInicio)) {
            $fechaInicio = Carbon::parse($fechaInicio);
        }
        if (is_string($fechaFin)) {
            $fechaFin = Carbon::parse($fechaFin);
        }

        // Obtener ventas del período
        $ventas = Venta::with(['vendedor', 'cliente', 'detalles.producto', 'devoluciones.detalles.producto'])
            ->whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->where('estado', Venta::ESTADO_COMPLETADA)
            ->orderBy('fecha', 'desc')
            ->get();

        // Obtener devoluciones del período
        $devoluciones = \App\Models\Devolucion::with(['venta', 'usuario', 'detalles.producto'])
            ->whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->orderBy('fecha', 'desc')
            ->get();

        // Estadísticas generales
        $totalVentas = $ventas->sum('total');
        $totalDevoluciones = $devoluciones->sum('total_devuelto');
        $ventasNetas = $totalVentas - $totalDevoluciones;
        $totalTransacciones = $ventas->count();
        $totalDevolucionesCount = $devoluciones->count();
        $promedioVenta = $totalTransacciones > 0 ? $totalVentas / $totalTransacciones : 0;
        $promedioVentaNeta = $totalTransacciones > 0 ? $ventasNetas / $totalTransacciones : 0;

        // Definir todos los métodos de pago posibles
        $todosLosMetodos = collect(['efectivo', 'tarjeta', 'transferencia', 'yape', 'plin']);

        // Obtener ventas por método de pago del período actual
        $ventasRealesPorMetodo = $ventas->groupBy('metodo_pago')
            ->map(function ($grupo) {
                return [
                    'total' => $grupo->sum('total'),
                    'cantidad' => $grupo->count()
                ];
            });

        // Combinar con la lista completa para asegurar que todos los métodos aparezcan
        $ventasPorMetodo = $todosLosMetodos->mapWithKeys(function ($metodo) use ($ventasRealesPorMetodo) {
            $datos = $ventasRealesPorMetodo->get($metodo, ['total' => 0, 'cantidad' => 0]);
            return [$metodo => $datos];
        });

        // Ventas por día/semana/mes
        $ventasAgrupadas = $this->agruparVentasPorPeriodo($ventas, $tipoReporte);

        // Productos más vendidos
        $productosMasVendidos = $this->obtenerProductosMasVendidos($fechaInicio, $fechaFin);

        // Productos más devueltos
        $productosMasDevueltos = $this->obtenerProductosMasDevueltos($fechaInicio, $fechaFin);

        return view('reporte.ventas', compact(
            'ventas',
            'devoluciones',
            'totalVentas',
            'totalDevoluciones',
            'ventasNetas',
            'totalTransacciones',
            'totalDevolucionesCount',
            'promedioVenta',
            'promedioVentaNeta',
            'ventasPorMetodo',
            'ventasAgrupadas',
            'productosMasVendidos',
            'productosMasDevueltos',
            'fechaInicio',
            'fechaFin',
            'tipoReporte'
        ));
    }

    // Reporte de Compras
    public function compras(Request $request)
    {
        $fechaInicio = $request->get('fecha_inicio', Carbon::now()->startOfMonth());
        $fechaFin = $request->get('fecha_fin', Carbon::now()->endOfMonth());
        $tipoReporte = $request->get('tipo', 'diario');

        if (is_string($fechaInicio)) {
            $fechaInicio = Carbon::parse($fechaInicio);
        }
        if (is_string($fechaFin)) {
            $fechaFin = Carbon::parse($fechaFin);
        }

        // Obtener compras del período
        $compras = Compra::with(['proveedor', 'user', 'detalles.producto'])
            ->whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->orderBy('fecha', 'desc')
            ->get();

        // Estadísticas generales
        $totalCompras = $compras->sum('total');
        $totalTransacciones = $compras->count();
        $promedioCompra = $totalTransacciones > 0 ? $totalCompras / $totalTransacciones : 0;

        // Compras por proveedor
        $comprasPorProveedor = $compras->groupBy('proveedor.nombre')
            ->map(function ($grupo) {
                return [
                    'total' => $grupo->sum('total'),
                    'cantidad' => $grupo->count()
                ];
            });

        // Compras agrupadas por período
        $comprasAgrupadas = $this->agruparComprasPorPeriodo($compras, $tipoReporte);

        // Productos más comprados
        $productosMasComprados = $this->obtenerProductosMasComprados($fechaInicio, $fechaFin);

        return view('reporte.compras', compact(
            'compras',
            'totalCompras',
            'totalTransacciones',
            'promedioCompra',
            'comprasPorProveedor',
            'comprasAgrupadas',
            'productosMasComprados',
            'fechaInicio',
            'fechaFin',
            'tipoReporte'
        ));
    }

    // Reporte de Ganancia/Pérdida
    public function ganancias(Request $request)
    {
        $fechaInicio = $request->get('fecha_inicio', Carbon::now()->startOfMonth());
        $fechaFin = $request->get('fecha_fin', Carbon::now()->endOfMonth());
        $tipoReporte = $request->get('tipo', 'diario');

        if (is_string($fechaInicio)) {
            $fechaInicio = Carbon::parse($fechaInicio);
        }
        if (is_string($fechaFin)) {
            $fechaFin = Carbon::parse($fechaFin);
        }

        // Obtener datos de ventas y compras
        $ventas = Venta::with('detalles.producto')
            ->whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->where('estado', Venta::ESTADO_COMPLETADA)
            ->get();

        $compras = Compra::with('detalles.producto')
            ->whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->get();

        // Calcular ingresos (ventas)
        $ingresos = $ventas->sum('total');

        // Calcular costos (compras)
        $costos = $compras->sum('total');

        // Calcular ganancia bruta
        $gananciaBruta = $ingresos - $costos;
        $margenGanancia = $ingresos > 0 ? ($gananciaBruta / $ingresos) * 100 : 0;

        // Análisis detallado por producto
        $analisisProductos = $this->analizarGananciaPorProducto($fechaInicio, $fechaFin);

        // Ganancia por período
        $gananciaPorPeriodo = $this->calcularGananciaPorPeriodo($fechaInicio, $fechaFin, $tipoReporte);

        return view('reporte.ganancias', compact(
            'ingresos',
            'costos',
            'gananciaBruta',
            'margenGanancia',
            'analisisProductos',
            'gananciaPorPeriodo',
            'fechaInicio',
            'fechaFin',
            'tipoReporte'
        ));
    }

    // Exportar reportes a PDF
    public function exportarVentas(Request $request)
    {
        $fechaInicio = Carbon::parse($request->input('fecha_inicio', Carbon::now()->startOfMonth()));
        $fechaFin = Carbon::parse($request->input('fecha_fin', Carbon::now()->endOfMonth()));

        $ventas = Venta::with(['vendedor', 'cliente'])
            ->whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->where('estado', Venta::ESTADO_COMPLETADA)
            ->get();

        $devoluciones = \App\Models\Devolucion::with(['venta', 'usuario'])
            ->whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->get();

        $totalVentas = $ventas->sum('total');
        $totalDevoluciones = $devoluciones->sum('total_devuelto');
        $ventasNetas = $totalVentas - $totalDevoluciones;

        $data = [
            'ventas' => $ventas,
            'devoluciones' => $devoluciones,
            'totalVentas' => $totalVentas,
            'totalDevoluciones' => $totalDevoluciones,
            'ventasNetas' => $ventasNetas,
            'totalTransacciones' => $ventas->count(),
            'totalDevolucionesCount' => $devoluciones->count(),
            'promedioVenta' => $ventas->count() > 0 ? $totalVentas / $ventas->count() : 0,
            'promedioVentaNeta' => $ventas->count() > 0 ? $ventasNetas / $ventas->count() : 0,
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin,
        ];

        $pdf = Pdf::loadView('reporte.exports.ventas', ['data' => $data]);
        return $pdf->download('reporte-ventas-' . now()->format('Y-m-d') . '.pdf');
    }

    public function exportarCompras(Request $request)
    {
        $fechaInicio = Carbon::parse($request->input('fecha_inicio', Carbon::now()->startOfMonth()));
        $fechaFin = Carbon::parse($request->input('fecha_fin', Carbon::now()->endOfMonth()));

        $compras = Compra::with(['proveedor', 'user'])
            ->whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->get();
            
        $data = [
            'compras' => $compras,
            'totalCompras' => $compras->sum('total'),
            'totalTransacciones' => $compras->count(),
            'promedioCompra' => $compras->count() > 0 ? $compras->sum('total') / $compras->count() : 0,
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin,
        ];

        $pdf = Pdf::loadView('reporte.exports.compras', ['data' => $data]);
        return $pdf->download('reporte-compras-' . now()->format('Y-m-d') . '.pdf');
    }

    public function exportarGanancias(Request $request)
    {
        $fechaInicio = Carbon::parse($request->input('fecha_inicio', Carbon::now()->startOfMonth()));
        $fechaFin = Carbon::parse($request->input('fecha_fin', Carbon::now()->endOfMonth()));

        $ventas = Venta::whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->where('estado', Venta::ESTADO_COMPLETADA)
            ->get();
        $compras = Compra::whereBetween('fecha', [$fechaInicio, $fechaFin])->get();

        $ingresos = $ventas->sum('total');
        $costos = $compras->sum('total');
        $gananciaBruta = $ingresos - $costos;
        $margenGanancia = $ingresos > 0 ? ($gananciaBruta / $ingresos) * 100 : 0;
        $analisisProductos = $this->analizarGananciaPorProducto($fechaInicio, $fechaFin);
        
        $data = [
            'ingresos' => $ingresos,
            'costos' => $costos,
            'gananciaBruta' => $gananciaBruta,
            'margenGanancia' => $margenGanancia,
            'analisisProductos' => $analisisProductos,
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin,
        ];

        $pdf = Pdf::loadView('reporte.exports.ganancias', ['data' => $data]);
        return $pdf->download('reporte-ganancias-' . now()->format('Y-m-d') . '.pdf');
    }

    // Métodos privados de análisis
    private function agruparVentasPorPeriodo($ventas, $tipo)
    {
        $ventasPorPeriodo = [];

        switch ($tipo) {
            case 'diario':
                $ventasPorPeriodo = $ventas->groupBy(function ($venta) {
                    return $venta->fecha->format('Y-m-d');
                })->map(function ($grupo) {
                    return $grupo->sum('total');
                });
                break;
            case 'semanal':
                $ventasPorPeriodo = $ventas->groupBy(function ($venta) {
                    return $venta->fecha->format('Y-W');
                })->map(function ($grupo) {
                    return $grupo->sum('total');
                });
                break;
            case 'mensual':
                $ventasPorPeriodo = $ventas->groupBy(function ($venta) {
                    return $venta->fecha->format('Y-m');
                })->map(function ($grupo) {
                    return $grupo->sum('total');
                });
                break;
        }

        return $ventasPorPeriodo;
    }

    private function agruparComprasPorPeriodo($compras, $tipo)
    {
        $comprasPorPeriodo = [];

        switch ($tipo) {
            case 'diario':
                $comprasPorPeriodo = $compras->groupBy(function ($compra) {
                    return $compra->fecha->format('Y-m-d');
                })->map(function ($grupo) {
                    return $grupo->sum('total');
                });
                break;
            case 'semanal':
                $comprasPorPeriodo = $compras->groupBy(function ($compra) {
                    return $compra->fecha->format('Y-W');
                })->map(function ($grupo) {
                    return $grupo->sum('total');
                });
                break;
            case 'mensual':
                $comprasPorPeriodo = $compras->groupBy(function ($compra) {
                    return $compra->fecha->format('Y-m');
                })->map(function ($grupo) {
                    return $grupo->sum('total');
                });
                break;
        }

        return $comprasPorPeriodo;
    }

    private function obtenerProductosMasVendidos($fechaInicio, $fechaFin)
    {
        return DetalleVenta::with('producto')
            ->join('ventas', 'detalle_ventas.venta_id', '=', 'ventas.id')
            ->whereBetween('ventas.fecha', [$fechaInicio, $fechaFin])
            ->where('ventas.estado', Venta::ESTADO_COMPLETADA)
            ->select(
                'producto_id', 
                DB::raw('SUM(cantidad) as total_vendido'),
                DB::raw('SUM(cantidad * precio_unitario) as total_ingresos')
            )
            ->groupBy('producto_id')
            ->orderBy('total_vendido', 'desc')
            ->limit(10)
            ->get();
    }

    private function obtenerProductosMasComprados($fechaInicio, $fechaFin)
    {
        return DetalleCompra::with('producto')
            ->join('compras', 'detalle_compras.compra_id', '=', 'compras.id')
            ->whereBetween('compras.fecha', [$fechaInicio, $fechaFin])
            ->select('producto_id', DB::raw('SUM(cantidad) as total_comprado'))
            ->groupBy('producto_id')
            ->orderBy('total_comprado', 'desc')
            ->limit(10)
            ->get();
    }

    private function obtenerProductosMasDevueltos($fechaInicio, $fechaFin)
    {
        return \App\Models\DetalleDevolucion::with('producto')
            ->join('devoluciones', 'detalle_devoluciones.devolucion_id', '=', 'devoluciones.id')
            ->whereBetween('devoluciones.fecha', [$fechaInicio, $fechaFin])
            ->select(
                'producto_id', 
                DB::raw('SUM(cantidad) as total_devuelto'),
                DB::raw('SUM(subtotal) as total_devuelto_monto')
            )
            ->groupBy('producto_id')
            ->orderBy('total_devuelto', 'desc')
            ->limit(10)
            ->get();
    }

    private function analizarGananciaPorProducto($fechaInicio, $fechaFin)
    {
        // Obtener ventas por producto
        $ventasPorProducto = DetalleVenta::with('producto')
            ->join('ventas', 'detalle_ventas.venta_id', '=', 'ventas.id')
            ->whereBetween('ventas.fecha', [$fechaInicio, $fechaFin])
            ->where('ventas.estado', Venta::ESTADO_COMPLETADA)
            ->select(
                'producto_id',
                DB::raw('SUM(cantidad) as cantidad_vendida'),
                DB::raw('SUM(cantidad * precio_unitario) as ingresos')
            )
            ->groupBy('producto_id')
            ->get();
            
        $analisis = [];

        foreach ($ventasPorProducto as $venta) {
            if (!$venta->producto) continue; // Si el producto fue eliminado

            $costos = $venta->cantidad_vendida * $venta->producto->precio_compra;
            $ganancia = $venta->ingresos - $costos;
            $margen = $venta->ingresos > 0 ? ($ganancia / $venta->ingresos) * 100 : 0;

            $analisis[] = [
                'producto' => $venta->producto,
                'cantidad_vendida' => $venta->cantidad_vendida,
                'ingresos' => $venta->ingresos,
                'costos' => $costos,
                'ganancia' => $ganancia,
                'margen' => $margen
            ];
        }

        return collect($analisis)->sortByDesc('ganancia')->values();
    }

    private function calcularGananciaPorPeriodo($fechaInicio, $fechaFin, $tipo)
    {
        $gananciaPorPeriodo = [];

        switch ($tipo) {
            case 'diario':
                $gananciaPorPeriodo = $this->calcularGananciaDiaria($fechaInicio, $fechaFin);
                break;
            case 'semanal':
                $gananciaPorPeriodo = $this->calcularGananciaSemanal($fechaInicio, $fechaFin);
                break;
            case 'mensual':
                $gananciaPorPeriodo = $this->calcularGananciaMensual($fechaInicio, $fechaFin);
                break;
        }

        return $gananciaPorPeriodo;
    }

    private function calcularGananciaDiaria($fechaInicio, $fechaFin)
    {
        $ventasPorDia = Venta::whereBetween('fecha', [$fechaInicio, $fechaFin])->where('estado', Venta::ESTADO_COMPLETADA)->get()->groupBy(fn($venta) => $venta->fecha->format('Y-m-d'))->map(fn($g) => $g->sum('total'));
        $comprasPorDia = Compra::whereBetween('fecha', [$fechaInicio, $fechaFin])->get()->groupBy(fn($compra) => $compra->fecha->format('Y-m-d'))->map(fn($g) => $g->sum('total'));

        $gananciaPorPeriodo = [];
        $periodo = CarbonPeriod::create($fechaInicio, $fechaFin);

        foreach ($periodo as $date) {
            $fechaKey = $date->format('Y-m-d');
            $ingresos = $ventasPorDia->get($fechaKey, 0);
            $costos = $comprasPorDia->get($fechaKey, 0);
            $gananciaPorPeriodo[$fechaKey] = ['ingresos' => $ingresos, 'costos' => $costos, 'ganancia' => $ingresos - $costos];
        }
        return $gananciaPorPeriodo;
    }

    private function calcularGananciaSemanal($fechaInicio, $fechaFin)
    {
        $ventasPorSemana = Venta::whereBetween('fecha', [$fechaInicio, $fechaFin])->where('estado', Venta::ESTADO_COMPLETADA)->get()->groupBy(fn($venta) => $venta->fecha->format('Y-W'))->map(fn($g) => $g->sum('total'));
        $comprasPorSemana = Compra::whereBetween('fecha', [$fechaInicio, $fechaFin])->get()->groupBy(fn($compra) => $compra->fecha->format('Y-W'))->map(fn($g) => $g->sum('total'));

        $gananciaPorPeriodo = [];
        $periodo = CarbonPeriod::create($fechaInicio->startOfWeek(), '1 week', $fechaFin->endOfWeek());

        foreach ($periodo as $date) {
            $semanaKey = $date->format('Y-W');
            $ingresos = $ventasPorSemana->get($semanaKey, 0);
            $costos = $comprasPorSemana->get($semanaKey, 0);
            $gananciaPorPeriodo[$semanaKey] = ['ingresos' => $ingresos, 'costos' => $costos, 'ganancia' => $ingresos - $costos];
        }
        return $gananciaPorPeriodo;
    }

    private function calcularGananciaMensual($fechaInicio, $fechaFin)
    {
        $ventasPorMes = Venta::whereBetween('fecha', [$fechaInicio, $fechaFin])->where('estado', Venta::ESTADO_COMPLETADA)->get()->groupBy(fn($venta) => $venta->fecha->format('Y-m'))->map(fn($g) => $g->sum('total'));
        $comprasPorMes = Compra::whereBetween('fecha', [$fechaInicio, $fechaFin])->get()->groupBy(fn($compra) => $compra->fecha->format('Y-m'))->map(fn($g) => $g->sum('total'));

        $gananciaPorPeriodo = [];
        $periodo = CarbonPeriod::create($fechaInicio->startOfMonth(), '1 month', $fechaFin->endOfMonth());

        foreach ($periodo as $date) {
            $mesKey = $date->format('Y-m');
            $ingresos = $ventasPorMes->get($mesKey, 0);
            $costos = $comprasPorMes->get($mesKey, 0);
            $gananciaPorPeriodo[$mesKey] = ['ingresos' => $ingresos, 'costos' => $costos, 'ganancia' => $ingresos - $costos];
        }
        return $gananciaPorPeriodo;
    }

    public function inventario()
    {
        // Productos sin stock
        $productosSinStock = \App\Models\Producto::with('categoria')->where('stock', '<=', 0)->get();
        // Top 10 productos con menor stock (para gráfico)
        $productosCriticos = \App\Models\Producto::with('categoria')->orderBy('stock', 'asc')->limit(10)->get();
        return view('reporte.inventario', compact('productosSinStock', 'productosCriticos'));
    }
}
