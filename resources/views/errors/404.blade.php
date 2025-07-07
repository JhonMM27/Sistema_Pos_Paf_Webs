<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 404 - Página no encontrada</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }
        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-15px);
            }
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .pulse-animation {
            animation: pulse 2s infinite;
        }
        .float-animation {
            animation: float 3s ease-in-out infinite;
        }
        .fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }
        .delay-1 {
            animation-delay: 0.3s;
        }
        .delay-2 {
            animation-delay: 0.6s;
        }
        .delay-3 {
            animation-delay: 0.9s;
        }
        .bg-gradient-dark {
            background: linear-gradient(135deg, #1a202c 0%, #2d3748 100%);
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-dark text-white">
    <div class="container mx-auto px-4 py-16 flex flex-col items-center justify-center min-h-screen">
        <div class="text-center mb-12 transform transition-all duration-300">
            <img src="https://cdn-icons-png.flaticon.com/512/835/835408.png" alt="Not Found" 
                 class="w-48 mx-auto mb-8 float-animation pulse-animation hover:animate-none">
            
            <h1 class="text-6xl font-bold mb-6 fade-in">
                <span class="text-blue-400">Error 404</span> - Página no encontrada
            </h1>
            
            <div class="max-w-2xl mx-auto">
                <div class="bg-gray-800 bg-opacity-50 rounded-lg p-6 backdrop-blur-sm border border-gray-700 mb-8 fade-in delay-1">
                    <p class="text-lg mb-4">
                        <i class="fas fa-search text-blue-400 mr-2"></i>
                        La página que buscas no existe o ha sido movida.
                    </p>
                    <p class="text-gray-300">
                        El servidor no pudo encontrar el recurso solicitado. Esto puede deberse a:
                    </p>
                    
                    <ul class="list-disc list-inside mt-4 space-y-2 text-left text-gray-300">
                        <li class="animate-pulse">Un enlace roto o incorrecto</li>
                        <li class="animate-pulse delay-100">La página ha sido eliminada o renombrada</li>
                        <li class="animate-pulse delay-200">Un error al escribir la URL</li>
                        <li class="animate-pulse delay-300">El recurso ya no está disponible</li>
                    </ul>
                </div>
                
                <div class="contact-info bg-gray-800 bg-opacity-70 rounded-lg p-6 border border-gray-700 backdrop-blur-sm fade-in delay-2">
                    <p class="mb-2 flex items-center">
                        <i class="fas fa-user-shield text-blue-400 mr-2"></i>
                        Si crees que esto es un error, contacta al administrador del sistema
                    </p>
                    <p class="flex items-center">
                        <i class="fas fa-clock text-yellow-400 mr-2"></i>
                        Tu sesión actual: <span id="currentUser" class="font-semibold ml-1">Usuario</span>
                    </p>
                </div>
                
                <div class="mt-12 flex flex-wrap justify-center gap-4 fade-in delay-3">
                    <a href="/" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 rounded-lg font-medium transition-all transform hover:scale-105">
                        <i class="fas fa-home mr-2"></i> Volver al inicio
                    </a>
                    <button onclick="goBack()" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 rounded-lg font-medium transition-all transform hover:scale-105">
                        <i class="fas fa-arrow-left mr-2"></i> Página anterior
                    </button>
                    <a href="/contact" class="px-6 py-3 bg-green-600 hover:bg-green-700 rounded-lg font-medium transition-all transform hover:scale-105">
                        <i class="fas fa-envelope mr-2"></i> Reportar error
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <footer class="text-center pb-8 text-gray-400 text-sm fade-in delay-3">
        <p>Sistema de Seguridad &copy; 2023 - Todos los derechos reservados</p>
    </footer>

    <script>
        // Simula la obtención del usuario actual
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(() => {
                document.getElementById('currentUser').textContent = 'Usuario Ejemplo'; // Cambiaría por el usuario real
            }, 500);
            
            // Agrega hover effect al ícono principal
            const forbiddenIcon = document.querySelector('.float-animation');
            forbiddenIcon.addEventListener('mouseenter', () => {
                forbiddenIcon.style.animation = 'none';
            });
            forbiddenIcon.addEventListener('mouseleave', () => {
                forbiddenIcon.style.animation = 'float 3s ease-in-out infinite';
            });
        });
        
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>