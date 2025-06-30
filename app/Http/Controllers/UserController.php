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
        // Obtener el ID del tipo de usuario "Empleado"
        $tipoEmpleadoId = TipoUsuario::where('name', 'Empleado')->value('id');

        $texto = $request->get('texto');
        
        // Query base para usuarios, filtrando solo por empleados
        $query = User::where('TipoUsuario_id', $tipoEmpleadoId);

        // $permisos = Permission::all();


        if ($texto) {
            $query->where('name', 'LIKE', '%' . $texto . '%');
        }

        $registros = $query->paginate(10);
        $usuarios = $query->get(); // Para consistencia si alguna parte lo usa

        // Obtener roles y permisos para los modales
        $roles = Role::withCount(['users', 'permissions'])->get();
        foreach ($roles as $role) {
            $role->users_count = $role->users()->where('TipoUsuario_id', $tipoEmpleadoId)->count();
            $role->permissions_count = $role->permissions()->count();
        }
        
        $permisos = Permission::all();

        $tipo_usuario = TipoUsuario::where('name', 'Empleado')->get(); // Solo tipo empleado para el formulario

        return view('configure.index', compact(['roles', 'permisos', 'texto', 'registros', 'usuarios', 'tipo_usuario']));
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
            'TipoUsuario_id' => 1, // Siempre asignar tipo "Empleado"
        ]);
        $user->syncRoles($request->roles);
        $user->syncPermissions($request->permissions);

        return redirect()->route('configuracion.index')->with('success', 'Empleado creado correctamente');
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
        $user->load(['roles', 'permissions']);

        // Permisos efectivos (directos y por rol)
        $allPermissions = $user->getAllPermissions()->pluck('name')->toArray();

        return response()->json([
            'user' => $user,
            'roles' => $roles,
            'permisos' => $permisos,
            'tipo_usuario' => $tipo_usuario,
            'all_permissions' => $allPermissions
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
