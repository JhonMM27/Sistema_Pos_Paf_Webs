<!-- Sidebar Navigation -->
<aside class="w-full lg:w-64 bg-sky-50 shadow-lg lg:h-screen lg:sticky lg:top-0">
    <div class="p-4 border-b border-sky-200">
        <h1 class="text-xl font-bold text-sky-700 flex items-center">
            <i class="fas fa-store mr-2"></i>
            <a href="{{route('dashboard')}}">Sistema POS</a>
        </h1>
    </div>

    <!-- User Info -->
    <div class="p-4 text-center">
        <div class="h-20 w-20 mx-auto rounded-full bg-sky-100 flex items-center justify-center mb-2">
            <i class="fas fa-user text-sky-600 text-3xl"></i>
        </div>
        <h2 class="greeting-text text-lg font-semibold text-sky-800">Bienvenido(a), <span id="username"></span></h2>
        <p class="text-xs text-gray-500">Último acceso: Hoy</p>
    </div>

    <!-- Menu Links -->
    <nav class="p-4">
        <ul></ul>
    </nav>

    <!-- Logout Button -->
    <div class="mt-8 border-t border-sky-200 pt-4">
        <a href="#" id="logoutBtn" class="block px-4 py-2 rounded-md hover:bg-sky-100 text-sky-700 font-medium transition">
            <i class="fas fa-sign-out-alt mr-3"></i> Cerrar sesión
        </a>
    </div>
</aside>

<!-- Logout Modal -->
<div id="logoutModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg p-6 max-w-sm w-full border-t-4 border-sky-500">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-sky-700">Cerrar sesión</h3>
            <button id="closeModal" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <p class="mb-6 text-gray-600">¿Estás seguro que deseas cerrar tu sesión?</p>
        <div class="flex justify-end space-x-3">
            <button id="cancelLogout" class="px-4 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-100">Cancelar</button>
            <button id="confirmLogout" class="px-4 py-2 rounded-md bg-sky-600 text-white hover:bg-sky-700">Cerrar sesión</button>
        </div>
    </div>
</div>

<!-- Logout Form (Hidden) -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<script>
    const user = {
        name: "{{ Auth::user()->name }}",
        role: "{{ Auth::user()->roles->pluck('name')->implode(', ') }}",
        lastAccess: new Date().toLocaleDateString()
    };

    const menuItems = [
        { title: "Ventas", icon: "fa-cash-register", color: "bg-emerald-100", textColor: "text-emerald-700", roles: ['Administrador', 'manager', 'sales'], url: "#" },
        { title: "Inventario", icon: "fa-boxes", color: "bg-cyan-100", textColor: "text-cyan-700", roles: ['Administrador', 'manager'], url: "{{route('categorias.store')}}" },
        { title: "Clientes", icon: "fa-users", color: "bg-indigo-100", textColor: "text-indigo-700", roles: ['Administrador', 'manager', 'sales'], url: "#" },
        { title: "Proveedores", icon: "fa-truck", color: "bg-orange-100", textColor: "text-orange-700", roles: ['Administrador', 'manager'], url: "#" },
        { title: "Reportes", icon: "fa-chart-bar", color: "bg-blue-100", textColor: "text-blue-700", roles: ['Administrador', 'manager'], url: "#" },
        { title: "Configuración", icon: "fa-cog", color: "bg-gray-100", textColor: "text-gray-700", roles: ['Administrador'], url: "#" }
    ];

    const usernameElements = document.querySelectorAll('#username');
    const logoutBtn = document.getElementById('logoutBtn');
    const logoutModal = document.getElementById('logoutModal');
    const closeModal = document.getElementById('closeModal');
    const cancelLogout = document.getElementById('cancelLogout');
    const confirmLogout = document.getElementById('confirmLogout');

    function initDashboard() {
        usernameElements.forEach(el => el.textContent = user.name);

        const availableItems = menuItems.filter(item => item.roles.includes(user.role));
        const sidebarMenu = document.querySelector('nav ul');
        const sidebarItemsHTML = availableItems.map(item => `
            <li class="mb-1">
                <a href="${item.url}" class="block px-4 py-2 rounded-md hover:bg-sky-100 ${item.textColor} hover:text-sky-800 font-medium transition">
                    <i class="fas ${item.icon} mr-3"></i> ${item.title}
                </a>
            </li>
        `).join('');
        sidebarMenu.innerHTML = sidebarItemsHTML;
    }

    logoutBtn.addEventListener('click', (e) => {
        e.preventDefault();
        logoutModal.classList.remove('hidden');
    });

    closeModal.addEventListener('click', () => {
        logoutModal.classList.add('hidden');
    });

    cancelLogout.addEventListener('click', () => {
        logoutModal.classList.add('hidden');
    });

    confirmLogout.addEventListener('click', (e) => {
        e.preventDefault();
        document.getElementById('logout-form').submit();
    });

    document.addEventListener('DOMContentLoaded', initDashboard);
</script>
