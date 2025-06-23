<?php

namespace App\Http\Controllers;

use App\Models\TipoUsuario;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tipoClienteId = TipoUsuario::where('name', 'Cliente')->value('id');
        $texto = $request->get('texto');

        $query = User::where('TipoUsuario_id', $tipoClienteId);

        if ($texto) {
            $query->where(function ($q) use ($texto) {
                $q->where('name', 'LIKE', '%' . $texto . '%')
                    ->orWhere('email', 'LIKE', '%' . $texto . '%')
                    ->orWhere('documento', 'LIKE', '%' . $texto . '%');
            });
        }

        $registros = $query->orderBy('name')->paginate(10);

        return view('cliente.index', compact('registros', 'texto'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'documento' => 'nullable|string|max:20|unique:users,documento',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
        ]);

        $tipoClienteId = TipoUsuario::where('name', 'Cliente')->value('id');

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('password'), // Contraseña por defecto para clientes
            'documento' => $request->documento,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'TipoUsuario_id' => $tipoClienteId,
        ]);

        return redirect()->route('clientes.index')->with('mensaje', 'Cliente creado correctamente.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $cliente)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $cliente->id,
            'documento' => 'nullable|string|max:20|unique:users,documento,' . $cliente->id,
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
        ]);

        $cliente->update($request->all());

        return redirect()->route('clientes.index')->with('mensaje', 'Cliente actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $cliente)
    {
        // Opcional: Verificar si el cliente tiene ventas asociadas antes de eliminar
        if ($cliente->ventas()->exists()) {
            return redirect()->back()->with('error', 'No se puede eliminar un cliente con ventas asociadas.');
        }

        $cliente->delete();
        return redirect()->route('clientes.index')->with('mensaje', 'Cliente eliminado correctamente.');
    }
}
