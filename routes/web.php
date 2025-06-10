<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
// use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
// use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
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
        
    });
    
    Route::resource('configuracion', UserController::class);



    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');
});