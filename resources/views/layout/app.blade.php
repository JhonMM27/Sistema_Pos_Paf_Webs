<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Panel de Control</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @stack('estilos')
</head>

<body class="bg-gray-100 min-h-screen">
    <!-- Header móvil solo en móvil -->
    <header
        class="lg:hidden bg-gradient-to-r from-sky-900 to-blue-900 text-white shadow-xl sticky top-0 z-50 backdrop-blur-md">
        <div class="flex items-center justify-between px-4 py-3 relative">

            <!-- Botón ☰ a la izquierda -->
            <div class="absolute left-4 top-1/2 -translate-y-1/2">
                <button id="mobileMenuBtn"
                    class="p-2 rounded-lg hover:bg-blue-800/50 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <i id="mobileMenuIcon" class="fas fa-bars text-2xl"></i>
                </button>
            </div>

            <!-- Título perfectamente centrado -->
            <div class="mx-auto">
                <h1 class="flex items-center gap-2 text-base font-bold tracking-wide leading-none">
                    <i class="fas fa-store text-blue-200 text-base align-middle"></i>
                    <span class="align-middle">Sistema POS</span>
                </h1>
            </div>

            <!-- Espaciador simétrico derecho -->
            <div class="invisible w-10"></div>

        </div>
    </header>

    <script>
        function toggleMobileMenuBtn() {
            const btn = document.getElementById('mobileMenuBtn');
            if (window.innerWidth < 1024) {
                btn.style.display = 'block';
            } else {
                btn.style.display = 'none';
            }
        }

        // Ejecutar al cargar
        toggleMobileMenuBtn();

        // Ejecutar al redimensionar
        window.addEventListener('resize', toggleMobileMenuBtn);
    </script>
    <!-- Sidebar Overlay solo en móvil, z-40 -->
    <div id="sidebarOverlay" class="sidebar-overlay lg:hidden z-40"></div>
    <div class="min-h-screen flex">
        @if (!isset($hideSidebar))
            <div id="sidebarContainer" class="sidebar-mobile">
                @include('layout.sidebar')
            </div>
        @endif
        <main class="main-content flex-1 w-full transition-all duration-300">
            @yield('contenido')
        </main>
    </div>
    @stack('scripts')

</body>

</html>
