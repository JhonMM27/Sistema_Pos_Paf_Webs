@extends('layout.app')

@section('contenido')

@push('estilos')
<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .animate-card {
        animation: fadeIn 0.6s ease-out forwards;
        opacity: 0;
    }
    
    .dashboard-card {
        transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        backdrop-filter: blur(8px);
        background: rgba(255, 255, 255, 0.8);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        background: rgba(255, 255, 255, 0.95);
    }
    
    .greeting-text {
        background: linear-gradient(90deg, #3b82f6, #8b5cf6);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    
    .card-icon {
        transition: all 0.3s ease;
    }
    
    .dashboard-card:hover .card-icon {
        transform: scale(1.1);
    }
</style>
@endpush

<!-- Main Content -->
<main class="flex-1 p-6 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto">
        <header class="mb-10">
            <h1 class="greeting-text text-3xl md:text-4xl font-bold mb-3">
                Bienvenido, <span class="text-gray-800">{{ Auth::user()->name }}</span>
            </h1>
            <p class="text-gray-500 text-lg">Aquí puedes administrar todas las funciones de tu negocio</p>
            <div class="mt-4 flex items-center text-sm text-gray-400">
                <i class="fas fa-user-shield mr-2"></i>
                {{ Auth::user()->roles->pluck('name')->implode(', ') }}
                <span class="mx-3">•</span>
                <i class="far fa-clock mr-2"></i>
                Último acceso: {{ now()->format('d M Y, h:i a') }}
            </div>
        </header>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="dashboard-cards">
            <!-- Las tarjetas del dashboard se generarán con JavaScript -->
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Datos de las opciones del menú
    const menuItems = [
        { 
            title: "Ventas", 
            icon: "fa-cash-register", 
            color: "from-green-500 to-emerald-500", 
            description: "Gestiona tus ventas y transacciones", 
            roles: ['Administrador', 'manager', 'Vendedor'], 
            url: "{{route('ventas.index')}}" 
        },
        { 
            title: "Compras", 
            icon: "fa-shopping-cart", 
            color: "from-purple-500 to-fuchsia-500", 
            description: "Gestiona tus compras y transacciones", 
            roles: ['Administrador', 'manager'], 
            url: "{{route('compras.index')}}" 
        },
        { 
            title: "Inventario", 
            icon: "fa-boxes", 
            color: "from-blue-500 to-cyan-500", 
            description: "Control de stock y productos", 
            roles: ['Administrador', 'manager'], 
            url: "{{route('productos.index')}}" 
        },
        { 
            title: "Clientes", 
            icon: "fa-users", 
            color: "from-indigo-500 to-violet-500", 
            description: "Administra tu base de clientes", 
            roles: ['Administrador', 'manager', 'Vendedor'], 
            url: "{{route('clientes.index')}}" 
        },
        { 
            title: "Proveedores", 
            icon: "fa-truck", 
            color: "from-amber-500 to-orange-500", 
            description: "Gestiona tus proveedores", 
            roles: ['Administrador', 'manager'], 
            url: "{{route('proveedores.index')}}" 
        },
        { 
            title: "Reportes", 
            icon: "fa-chart-line", 
            color: "from-rose-500 to-pink-500", 
            description: "Análisis y estadísticas", 
            roles: ['Administrador', 'manager'], 
            url: "{{route('reportes.index')}}" 
        },
        { 
            title: "Configuración", 
            icon: "fa-cog", 
            color: "from-gray-500 to-slate-500", 
            description: "Ajustes del sistema", 
            roles: ['Administrador'], 
            url: "{{route('configuracion.index')}}" 
        }
    ];

    // Filtrar las opciones del menú según el rol del usuario
    const userRoles = "{{ Auth::user()->roles->pluck('name')->implode(',') }}".split(',');
    const availableItems = menuItems.filter(item => 
        item.roles.some(role => userRoles.includes(role))
    );

    // Generar las tarjetas del dashboard con animaciones escalonadas
    const dashboardCards = document.getElementById('dashboard-cards');
    
    availableItems.forEach((item, index) => {
        const card = document.createElement('a');
        card.href = item.url;
        card.className = `dashboard-card animate-card rounded-xl p-6 flex flex-col items-center text-center overflow-hidden relative`;
        card.style.animationDelay = `${index * 100}ms`;
        
        card.innerHTML = `
            <div class="absolute inset-0 bg-gradient-to-br ${item.color} opacity-10"></div>
            <div class="card-icon h-20 w-20 bg-white rounded-full flex items-center justify-center mb-4 shadow-md relative z-10">
                <div class="bg-gradient-to-br ${item.color} h-16 w-16 rounded-full flex items-center justify-center">
                    <i class="fas ${item.icon} text-white text-xl"></i>
                </div>
            </div>
            <h3 class="font-bold text-xl mb-2 text-gray-800 relative z-10">${item.title}</h3>
            <p class="text-gray-600 relative z-10">${item.description}</p>
            <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r ${item.color}"></div>
        `;
        
        dashboardCards.appendChild(card);
    });
});
</script>

@endsection