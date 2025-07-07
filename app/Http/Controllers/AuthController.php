<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest as AuthLoginRequest;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Mostrar el formulario de login
    public function showLoginForm()
    {
        return view('login.index');
    }

    // Procesar el intento de login
    public function login(AuthLoginRequest $request){
        try {
            // Usar el método authenticate que ya maneja "remember"
            $request->authenticate();
            
            // Regenerar la sesión para evitar ataques de fijación de sesión
            $request->session()->regenerate();

            // Redirección personalizada según el rol
            $user = Auth::user();
            if ($user->hasRole('Vendedor')) {
                return redirect()->route('ventas.index');
            }
            // Redirigir al usuario a la ruta deseada (dashboard en este ejemplo)
            return redirect()->intended(route('dashboard'));
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->onlyInput('email');
        }
    }
    
    // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
