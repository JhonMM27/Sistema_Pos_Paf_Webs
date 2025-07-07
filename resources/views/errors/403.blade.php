<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 403 - Acceso Denegado</title>
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
            <img src="https://cdn-icons-png.flaticon.com/512/5948/5948534.png" alt="Forbidden" 
                 class="w-48 mx-auto mb-8 float-animation pulse-animation hover:animate-none">
            
            <h1 class="text-6xl font-bold mb-6 fade-in">
                <span class="text-red-400">Error 403</span> - Acceso Denegado
            </h1>
            
            <div class="max-w-2xl mx-auto">
                <div class="bg-gray-800 bg-opacity-50 rounded-lg p-6 backdrop-blur-sm border border-gray-700 mb-8 fade-in delay-1">
                    <p class="text-lg mb-4">
                        <i class="fas fa-lock text-red-400 mr-2"></i>
                        No tienes permisos para acceder a esta página o recurso.
                    </p>
                    <p class="text-gray-300">
                        El servidor ha entendido tu solicitud, pero se niega a autorizarla debido a restricciones de acceso.
                        Esto puede deberse a:
                    </p>
                    
                    <ul class="list-disc list-inside mt-4 space-y-2 text-left text-gray-300">
                        <li class="animate-pulse">Credenciales insuficientes o incorrectas</li>
                        <li class="animate-pulse delay-100">Restricciones específicas de tu rol de usuario</li>
                        <li class="animate-pulse delay-200">Acceso denegado por configuración del administrador</li>
                        <li class="animate-pulse delay-300">Intentaste acceder a contenido protegido</li>
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
                    <a href="{{ route('dashboard') }}" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 rounded-lg font-medium transition-all transform hover:scale-105">
                        <i class="fas fa-home mr-2"></i> Volver al dashboard
                    </a>
                    <button onclick="window.history.back()" class="btn-back px-6 py-3 bg-purple-600 hover:bg-purple-700 rounded-lg font-medium transition-all transform hover:scale-105">
                        <i class="fas fa-arrow-left"></i> Regresar a la página anterior
                    </button>
                </div>
            </div>
        </div>
    </div>
    

    <script>
        // Simula la obtención del usuario actual
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(() => {
                document.getElementById('currentUser').textContent = '{{ Auth::user()->name }}'; // Cambiaría por el usuario real
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
    

        document.addEventListener('DOMContentLoaded', function() {
            const backButton = document.querySelector('.btn-back');
            
            backButton.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Verificar si hay historial para volver atrás
                if (window.history.length > 1) {
                    window.history.back();
                } else {
                    // Si no hay historial, redirigir al dashboard
                    window.location.href = '{{ route("dashboard") }}';
                }
            });
        });
    </script>
</body>
</html>