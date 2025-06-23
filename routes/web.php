<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProvedorController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\DevolucionController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\ReporteController;
// use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
// use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/', function () {
    return view('login.index');
});



Route::middleware(['auth'])->group(function () {
    



Route::prefix('inventario')->group(function () {
        // Route::get('/', function () {
        //     return view('inventario.index');
        // })->name('inventario.index');        
        Route::resource('categorias', CategoriaController::class);
        Route::resource('productos', ProductoController::class);
        Route::get('productos-categorias', [ProductoController::class, 'categorias'])->name('productos.categorias');
        Route::get('productos-unidades', [ProductoController::class, 'unidades'])->name('productos.unidades');
        
    });
    
    Route::resource('proveedores', ProvedorController::class);
    Route::resource('compras', CompraController::class)->except(['edit', 'update']);
    Route::resource('clientes', ClienteController::class);
    Route::resource('configuracion', UserController::class);

    // Rutas API para la interfaz de ventas
    Route::prefix('api/pos')->name('api.pos.')->group(function () {
        Route::get('buscar-producto', [VentaController::class, 'buscarProducto'])->name('buscar-producto');
        Route::get('buscar-productos', [VentaController::class, 'buscarProductos'])->name('buscar-productos');
        Route::post('registrar-cliente', [VentaController::class, 'registrarCliente'])->name('registrar-cliente');
    });

    // Rutas API para la interfaz de compras
    Route::prefix('api/compras')->name('api.compras.')->group(function () {
        Route::get('buscar-producto', [CompraController::class, 'buscarProducto'])->name('buscar-producto');
        Route::get('buscar-proveedor', [CompraController::class, 'buscarProveedor'])->name('buscar-proveedor');
    });

    // Rutas de Ventas (Vistas)
    Route::get('ventas/resumen', [VentaController::class, 'resumen'])->name('ventas.resumen');
    Route::get('ventas', [VentaController::class, 'index'])->name('ventas.index');
    Route::get('ventas/create', [VentaController::class, 'create'])->name('ventas.create');
    Route::post('ventas', [VentaController::class, 'store'])->name('ventas.store');
    Route::get('ventas/{venta}', [VentaController::class, 'show'])->name('ventas.show');
    Route::get('ventas/{venta}/edit', [VentaController::class, 'edit'])->name('ventas.edit');
    Route::put('ventas/{venta}', [VentaController::class, 'update'])->name('ventas.update');
    Route::patch('ventas/{venta}/anular', [VentaController::class, 'anular'])->name('ventas.anular');

    // Rutas para Devoluciones
    Route::get('devoluciones', [DevolucionController::class, 'index'])->name('devoluciones.index');
    Route::get('ventas/{venta}/devolucion/create', [DevolucionController::class, 'create'])->name('devoluciones.create');
    Route::post('ventas/{venta}/devolucion', [DevolucionController::class, 'store'])->name('devoluciones.store');
    Route::get('devoluciones/{devolucion}', [DevolucionController::class, 'show'])->name('devoluciones.show');

    // Rutas para Reportes
    Route::prefix('reportes')->name('reportes.')->group(function () {
        Route::get('/', [ReporteController::class, 'index'])->name('index');
        Route::get('ventas', [ReporteController::class, 'ventas'])->name('ventas');
        Route::get('compras', [ReporteController::class, 'compras'])->name('compras');
        Route::get('ganancias', [ReporteController::class, 'ganancias'])->name('ganancias');
        Route::get('exportar/ventas', [ReporteController::class, 'exportarVentas'])->name('exportar.ventas');
        Route::get('exportar/compras', [ReporteController::class, 'exportarCompras'])->name('exportar.compras');
        Route::get('exportar/ganancias', [ReporteController::class, 'exportarGanancias'])->name('exportar.ganancias');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');
});