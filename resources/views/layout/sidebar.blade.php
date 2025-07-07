<style>
    /* @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap'); */

    body {
        font-family: 'Poppins', sans-serif;
        transition: background-color 0.3s;
        overflow-x: hidden;
    }

    #custom-scrollbar {
        scrollbar-width: thin;
        scrollbar-color: #2563eb transparent;
    }

    #custom-scrollbar::-webkit-scrollbar {
        width: 8px;
    }

    #custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }

    #custom-scrollbar::-webkit-scrollbar-thumb {
        background-color: #2563eb;
        border-radius: 8px;
    }

    /* Sidebar responsivo */
    @media (max-width: 1024px) {
        .sidebar-mobile {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 280px;
            max-width: 85vw;
            z-index: 50;
            overflow-y: auto;
            display: block;
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
        }

        .sidebar-mobile.open {
            transform: translateX(0);
            box-shadow: 0 0 0 9999px rgba(0, 0, 0, 0.5);
        }
    }

    @media (min-width: 1025px) {
        .sidebar-header-mobile {
            display: none;
        }

        .close-sidebar-btn {
            display: none;
        }
    }

    @media (max-width: 640px) {
        .sidebar-mobile {
            width: 100vw;
            max-width: 100vw;
        }

        .user-avatar {
            height: 3rem;
            width: 3rem;
        }

        .user-name {
            font-size: 1rem;
        }

        .menu-item {
            padding: 0.75rem 1rem;
        }

        .menu-icon {
            font-size: 1rem;
            width: 1.5rem;
        }
    }

    /* Overlay para sidebar móvil */
    .sidebar-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 40;
    }

    @media (max-width: 1024px) {
        .sidebar-overlay.active {
            display: block;
        }
    }

    /* Fondo degradado uniforme para todo el sidebar */
    .sidebar-bg {
        background: linear-gradient(180deg, #155e75 0%, #1e293b 100%);
    }

    .sidebar-header-mobile {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        padding: 1rem 1.25rem 0.5rem 1.25rem;
        border-bottom: 1px solid rgba(59, 130, 246, 0.08);
        min-height: 56px;
    }

    .close-sidebar-btn {
        display: block;
        background: none;
        border: none;
        color: #fff;
        font-size: 1.5rem;
        padding: 0.25rem 0.5rem;
        border-radius: 0.375rem;
        transition: background-color 0.2s;
        margin-left: auto;
    }

    .close-sidebar-btn:hover {
        background-color: rgba(59, 130, 246, 0.15);
    }

    /* Bloque usuario */
    .sidebar-user {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 1.5rem 1rem 1rem 1rem;
        border-bottom: 1px solid rgba(59, 130, 246, 0.08);
    }

    .sidebar-user-avatar {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background: #0ea5e9;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 0.75rem;
        box-shadow: 0 2px 8px rgba(14, 165, 233, 0.08);
    }

    .sidebar-user-avatar i {
        font-size: 2rem;
        color: #fff;
    }

    .sidebar-user-name {
        font-weight: 700;
        color: #fff;
        font-size: 1.1rem;
        margin-bottom: 0.25rem;
        text-align: center;
    }

    .sidebar-user-role {
        font-size: 0.85rem;
        color: #bae6fd;
        background: #0369a1;
        border-radius: 9999px;
        padding: 0.15rem 0.75rem;
        margin-bottom: 0.25rem;
        font-weight: 500;
    }

    .sidebar-user-last {
        font-size: 0.8rem;
        color: #94a3b8;
        margin-top: 0.25rem;
    }

    /* Menú */
    .sidebar-menu {
        padding: 1.2rem 0.5rem 1.2rem 0.5rem;
    }

    .sidebar-menu ul {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .sidebar-menu a {
        display: flex;
        align-items: center;
        gap: 0.9rem;
        padding: 0.7rem 1.2rem;
        border-radius: 0.75rem;
        font-size: 1rem;
        font-weight: 500;
        color: #e0e7ef;
        transition: background 0.18s, color 0.18s, box-shadow 0.18s;
        position: relative;
    }

    .sidebar-menu a:hover {
        background: rgba(59, 130, 246, 0.10);
        color: #fff;
    }

    .sidebar-menu .active {
        background: #1e40af;
        color: #fff;
        border-left: 4px solid #38bdf8;
        box-shadow: 0 2px 8px rgba(59, 130, 246, 0.08);
    }

    .sidebar-menu i.menu-icon {
        font-size: 1.25rem;
        min-width: 1.5rem;
        text-align: center;
    }

    .sidebar-logout {
        padding: 1.2rem 1rem 1.2rem 1rem;
        border-top: 1px solid rgba(59, 130, 246, 0.08);
    }

    .sidebar-logout a {
        display: flex;
        align-items: center;
        gap: 0.7rem;
        color: #f87171;
        font-weight: 600;
        font-size: 1rem;
        border-radius: 0.75rem;
        padding: 0.7rem 1.2rem;
        transition: background 0.18s, color 0.18s;
    }

    .sidebar-logout a:hover {
        background: rgba(239, 68, 68, 0.08);
        color: #dc2626;
    }
</style>

<!-- Sidebar Navigation -->

<aside
    class="w-full lg:w-72 bg-gradient-to-b from-sky-900 to-blue-900 shadow-2xl lg:h-screen lg:sticky lg:top-0 transition-all duration-300 transform hover:shadow-xl lg:flex lg:flex-col">


    {{-- <aside class="sidebar-bg h-screen flex flex-col fixed inset-y-0 left-0 w-72 z-50 transform transition-transform duration-300 -translate-x-full lg:static lg:inset-auto lg:w-72 lg:z-auto lg:translate-x-0"> --}}
    <!-- Botón cerrar solo en móvil -->
    <div class="sidebar-header-mobile lg:hidden" id="sidebar-header-mobile">
        <button class="close-sidebar-btn" id="closeSidebarBtn">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <script>
        function toggleSidebarHeaderMobile() {
            const el = document.getElementById('sidebar-header-mobile');
            if (window.innerWidth < 1024) {
                el.style.display = 'flex'; // o 'block' según tu diseño
            } else {
                el.style.display = 'none';
            }
        }

        // Ejecutar al cargar
        toggleSidebarHeaderMobile();

        // Ejecutar cada vez que se redimensiona
        window.addEventListener('resize', toggleSidebarHeaderMobile);
    </script>

    <!-- Desktop Header -->
    <div class="p-6 border-b border-blue-700 lg:block hidden">
        <h1 class="text-2xl font-bold text-white flex items-center">
            <i class="fas fa-store mr-3 text-blue-300"></i>
            <a href="{{ route('dashboard') }}" class="hover:text-blue-200 transition-colors">Sistema POS</a>
        </h1>
    </div>

    <!-- User Info -->
    <div class="sidebar-user">
        <div class="sidebar-user-avatar">
            <i class="fas fa-user-circle"></i>
        </div>
        <div class="sidebar-user-name">Hola, {{ Auth::user()->name }}</div>
        <div class="sidebar-user-role">
            <i class="fas fa-user-shield mr-1"></i>
            {{ Auth::user()->roles->pluck('name')->implode(', ') }}
        </div>
        <div class="sidebar-user-last">
            <i class="far fa-clock mr-1"></i>
            Último acceso: {{ now()->format('d M Y') }}
        </div>
    </div>

    <!-- Menu Links -->
    <nav class="sidebar-menu flex-1 overflow-y-auto min-h-0" id="custom-scrollbar">
        <ul>
            @php
                $menuItems = [
                    [
                        'title' => 'Dashboard',
                        'icon' => 'fa-tachometer-alt',
                        'color' => 'text-blue-300',
                        'hover' => 'hover:bg-blue-800/50',
                        'roles' => ['Administrador', 'manager', 'Vendedor'],
                        'url' => route('dashboard'),
                        'active' => request()->routeIs('dashboard'),
                    ],
                    [
                        'title' => 'Ventas',
                        'icon' => 'fa-cash-register',
                        'color' => 'text-emerald-300',
                        'hover' => 'hover:bg-emerald-800/30',
                        'roles' => ['Administrador', 'manager', 'Vendedor'],
                        'url' => route('ventas.index'),
                        'active' => request()->routeIs('ventas.*'),
                    ],
                    [
                        'title' => 'Compras',
                        'icon' => 'fa-shopping-cart',
                        'color' => 'text-purple-300',
                        'hover' => 'hover:bg-purple-800/30',
                        'roles' => ['Administrador', 'manager'],
                        'url' => route('compras.index'),
                        'active' => request()->routeIs('compras.*'),
                    ],
                    [
                        'title' => 'Inventario',
                        'icon' => 'fa-boxes',
                        'color' => 'text-cyan-300',
                        'hover' => 'hover:bg-cyan-800/30',
                        'roles' => ['Administrador', 'manager'],
                        'url' => route('productos.index'),
                        'active' => request()->routeIs('productos.*'),
                    ],
                    [
                        'title' => 'Clientes',
                        'icon' => 'fa-users',
                        'color' => 'text-indigo-300',
                        'hover' => 'hover:bg-indigo-800/30',
                        'roles' => ['Administrador', 'manager', 'Vendedor'],
                        'url' => route('clientes.index'),
                        'active' => request()->routeIs('clientes.*'),
                    ],
                    [
                        'title' => 'Proveedores',
                        'icon' => 'fa-truck',
                        'color' => 'text-amber-300',
                        'hover' => 'hover:bg-amber-800/30',
                        'roles' => ['Administrador', 'manager'],
                        'url' => route('proveedores.index'),
                        'active' => request()->routeIs('proveedores.*'),
                    ],
                    [
                        'title' => 'Reportes',
                        'icon' => 'fa-chart-line',
                        'color' => 'text-blue-200',
                        'hover' => 'hover:bg-blue-800/40',
                        'roles' => ['Administrador', 'manager'],
                        'url' => route('reportes.index'),
                        'active' => request()->routeIs('reportes.*'),
                    ],
                    [
                        'title' => 'Configuración',
                        'icon' => 'fa-cog',
                        'color' => 'text-gray-300',
                        'hover' => 'hover:bg-gray-800/30',
                        'roles' => ['Administrador'],
                        'url' => route('configuracion.index'),
                        'active' => request()->routeIs('configuracion.*'),
                    ],
                ];

                $filteredItems = array_filter($menuItems, function ($item) {
                    return in_array(Auth::user()->roles->pluck('name')->first(), $item['roles']);
                });
            @endphp

            @foreach ($filteredItems as $item)
                <li>
                    <a href="{{ $item['url'] }}" class="menu-item {{ $item['active'] ? 'active' : '' }}"
                        onclick="closeMobileSidebar()">
                        <i class="fas {{ $item['icon'] }} menu-icon"></i>
                        <span>{{ $item['title'] }}</span>
                        @if ($item['active'])
                            <span class="ml-auto h-2 w-2 rounded-full bg-blue-400 animate-pulse"></span>
                        @endif
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>

    <!-- Logout Button -->
    <div class="sidebar-logout">
        <a href="#" id="logoutBtn">
            <i class="fas fa-sign-out-alt"></i>
            Cerrar sesión
        </a>
    </div>
</aside>

<!-- Logout Modal -->
<div id="logoutModal"
    class="fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center z-50 hidden transition-opacity duration-300">
    <div class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-xl p-6 max-w-sm w-full border-t-4 border-red-500 shadow-2xl transform transition-all duration-300 scale-95 opacity-0"
        id="modalContent">
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
            <button id="cancelLogout"
                class="cursor-pointer px-4 py-2 rounded-lg border border-slate-600 text-slate-300 hover:bg-slate-700/50 hover:text-white transition-colors">
                Cancelar
            </button>
            <button id="confirmLogout"
                class="cursor-pointer px-4 py-2 rounded-lg bg-gradient-to-r from-red-500 to-red-600 text-white hover:from-red-600 hover:to-red-700 shadow-md transition-all">
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
        const closeSidebarBtn = document.getElementById('closeSidebarBtn');
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const sidebarContainer = document.getElementById('sidebarContainer');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        // Close mobile sidebar function
        window.closeMobileSidebar = function() {
            if (sidebarContainer && sidebarOverlay) {
                sidebarContainer.classList.remove('open');
                sidebarOverlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        };

        // Close sidebar button event
        if (closeSidebarBtn) {
            closeSidebarBtn.addEventListener('click', closeMobileSidebar);
        }

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

        // Close sidebar when clicking on menu items (mobile)
        const menuItems = document.querySelectorAll('.menu-item');
        menuItems.forEach(item => {
            item.addEventListener('click', function() {
                if (window.innerWidth < 1024) {
                    closeMobileSidebar();
                }
            });
        });

        // Abrir sidebar móvil
        if (mobileMenuBtn && sidebarContainer && sidebarOverlay) {
            mobileMenuBtn.addEventListener('click', function() {
                sidebarContainer.classList.toggle('open');
                sidebarOverlay.classList.toggle('active');
                document.body.style.overflow = sidebarContainer.classList.contains('open') ? 'hidden' :
                    '';
            });
            // Cerrar sidebar al hacer click en el overlay
            sidebarOverlay.addEventListener('click', function() {
                sidebarContainer.classList.remove('open');
                sidebarOverlay.classList.remove('active');
                document.body.style.overflow = '';
            });
            // Cerrar sidebar con el botón de cerrar
            if (closeSidebarBtn) {
                closeSidebarBtn.addEventListener('click', function() {
                    sidebarContainer.classList.remove('open');
                    sidebarOverlay.classList.remove('active');
                    document.body.style.overflow = '';
                });
            }
            // Cerrar sidebar si la pantalla se agranda
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 1024) {
                    sidebarContainer.classList.remove('open');
                    sidebarOverlay.classList.remove('active');
                    document.body.style.overflow = '';
                }
            });
        }
    });
</script>
