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
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

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
        Route::get('categorias', [CategoriaController::class, 'index'])->name('categorias.index')->middleware('permission:categoria-listar');
        Route::get('categorias/create', [CategoriaController::class, 'create'])->name('categorias.create')->middleware('permission:categoria-crear');
        Route::post('categorias', [CategoriaController::class, 'store'])->name('categorias.store')->middleware('permission:categoria-crear');
        Route::get('categorias/{categoria}', [CategoriaController::class, 'show'])->name('categorias.show')->middleware('permission:categoria-listar');
        Route::get('categorias/{categoria}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit')->middleware('permission:categoria-editar');
        Route::put('categorias/{categoria}', [CategoriaController::class, 'update'])->name('categorias.update')->middleware('permission:categoria-editar');
        Route::delete('categorias/{categoria}', [CategoriaController::class, 'destroy'])->name('categorias.destroy')->middleware('permission:categoria-eliminar');
        // Activar categoría (si existe)
        // Route::patch('categorias/{categoria}/activar', [CategoriaController::class, 'activar'])->name('categorias.activar')->middleware('permission:categoria-activar');

        Route::get('productos', [ProductoController::class, 'index'])->name('productos.index')->middleware('permission:producto-listar');
        Route::get('productos/create', [ProductoController::class, 'create'])->name('productos.create')->middleware('permission:producto-crear');
        Route::post('productos', [ProductoController::class, 'store'])->name('productos.store')->middleware('permission:producto-crear');
        Route::get('productos/{producto}', [ProductoController::class, 'show'])->name('productos.show')->middleware('permission:producto-listar');
        Route::get('productos/{producto}/edit', [ProductoController::class, 'edit'])->name('productos.edit')->middleware('permission:producto-editar');
        Route::put('productos/{producto}', [ProductoController::class, 'update'])->name('productos.update')->middleware('permission:producto-editar');
        Route::delete('productos/{producto}', [ProductoController::class, 'destroy'])->name('productos.destroy')->middleware('permission:producto-eliminar');
        // Activar producto (si existe)
        // Route::patch('productos/{producto}/activar', [ProductoController::class, 'activar'])->name('productos.activar')->middleware('permission:producto-activar');

        Route::get('productos-categorias', [ProductoController::class, 'categorias'])->name('productos.categorias')->middleware('permission:categoria-listar');
        Route::get('productos-unidades', [ProductoController::class, 'unidades'])->name('productos.unidades')->middleware('permission:producto-listar');
    });
    
    Route::get('proveedores', [ProvedorController::class, 'index'])->name('proveedores.index')->middleware('permission:proveedor-listar');
    Route::get('proveedores/create', [ProvedorController::class, 'create'])->name('proveedores.create')->middleware('permission:proveedor-crear');
    Route::post('proveedores', [ProvedorController::class, 'store'])->name('proveedores.store')->middleware('permission:proveedor-crear');
    Route::get('proveedores/{proveedor}', [ProvedorController::class, 'show'])->name('proveedores.show')->middleware('permission:proveedor-ver');
    Route::get('proveedores/{proveedor}/edit', [ProvedorController::class, 'edit'])->name('proveedores.edit')->middleware('permission:proveedor-editar');
    Route::put('proveedores/{proveedor}', [ProvedorController::class, 'update'])->name('proveedores.update')->middleware('permission:proveedor-editar');
    Route::delete('proveedores/{proveedor}', [ProvedorController::class, 'destroy'])->name('proveedores.destroy')->middleware('permission:proveedor-eliminar');

    Route::get('compras', [CompraController::class, 'index'])->name('compras.index')->middleware('permission:compra-listar');
    Route::get('compras/create', [CompraController::class, 'create'])->name('compras.create')->middleware('permission:compra-crear');
    Route::post('compras', [CompraController::class, 'store'])->name('compras.store')->middleware('permission:compra-crear');
    Route::get('compras/{compra}', [CompraController::class, 'show'])->name('compras.show')->middleware('permission:compra-ver');
    Route::delete('compras/{compra}', [CompraController::class, 'destroy'])->name('compras.destroy')->middleware('permission:compra-eliminar');
    // Anular compra (si existe)
    // Route::patch('compras/{compra}/anular', [CompraController::class, 'anular'])->name('compras.anular')->middleware('permission:compra-anular');

    Route::get('clientes', [ClienteController::class, 'index'])->name('clientes.index')->middleware('permission:cliente-listar');
    Route::get('clientes/create', [ClienteController::class, 'create'])->name('clientes.create')->middleware('permission:cliente-crear');
    Route::post('clientes', [ClienteController::class, 'store'])->name('clientes.store')->middleware('permission:cliente-crear');
    Route::get('clientes/{cliente}', [ClienteController::class, 'show'])->name('clientes.show')->middleware('permission:cliente-ver');
    Route::get('clientes/{cliente}/edit', [ClienteController::class, 'edit'])->name('clientes.edit')->middleware('permission:cliente-editar');
    Route::put('clientes/{cliente}', [ClienteController::class, 'update'])->name('clientes.update')->middleware('permission:cliente-editar');
    Route::delete('clientes/{cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy')->middleware('permission:cliente-eliminar');

    Route::get('configuracion', [UserController::class, 'index'])->name('configuracion.index')->middleware('permission:usuario-listar');
    Route::get('configuracion/create', [UserController::class, 'create'])->name('configuracion.create')->middleware('permission:usuario-crear');
    Route::post('configuracion', [UserController::class, 'store'])->name('configuracion.store')->middleware('permission:usuario-crear');
    Route::get('configuracion/{user}', [UserController::class, 'show'])->name('configuracion.show')->middleware('permission:usuario-listar');
    Route::get('configuracion/{user}/edit', [UserController::class, 'edit'])->name('configuracion.edit')->middleware('permission:usuario-editar');
    Route::put('configuracion/{user}', [UserController::class, 'update'])->name('configuracion.update')->middleware('permission:usuario-editar');
    Route::delete('configuracion/{user}', [UserController::class, 'destroy'])->name('configuracion.destroy')->middleware('permission:usuario-eliminar');
    // Activar usuario (si existe)
    // Route::patch('configuracion/{user}/activar', [UserController::class, 'activar'])->name('configuracion.activar')->middleware('permission:usuario-activar');

    // Rutas API para la interfaz de ventas
    Route::prefix('api/pos')->name('api.pos.')->group(function () {
        Route::get('buscar-producto', [VentaController::class, 'buscarProducto'])->name('buscar-producto')->middleware('permission:producto-listar');
        Route::get('buscar-productos', [VentaController::class, 'buscarProductos'])->name('buscar-productos')->middleware('permission:producto-listar');
        Route::post('registrar-cliente', [VentaController::class, 'registrarCliente'])->name('registrar-cliente')->middleware('permission:cliente-crear');
        Route::get('buscar-cliente', [VentaController::class, 'buscarCliente'])->name('buscar-cliente')->middleware('permission:cliente-listar');
    });

    // Rutas API para la interfaz de compras
    Route::prefix('api/compras')->name('api.compras.')->group(function () {
        Route::get('buscar-producto', [CompraController::class, 'buscarProducto'])->name('buscar-producto')->middleware('permission:producto-listar');
        Route::get('buscar-proveedor', [CompraController::class, 'buscarProveedor'])->name('buscar-proveedor')->middleware('permission:proveedor-listar');
    });

    // Rutas de Ventas (Vistas)
    Route::get('ventas/resumen', [VentaController::class, 'resumen'])->name('ventas.resumen')->middleware('permission:venta-listar');
    Route::get('ventas', [VentaController::class, 'index'])->name('ventas.index')->middleware('permission:venta-listar');
    Route::get('ventas/create', [VentaController::class, 'create'])->name('ventas.create')->middleware('permission:venta-crear');
    Route::post('ventas', [VentaController::class, 'store'])->name('ventas.store')->middleware('permission:venta-crear');
    Route::get('ventas/{venta}', [VentaController::class, 'show'])->name('ventas.show')->middleware('permission:venta-ver');
    Route::get('ventas/{venta}/edit', [VentaController::class, 'edit'])->name('ventas.edit')->middleware('permission:venta-editar');
    Route::put('ventas/{venta}', [VentaController::class, 'update'])->name('ventas.update')->middleware('permission:venta-editar');
    Route::patch('ventas/{venta}/anular', [VentaController::class, 'anular'])->name('ventas.anular')->middleware('permission:venta-anular');
    // Activar venta (si existe)
    // Route::patch('ventas/{venta}/activar', [VentaController::class, 'activar'])->name('ventas.activar')->middleware('permission:venta-activar');
    Route::delete('ventas/{venta}', [VentaController::class, 'destroy'])->name('ventas.destroy')->middleware('permission:venta-eliminar');

    // Rutas para Devoluciones
    Route::get('devoluciones', [DevolucionController::class, 'index'])->name('devoluciones.index')->middleware('permission:devolucion-listar');
    Route::get('ventas/{venta}/devolucion/create', [DevolucionController::class, 'create'])->name('devoluciones.create')->middleware('permission:devolucion-crear');
    Route::post('ventas/{venta}/devolucion', [DevolucionController::class, 'store'])->name('devoluciones.store')->middleware('permission:devolucion-crear');
    Route::get('devoluciones/{devolucion}', [DevolucionController::class, 'show'])->name('devoluciones.show')->middleware('permission:devolucion-ver');

    // Rutas para Reportes
    Route::prefix('reportes')->name('reportes.')->group(function () {
        Route::get('/', [ReporteController::class, 'index'])->name('index')->middleware('permission:reporte-ver');
        Route::get('ventas', [ReporteController::class, 'ventas'])->name('ventas')->middleware('permission:reporte-ver');
        Route::get('compras', [ReporteController::class, 'compras'])->name('compras')->middleware('permission:reporte-ver');
        Route::get('ganancias', [ReporteController::class, 'ganancias'])->name('ganancias')->middleware('permission:reporte-ver');
        Route::get('exportar/ventas', [ReporteController::class, 'exportarVentas'])->name('exportar.ventas')->middleware('permission:reporte-exportar');
        Route::get('exportar/compras', [ReporteController::class, 'exportarCompras'])->name('exportar.compras')->middleware('permission:reporte-exportar');
        Route::get('exportar/ganancias', [ReporteController::class, 'exportarGanancias'])->name('exportar.ganancias')->middleware('permission:reporte-exportar');
        Route::get('inventario', [ReporteController::class, 'inventario'])->name('inventario')->middleware('permission:reporte-ver');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');
});