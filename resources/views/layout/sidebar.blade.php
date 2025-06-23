<!-- Sidebar Navigation -->
<aside class="w-full lg:w-72 bg-gradient-to-b from-sky-900 to-blue-900 shadow-2xl lg:h-screen lg:sticky lg:top-0 transition-all duration-300 transform hover:shadow-xl lg:flex lg:flex-col">
    <div class="p-6 border-b border-blue-700">
        <h1 class="text-2xl font-bold text-white flex items-center">
            <i class="fas fa-store mr-3 text-blue-300"></i>
            <a href="{{route('dashboard')}}" class="hover:text-blue-200 transition-colors">Sistema POS</a>
        </h1>
    </div>

    <!-- User Info -->
    <div class="p-6 text-center border-b border-blue-700">
        <div class="h-24 w-24 mx-auto rounded-full bg-blue-800 flex items-center justify-center mb-4 ring-4 ring-blue-500/30 hover:ring-blue-400/50 transition-all">
            <i class="fas fa-user-circle text-white text-4xl"></i>
        </div>
        <h2 class="text-xl font-semibold text-white mb-1">Hola, <span class="text-blue-200">{{ Auth::user()->name }}</span></h2>
        <div class="text-xs text-blue-300 bg-blue-800/50 rounded-full px-3 py-1 inline-block">
            <i class="fas fa-user-shield mr-1"></i>
            {{ Auth::user()->roles->pluck('name')->implode(', ') }}
        </div>
        <p class="text-xs text-blue-400 mt-3">
            <i class="far fa-clock mr-1"></i>
            Último acceso: {{ now()->format('d M Y') }}
        </p>
    </div>

    <!-- Menu Links -->
    <nav class="p-4 overflow-y-auto lg:flex-1 scrollbar-thin scrollbar-thumb-blue-600 scrollbar-track-blue-900/0">
        <ul class="space-y-2">
            @php
                $menuItems = [
                    [
                        'title' => "Dashboard",
                        'icon' => "fa-tachometer-alt",
                        'color' => "text-blue-300",
                        'hover' => "hover:bg-blue-800/50",
                        'roles' => ['Administrador', 'manager', 'sales'],
                        'url' => route('dashboard'),
                        'active' => request()->routeIs('dashboard')
                    ],
                    [
                        'title' => "Ventas",
                        'icon' => "fa-cash-register",
                        'color' => "text-emerald-300",
                        'hover' => "hover:bg-emerald-800/30",
                        'roles' => ['Administrador', 'manager', 'sales'],
                        'url' => route('ventas.index'),
                        'active' => request()->routeIs('ventas.*')
                    ],
                    [
                        'title' => "Compras",
                        'icon' => "fa-shopping-cart",
                        'color' => "text-purple-300",
                        'hover' => "hover:bg-purple-800/30",
                        'roles' => ['Administrador', 'manager'],
                        'url' => route('compras.index'),
                        'active' => request()->routeIs('compras.*')
                    ],
                    [
                        'title' => "Inventario",
                        'icon' => "fa-boxes",
                        'color' => "text-cyan-300",
                        'hover' => "hover:bg-cyan-800/30",
                        'roles' => ['Administrador', 'manager'],
                        'url' => route('productos.index'),
                        'active' => request()->routeIs('productos.*')
                    ],
                    [
                        'title' => "Clientes",
                        'icon' => "fa-users",
                        'color' => "text-indigo-300",
                        'hover' => "hover:bg-indigo-800/30",
                        'roles' => ['Administrador', 'manager', 'sales'],
                        'url' => route('clientes.index'),
                        'active' => request()->routeIs('clientes.*')
                    ],
                    [
                        'title' => "Proveedores",
                        'icon' => "fa-truck",
                        'color' => "text-amber-300",
                        'hover' => "hover:bg-amber-800/30",
                        'roles' => ['Administrador', 'manager'],
                        'url' => route('proveedores.index'),
                        'active' => request()->routeIs('proveedores.*')
                    ],
                    [
                        'title' => "Reportes",
                        'icon' => "fa-chart-line",
                        'color' => "text-blue-200",
                        'hover' => "hover:bg-blue-800/40",
                        'roles' => ['Administrador', 'manager'],
                        'url' => route('reportes.index'),
                        'active' => request()->routeIs('reportes.*')
                    ],
                    [
                        'title' => "Configuración",
                        'icon' => "fa-cog",
                        'color' => "text-gray-300",
                        'hover' => "hover:bg-gray-800/30",
                        'roles' => ['Administrador'],
                        'url' => route('configuracion.index'),
                        'active' => request()->routeIs('configuracion.*')
                    ]
                ];
                
                $filteredItems = array_filter($menuItems, function($item) {
                    return in_array(Auth::user()->roles->pluck('name')->first(), $item['roles']);
                });
            @endphp

            @foreach($filteredItems as $item)
                <li>
                    <a href="{{ $item['url'] }}" 
                       class="flex items-center px-4 py-3 rounded-lg transition-all duration-300 {{ $item['hover'] }} {{ $item['active'] ? 'bg-blue-800/60 border-l-4 border-blue-400' : '' }}">
                        <i class="fas {{ $item['icon'] }} {{ $item['color'] }} text-lg w-8"></i>
                        <span class="text-white font-medium">{{ $item['title'] }}</span>
                        @if($item['active'])
                            <span class="ml-auto h-2 w-2 rounded-full bg-blue-400 animate-pulse"></span>
                        @endif
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>

    <!-- Logout Button -->
    <div class="p-4 border-t border-blue-700">
        <a href="#" id="logoutBtn" 
           class="flex items-center px-4 py-3 rounded-lg text-red-300 hover:bg-red-900/30 hover:text-red-200 transition-all group">
            <i class="fas fa-sign-out-alt mr-3 transform group-hover:translate-x-1 transition-transform"></i>
            <span class="font-medium">Cerrar sesión</span>
        </a>
    </div>
</aside>

<!-- Logout Modal -->
<div id="logoutModal" class="fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center z-50 hidden transition-opacity duration-300">
    <div class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-xl p-6 max-w-sm w-full border-t-4 border-red-500 shadow-2xl transform transition-all duration-300 scale-95 opacity-0" id="modalContent">
        <div class="flex justify-between items-center mb-4">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle text-red-400 mr-2 text-xl"></i>
                <h3 class="text-xl font-semibold text-white">Cerrar sesión</h3>
            </div>
            <button id="closeModal" class="cursor-pointer  text-slate-400 hover:text-white transition-colors">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <p class="mb-6 text-slate-300">¿Estás seguro que deseas salir del sistema?</p>
        <div class="flex justify-end space-x-3">
            <button id="cancelLogout" class="cursor-pointer px-4 py-2 rounded-lg border border-slate-600 text-slate-300 hover:bg-slate-700/50 hover:text-white transition-colors">
                Cancelar
            </button>
            <button id="confirmLogout" class="cursor-pointer px-4 py-2 rounded-lg bg-gradient-to-r from-red-500 to-red-600 text-white hover:from-red-600 hover:to-red-700 shadow-md transition-all">
                <i class="fas fa-sign-out-alt mr-2"></i> Salir
            </button>
        </div>
    </div>
</div>

<!-- Logout Form (Hidden) -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const logoutBtn = document.getElementById('logoutBtn');
        const logoutModal = document.getElementById('logoutModal');
        const modalContent = document.getElementById('modalContent');
        const closeModal = document.getElementById('closeModal');
        const cancelLogout = document.getElementById('cancelLogout');
        const confirmLogout = document.getElementById('confirmLogout');

        function showModal() {
            logoutModal.classList.remove('hidden');
            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function hideModal() {
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                logoutModal.classList.add('hidden');
            }, 300);
        }

        logoutBtn.addEventListener('click', (e) => {
            e.preventDefault();
            showModal();
        });

        closeModal.addEventListener('click', hideModal);
        cancelLogout.addEventListener('click', hideModal);

        confirmLogout.addEventListener('click', (e) => {
            e.preventDefault();
            document.getElementById('logout-form').submit();
        });

        // Close modal when clicking outside
        logoutModal.addEventListener('click', (e) => {
            if (e.target === logoutModal) {
                hideModal();
            }
        });
    });
</script>