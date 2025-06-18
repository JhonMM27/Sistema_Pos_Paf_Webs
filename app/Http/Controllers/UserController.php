<?php

namespace App\Http\Controllers;

use App\Models\TipoUsuario;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $texto = $request->get('texto');
        // $user = User::with(['roles', 'permissions'])->findOrFail($id);
        $usuarios = User::all();
        
        // Obtener roles con conteo de usuarios y permisos
        $roles = Role::withCount(['users', 'permissions'])->get();
        
        // Calcular usuarios por rol manualmente para mayor precisión
        foreach ($roles as $role) {
            $role->users_count = $role->users()->count();
            $role->permissions_count = $role->permissions()->count();
        }
        
        $permisos = Permission::all();
        $tipo_usuario = TipoUsuario::select('id','name')->get();

        $registros = User::where('name', 'LIKE', '%' . $texto . '%')->paginate(10);
        return view('configure.index', compact(['roles', 'permisos', 'texto', 'registros', 'usuarios','tipo_usuario']));

        // return view('configure.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'email|unique:users,email',
            'password' => 'min:6'
            // 'roles' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'documento' => $request->documento,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'TipoUsuario_id' => $request->TipoUsuario_id ?: 2, // Default to 2 if not provided
        ]);
        $user->syncRoles($request->roles);
        $user->syncPermissions($request->permissions);

        return redirect()->route('configuracion.index')->with('success', 'Usuario creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $roles = Role::all();
        $permisos = Permission::all();
        $tipo_usuario = TipoUsuario::select('id','name')->get();
        $user = User::findOrFail($id);
        
        // Cargar explícitamente las relaciones
        $user->load(['roles', 'permissions']);
        
        // Log para depuración
        Log::info('Datos del usuario para edición:', [
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_roles_count' => $user->roles->count(),
            'user_permissions_count' => $user->permissions->count(),
            'total_roles' => $roles->count(),
            'total_permisos' => $permisos->count(),
            'tipo_usuario' => $user->TipoUsuario_id
        ]);
        
        return response()->json([
            'user' => $user,
            'roles' => $roles,
            'permisos' => $permisos,
            'tipo_usuario' => $tipo_usuario
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'email' => 'email|unique:users,email,' . $id,
            'password' => 'nullable|min:6'
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'documento' => $request->documento,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'TipoUsuario_id' => $request->TipoUsuario_id ?: 2,
        ];

        // Solo actualizar contraseña si se proporciona una nueva
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);
        
        // Sincronizar roles y permisos
        if ($request->has('roles')) {
            $user->syncRoles($request->roles);
        }
        if ($request->has('permissions')) {
            $user->syncPermissions($request->permissions);
        }

        return response()->json([
            'success' => true,
            'message' => 'Usuario actualizado correctamente'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // No permitir eliminar el usuario actual
            $user = User::findOrFail($id);

            if ($user->id === Auth::id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No puedes eliminar tu propia cuenta'
                ], 400);
            }

            $user->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Usuario eliminado correctamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el usuario: ' . $e->getMessage()
            ], 500);
        }
    }
}
