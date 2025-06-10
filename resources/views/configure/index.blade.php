@extends('layout.app')
@section('contenido')
    @push('estilos')
        <style>
            /* Estilos personalizados para complementar Tailwind */
            .modal-fade {
                animation: fadeIn 0.3s ease-in-out;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                    transform: translateY(-20px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .tab-active {
                position: relative;
            }

            .tab-active:after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
                height: 3px;
                background-color: #3b82f6;
                border-radius: 3px 3px 0 0;
            }

            .file-upload {
                position: relative;
                overflow: hidden;
            }

            .file-upload-input {
                position: absolute;
                font-size: 100px;
                opacity: 0;
                right: 0;
                top: 0;
                cursor: pointer;
            }
        </style>
    @endpush


    <div class="w-full px-2.5 py-2.5">
        {{-- <!-- Header -->
        <header class="bg-white shadow-sm">
            <div class="w-full mx-auto px-6 py-4 flex justify-between items-center">
                <h1 class="text-xl font-bold text-gray-900">Panel de Administración</h1>
            </div>
        </header> --}}

        <!-- Main Content -->
        <main class="w-full px-6 md:px-10 py-8">
            <div class="bg-white shadow rounded-lg overflow-hidden">



                <!-- Tabs Navigation -->
                <div class="border-b border-gray-200">
                    <div class="w-full mx-auto px-6 pt-4 flex justify-between items-center">
                        <h1 class="text-xl font-bold text-gray-900">Panel de Administración</h1>
                    </div>

                    <div class="relative">
                        <!-- Línea divisora completa -->
                        <div class="absolute bottom-0 left-0 right-0 border-t border-gray-300"></div>

                        <nav class="flex">
                            <button id="usersTab"
                                class="tab-active py-4 px-6 text-center border-b-2 font-medium text-sm text-blue-600 border-blue-600 relative z-10">
                                <i class="fas fa-users mr-2"></i>Usuarios
                            </button>
                            <button id="rolesTab"
                                class="py-4 px-6 text-center border-b-2 font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300 border-transparent relative z-10">
                                <i class="fas fa-user-tag mr-2"></i>Roles
                            </button>
                            <button id="permissionsTab"
                                class="py-4 px-6 text-center border-b-2 font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300 border-transparent relative z-10">
                                <i class="fas fa-key mr-2"></i>Permisos
                            </button>
                        </nav>
                    </div>
                </div>

                <!-- Tabs Content -->
                <div class="p-6">
                    <!-- Users Tab Content -->
                    <div id="usersContent" class="tab-content active">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-lg font-medium text-gray-900">Gestión de Usuarios</h2>
                            <button id="addUserButton"
                                class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <i class="fas fa-plus mr-2"></i>Nuevo Usuario
                            </button>
                        </div>

                        <!-- Users Table -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            ID
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nombre
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Email
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Documento
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Dirección
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Teléfono
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tipo de Usuario
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <!-- Ejemplo de fila 1 - Empleado -->
                                    @if ($registros->isEmpty())
                                        <tr>
                                            <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                                                No hay usuarios registrados.
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($registros as $reg)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $reg->id }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-10 w-10">
                                                            <img class="h-10 w-10 rounded-full"
                                                                src="https://randomuser.me/api/portraits/men/1.jpg"
                                                                alt="">
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">
                                                                {{ $reg->name }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $reg->email }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @if ($reg->documento == null)
                                                        <div class="text-sm text-gray-400">No registrado</div>
                                                    @else
                                                        <div class="text-sm text-gray-500">{{ $reg->documento }}</div>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @if ($reg->direccion == null)
                                                        <div class="text-sm text-gray-400">No registrado</div>
                                                    @else
                                                        <div class="text-sm text-gray-500">{{ $reg->direccion }}</div>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @if ($reg->telefono == null)
                                                        <div class="text-sm text-gray-400">No registrado</div>
                                                    @else
                                                        <div class="text-sm text-gray-500">{{ $reg->telefono }}</div>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span
                                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                        {{-- @dd($reg->TipoUsuario->name) --}}
                                                        {{ $reg->TipoUsuario->name }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <button class="text-blue-600 hover:text-blue-900 mr-3 edit-user">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="text-red-600 hover:text-red-900">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif

                                    {{-- <!-- Ejemplo de fila 2 - Cliente con campos NULL -->
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">1</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full"
                                                        src="https://randomuser.me/api/portraits/women/1.jpg"
                                                        alt="">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">María González</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">maria@cliente.com</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-400">No registrado</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-400">No registrada</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-400">No registrado</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Cliente
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <button class="text-blue-600 hover:text-blue-900 mr-3 edit-user">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-600 hover:text-red-900">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Ejemplo de fila 3 - Empleado con algunos campos NULL -->
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">1</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full"
                                                        src="https://randomuser.me/api/portraits/men/2.jpg"
                                                        alt="">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">Carlos Rodríguez</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">carlos@empresa.com</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-500">87654321</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-400">No registrada</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-500">555-9876</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                Empleado
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <button class="text-blue-600 hover:text-blue-900 mr-3 edit-user">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-600 hover:text-red-900">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Roles Tab Content -->
                    <div id="rolesContent" class="tab-content hidden">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-lg font-medium text-gray-900">Gestión de Roles</h2>
                            <button
                                class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <i class="fas fa-plus mr-2"></i>Nuevo Rol
                            </button>
                        </div>

                        <!-- Roles Table -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nombre del Rol
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Descripción
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Usuarios
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">Administrador</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">Acceso completo al sistema</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">3</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <button class="text-blue-600 hover:text-blue-900 mr-3"><i
                                                    class="fas fa-edit"></i></button>
                                            <button class="text-red-600 hover:text-red-900"><i
                                                    class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">Editor</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">Puede crear y editar contenido</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">5</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <button class="text-blue-600 hover:text-blue-900 mr-3"><i
                                                    class="fas fa-edit"></i></button>
                                            <button class="text-red-600 hover:text-red-900"><i
                                                    class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">Usuario</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">Acceso básico a la plataforma</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">15</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <button class="text-blue-600 hover:text-blue-900 mr-3"><i
                                                    class="fas fa-edit"></i></button>
                                            <button class="text-red-600 hover:text-red-900"><i
                                                    class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Permissions Tab Content -->
                    <div id="permissionsContent" class="tab-content hidden">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-lg font-medium text-gray-900">Gestión de Permisos</h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-white shadow overflow-hidden rounded-lg">
                                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                                    <h3 class="text-lg font-medium text-gray-900">Administración</h3>
                                </div>
                                <div class="px-4 py-5 sm:p-6">
                                    <div class="space-y-4">
                                        <div class="flex items-center">
                                            <input id="admin-users" name="admin-users" type="checkbox" checked
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                            <label for="admin-users" class="ml-3 block text-sm font-medium text-gray-700">
                                                Gestionar usuarios
                                            </label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="admin-roles" name="admin-roles" type="checkbox" checked
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                            <label for="admin-roles" class="ml-3 block text-sm font-medium text-gray-700">
                                                Gestionar roles
                                            </label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="admin-settings" name="admin-settings" type="checkbox" checked
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                            <label for="admin-settings"
                                                class="ml-3 block text-sm font-medium text-gray-700">
                                                Configuración del sistema
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white shadow overflow-hidden rounded-lg">
                                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                                    <h3 class="text-lg font-medium text-gray-900">Contenido</h3>
                                </div>
                                <div class="px-4 py-5 sm:p-6">
                                    <div class="space-y-4">
                                        <div class="flex items-center">
                                            <input id="content-create" name="content-create" type="checkbox" checked
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                            <label for="content-create"
                                                class="ml-3 block text-sm font-medium text-gray-700">
                                                Crear contenido
                                            </label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="content-edit" name="content-edit" type="checkbox" checked
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                            <label for="content-edit"
                                                class="ml-3 block text-sm font-medium text-gray-700">
                                                Editar contenido
                                            </label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="content-delete" name="content-delete" type="checkbox"
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                            <label for="content-delete"
                                                class="ml-3 block text-sm font-medium text-gray-700">
                                                Eliminar contenido
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white shadow overflow-hidden rounded-lg">
                                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                                    <h3 class="text-lg font-medium text-gray-900">Reportes</h3>
                                </div>
                                <div class="px-4 py-5 sm:p-6">
                                    <div class="space-y-4">
                                        <div class="flex items-center">
                                            <input id="reports-view" name="reports-view" type="checkbox"
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                            <label for="reports-view"
                                                class="ml-3 block text-sm font-medium text-gray-700">
                                                Ver reportes
                                            </label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="reports-export" name="reports-export" type="checkbox"
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                            <label for="reports-export"
                                                class="ml-3 block text-sm font-medium text-gray-700">
                                                Exportar reportes
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Settings Modal -->
    {{-- <div id="settingsModal" class="fixed inset-0 overflow-y-auto hidden z-50" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div id="modalBackdrop" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <!-- Modal content -->
            <div class="modal-fade inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="flex justify-between items-start">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            <i class="fas fa-cog mr-2 text-blue-600"></i>Configuración del Sistema
                        </h3>
                        <button id="closeModalConfig" type="button" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                            <span class="sr-only">Cerrar</span>
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    
                    <!-- Tabs inside modal -->
                    <div class="mt-6 border-b border-gray-200">
                        <nav class="flex -mb-px">
                            <button id="companyTab" class="tab-active py-4 px-6 text-center border-b-2 font-medium text-sm text-blue-600 border-blue-600">
                                <i class="fas fa-building mr-2"></i>Datos de la Empresa
                            </button>
                        </nav>
                    </div>
                    
                    <!-- Company Data Form -->
                    <div id="companyContent" class="tab-content mt-6">
                        <form class="space-y-6">
                            <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                <div class="sm:col-span-6">
                                    <label for="company-logo" class="block text-sm font-medium text-gray-700">Logo de la Empresa</label>
                                    <div class="mt-1 flex items-center">
                                        <div class="file-upload">
                                            <img id="logoPreview" src="https://via.placeholder.com/150" alt="Logo de la empresa" class="h-16 w-16 rounded-md object-cover">
                                            <button type="button" class="ml-4 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                Cambiar
                                            </button>
                                            <input type="file" id="company-logo" class="file-upload-input">
                                        </div>
                                    </div>
                                </div>

                                <div class="sm:col-span-6">
                                    <label for="company-name" class="block text-sm font-medium text-gray-700">Nombre de la Empresa</label>
                                    <div class="mt-1">
                                        <input type="text" name="company-name" id="company-name" value="Mi Empresa S.A." class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                </div>

                                <div class="sm:col-span-4">
                                    <label for="address" class="block text-sm font-medium text-gray-700">Dirección</label>
                                    <div class="mt-1">
                                        <input type="text" name="address" id="address" value="Av. Principal 123" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="phone" class="block text-sm font-medium text-gray-700">Teléfono</label>
                                    <div class="mt-1">
                                        <input type="text" name="phone" id="phone" value="+1 555-1234" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                </div>

                                <div class="sm:col-span-6">
                                    <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                                    <div class="mt-1">
                                        <input type="email" name="email" id="email" value="contacto@miempresa.com" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Guardar Cambios
                    </button>
                    <button id="cancelModal" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Add User Modal -->
    <div id="addUserModal" class="fixed inset-0 overflow-y-auto hidden z-50" aria-labelledby="user-modal-title"
        role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div id="userModalBackdrop" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                aria-hidden="true"></div>

            <!-- Modal content -->
            <div
                class="modal-fade inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="flex justify-between items-start">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="user-modal-title">
                            <i class="fas fa-user-plus mr-2 text-blue-600"></i>Agregar Nuevo Usuario
                        </h3>
                        <button id="closeUserModal" type="button"
                            class="text-gray-400 hover:text-gray-500 focus:outline-none">
                            <span class="sr-only">Cerrar</span>
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <!-- User Form -->
                    <div class="mt-6 space-y-4">
                        <!-- Nombre -->
                        <div>
                            <label for="user-name" class="block text-sm font-medium text-gray-700">Nombre
                                completo*</label>
                            <div class="mt-1">
                                <input type="text" name="user-name" id="user-name" required
                                    class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="user-email" class="block text-sm font-medium text-gray-700">Correo
                                electrónico*</label>
                            <div class="mt-1">
                                <input type="email" name="user-email" id="user-email" required
                                    class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>

                        <!-- Contraseña -->
                        <div>
                            <label for="user-password" class="block text-sm font-medium text-gray-700">Contraseña*</label>
                            <div class="mt-1">
                                <input type="password" name="user-password" id="user-password" required
                                    class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>

                        <!-- Documento -->
                        <div>
                            <label for="user-document" class="block text-sm font-medium text-gray-700">Documento</label>
                            <div class="mt-1">
                                <input type="text" name="user-document" id="user-document"
                                    class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder="Opcional">
                            </div>
                        </div>

                        <!-- Dirección -->
                        <div>
                            <label for="user-address" class="block text-sm font-medium text-gray-700">Dirección</label>
                            <div class="mt-1">
                                <textarea name="user-address" id="user-address" rows="2"
                                    class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder="Opcional"></textarea>
                            </div>
                        </div>

                        <!-- Teléfono -->
                        <div>
                            <label for="user-phone" class="block text-sm font-medium text-gray-700">Teléfono</label>
                            <div class="mt-1">
                                <input type="tel" name="user-phone" id="user-phone"
                                    class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder="Opcional">
                            </div>
                        </div>

                        <!-- Tipo de Usuario -->
                        <div>
                            <label for="user-type" class="block text-sm font-medium text-gray-700">Tipo de
                                Usuario*</label>
                            <div class="mt-1">
                                <select id="user-type" name="user-type" required
                                    class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    <option value="">Seleccione un tipo</option>
                                    <option value="1">Empleado</option>
                                    <option value="2">Cliente</option>
                                </select>
                            </div>
                        </div>

                        <!-- Estado -->
                        <div class="pt-2">
                            <label class="block text-sm font-medium text-gray-700">Estado*</label>
                            <div class="mt-2 space-y-2">
                                <div class="flex items-center">
                                    <input id="active" name="user-status" type="radio" value="1" checked
                                        class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300">
                                    <label for="active" class="ml-3 block text-sm font-medium text-gray-700">
                                        Activo
                                    </label>
                                </div>
                                <div class="flex items-center">
                                    <input id="inactive" name="user-status" type="radio" value="0"
                                        class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300">
                                    <label for="inactive" class="ml-3 block text-sm font-medium text-gray-700">
                                        Inactivo
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" id="saveUserBtn"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Guardar Usuario
                    </button>
                    <button id="cancelUserModal" type="button"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // // Configuración del modal de empresa
        // // const settingsButton = document.getElementById('settingsButton');
        // const settingsModal = document.getElementById('settingsModal');
        // const modalBackdrop = document.getElementById('modalBackdrop');
        // const closeModalConfig = document.getElementById('closeModalConfig');
        // const cancelModal = document.getElementById('cancelModal');

        // settingsButton.addEventListener('click', () => {
        //     settingsModal.classList.remove('hidden');
        // });

        // function closeSettingsModal() {
        //     settingsModal.classList.add('hidden');
        // }

        // closeModalConfig.addEventListener('click', closeSettingsModal);
        // cancelModal.addEventListener('click', closeSettingsModal);
        // modalBackdrop.addEventListener('click', closeSettingsModal);

        // Configuración del modal de usuario
        const addUserButton = document.getElementById('addUserButton');
        const addUserModal = document.getElementById('addUserModal');
        const userModalBackdrop = document.getElementById('userModalBackdrop');
        const closeUserModal = document.getElementById('closeUserModal');
        const cancelUserModal = document.getElementById('cancelUserModal');
        const editUserButtons = document.querySelectorAll('.edit-user');

        addUserButton.addEventListener('click', () => {
            addUserModal.classList.remove('hidden');
        });

        editUserButtons.forEach(button => {
            button.addEventListener('click', () => {
                addUserModal.classList.remove('hidden');
                document.getElementById('user-modal-title').innerHTML =
                    '<i class="fas fa-user-edit mr-2 text-blue-600"></i>Editar Usuario';
                document.getElementById('user-name').value =
                    'John Doe'; // Estos valores deberían venir de los datos del usuario
                document.getElementById('user-email').value = 'john@example.com';
                document.getElementById('user-role').value = 'Administrador';
                document.getElementById('active').checked = true;
            });
        });

        function closeUserModalFunc() {
            addUserModal.classList.add('hidden');
        }

        closeUserModal.addEventListener('click', closeUserModalFunc);
        cancelUserModal.addEventListener('click', closeUserModalFunc);
        userModalBackdrop.addEventListener('click', closeUserModalFunc);

        // Gestión de pestañas principales
        const usersTab = document.getElementById('usersTab');
        const rolesTab = document.getElementById('rolesTab');
        const permissionsTab = document.getElementById('permissionsTab');

        const usersContent = document.getElementById('usersContent');
        const rolesContent = document.getElementById('rolesContent');
        const permissionsContent = document.getElementById('permissionsContent');

        function resetTabs() {
            // Remove active classes from all tabs
            [usersTab, rolesTab, permissionsTab].forEach(tab => {
                tab.classList.remove('tab-active', 'text-blue-600', 'border-blue-600');
                tab.classList.add('text-gray-500', 'border-transparent');
            });

            // Hide all content
            [usersContent, rolesContent, permissionsContent].forEach(content => {
                content.classList.add('hidden');
                content.classList.remove('active');
            });
        }

        usersTab.addEventListener('click', () => {
            resetTabs();
            usersTab.classList.add('tab-active', 'text-blue-600', 'border-blue-600');
            usersTab.classList.remove('text-gray-500');
            usersContent.classList.remove('hidden');
            usersContent.classList.add('active');
        });

        rolesTab.addEventListener('click', () => {
            resetTabs();
            rolesTab.classList.add('tab-active', 'text-blue-600', 'border-blue-600');
            rolesTab.classList.remove('text-gray-500');
            rolesContent.classList.remove('hidden');
            rolesContent.classList.add('active');
        });

        permissionsTab.addEventListener('click', () => {
            resetTabs();
            permissionsTab.classList.add('tab-active', 'text-blue-600', 'border-blue-600');
            permissionsTab.classList.remove('text-gray-500');
            permissionsContent.classList.remove('hidden');
            permissionsContent.classList.add('active');
        });

        // Previsualización de logo
        const logoInput = document.getElementById('company-logo');
        const logoPreview = document.getElementById('logoPreview');

        logoInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    logoPreview.src = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
