@extends('layout.app')

@section('contenido')

@push('estilos')
    <style>
        .dashboard-card {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }
        
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
    </style>
@endpush

<!-- Main Content -->
<main class="flex-1 p-6">
    <header class="mb-8">
        <h1 class="greeting-text text-2xl md:text-3xl font-bold text-gray-800 mb-2">Bienvenido(a), <span id="main-username">{{ Auth::user()->name }}</span></h1>
        <p class="text-gray-600">Aquí puedes administrar todas las funciones de tu negocio</p>
    </header>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="dashboard-cards">
        <!-- Las tarjetas del dashboard se generarán con JavaScript -->
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // User data
        const user = {
            name: "{{ Auth::user()->name }}",
            role: "{{ Auth::user()->roles->pluck('name')->implode(', ') }}",
            lastAccess: new Date().toLocaleDateString()
        };

        // Datos de las opciones del menú
        const menuItems = [
            { title: "Ventas", icon: "fa-cash-register", color: "bg-green-100", textColor: "text-green-700", description: "Gestiona tus ventas y transacciones", roles: ['Administrador', 'manager', 'sales'], url: "#" },
            { title: "Inventario", icon: "fa-boxes", color: "bg-blue-100", textColor: "text-blue-700", description: "Control de stock y productos", roles: ['Administrador', 'manager'], url: "{{route('categorias.store')}}" },
            { title: "Clientes", icon: "fa-users", color: "bg-purple-100", textColor: "text-purple-700", description: "Administra tu base de clientes", roles: ['Administrador', 'manager', 'sales'], url: "#" },
            { title: "Proveedores", icon: "fa-truck", color: "bg-orange-100", textColor: "text-orange-700", description: "Gestiona tus proveedores", roles: ['Administrador', 'manager'], url: "#" },
            { title: "Reportes", icon: "fa-chart-bar", color: "bg-indigo-100", textColor: "text-indigo-700", description: "Análisis y estadísticas", roles: ['Administrador', 'manager'], url: "#" },
            { title: "Configuración", icon: "fa-cog", color: "bg-gray-100", textColor: "text-gray-700", description: "Ajustes del sistema", roles: ['Administrador'], url: "#" }
        ];

        // Inicializar las tarjetas del dashboard
        const dashboardCards = document.getElementById('dashboard-cards');

        // Filtrar las opciones del menú según el rol del usuario
        const availableItems = menuItems.filter(item => item.roles.includes(user.role));

        // Generar las tarjetas del dashboard
        dashboardCards.innerHTML = availableItems.map(item => `
            <a href="${item.url}" class="dashboard-card ${item.color} ${item.textColor} rounded-xl p-6 flex flex-col items-center text-center hover:shadow-md transition">
                <div class="h-16 w-16 ${item.color} ${item.textColor} rounded-full flex items-center justify-center mb-4">
                    <i class="fas ${item.icon} text-2xl"></i>
                </div>
                <h3 class="font-bold text-lg mb-2">${item.title}</h3>
                <p class="text-sm">${item.description}</p>
            </a>
        `).join('');
    });
</script>

@endsection
