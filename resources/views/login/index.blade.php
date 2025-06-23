<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | POS System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 50%, #bbf7d0 100%);
        }
        
        .input-focus-effect:focus-within {
            box-shadow: 0 0 0 3px rgba(74, 222, 128, 0.2);
            transform: translateY(-1px);
        }
        
        .btn-hover-effect {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.1), 0 2px 4px -1px rgba(16, 185, 129, 0.06);
        }
        
        .btn-hover-effect:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(16, 185, 129, 0.1), 0 4px 6px -2px rgba(16, 185, 129, 0.05);
        }
    </style>
</head>

<body class="gradient-bg flex items-center justify-center min-h-screen p-4">
    <!-- Main Container -->
    <div class="w-full max-w-4xl rounded-2xl overflow-hidden shadow-2xl flex flex-col md:flex-row glass-effect animate-fade-in" style="opacity: 0;">
        <!-- Left Side - Branding -->
        <div class="md:w-2/5 bg-gradient-to-br from-green-50 to-emerald-50 p-8 flex flex-col items-center justify-center relative overflow-hidden">
            <!-- Decorative Elements -->
            <div class="absolute -top-20 -right-20 w-40 h-40 rounded-full bg-emerald-100/50"></div>
            <div class="absolute -bottom-10 -left-10 w-32 h-32 rounded-full bg-green-100/50"></div>
            
            <!-- Logo Container -->
            <div class="relative z-10 mb-8 flex items-center justify-center w-36 h-36 rounded-full bg-white/90 shadow-lg border-4 border-emerald-100/50">
                <img src="{{ asset('img/Logo-Tienda.jpg') }}" alt="Logo Empresa" class="object-contain w-28 h-28 rounded-full">
            </div>
            
            <!-- App Info -->
            <div class="relative z-10 text-center">
                <h2 class="text-3xl font-bold text-emerald-800 mb-2">Sistema POS</h2>
                <p class="text-emerald-600 text-lg mb-6">Gestión profesional de ventas</p>
                
                <!-- Features List -->
                <div class="space-y-3 text-left max-w-xs">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 mt-1">
                            <div class="h-5 w-5 rounded-full bg-emerald-100 flex items-center justify-center">
                                <i class="fas fa-check text-emerald-500 text-xs"></i>
                            </div>
                        </div>
                        <p class="ml-2 text-sm text-emerald-700">Control de inventario en tiempo real</p>
                    </div>
                    <div class="flex items-start">
                        <div class="flex-shrink-0 mt-1">
                            <div class="h-5 w-5 rounded-full bg-emerald-100 flex items-center justify-center">
                                <i class="fas fa-check text-emerald-500 text-xs"></i>
                            </div>
                        </div>
                        <p class="ml-2 text-sm text-emerald-700">Reportes financieros detallados</p>
                    </div>
                    <div class="flex items-start">
                        <div class="flex-shrink-0 mt-1">
                            <div class="h-5 w-5 rounded-full bg-emerald-100 flex items-center justify-center">
                                <i class="fas fa-check text-emerald-500 text-xs"></i>
                            </div>
                        </div>
                        <p class="ml-2 text-sm text-emerald-700">Multiples métodos de pago</p>
                    </div>
                </div>
            </div>
            
            <!-- Version -->
            <span class="absolute bottom-4 text-emerald-400 text-xs z-10">v2.0</span>
        </div>

        <!-- Right Side - Login Form -->
        <div class="md:w-3/5 p-10 flex flex-col justify-center">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-2">Bienvenido de vuelta</h2>
                <p class="text-gray-600">Ingresa tus credenciales para acceder al sistema</p>
            </div>
            
            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Correo electrónico</label>
                    <div class="relative input-focus-effect transition-all">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-emerald-400"></i>
                        </div>
                        <input type="email" id="email" name="email" required 
                               class="block w-full pl-10 pr-3 py-3 rounded-lg border border-gray-200 bg-white/50 focus:ring-2 focus:ring-emerald-200 focus:border-emerald-300 text-gray-700 placeholder-gray-400 transition-all"
                               placeholder="ejemplo@correo.com">
                    </div>
                </div>
                
                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Contraseña</label>
                    <div class="relative input-focus-effect transition-all">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-emerald-400"></i>
                        </div>
                        <input type="password" id="password" name="password" required 
                                class="block w-full pl-10 pr-10 py-3 rounded-lg border border-gray-200 bg-white/50 focus:ring-2 focus:ring-emerald-200 focus:border-emerald-300 text-gray-700 placeholder-gray-400 transition-all"
                                placeholder="••••••••">
                        <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-emerald-500 focus:outline-none transition-colors">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Remember & Forgot Password -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-emerald-500 focus:ring-emerald-300 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">Recordar sesión</label>
                    </div>
                    <div>
                        <a href="#" class="text-sm font-medium text-emerald-500 hover:text-emerald-600 hover:underline transition-colors">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>
                </div>
                
                <!-- Submit Button -->
                <button type="submit" class="w-full btn-hover-effect bg-gradient-to-r from-emerald-500 to-green-500 hover:from-emerald-600 hover:to-green-600 text-white font-semibold py-3 px-4 rounded-lg shadow-md flex items-center justify-center gap-2">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Iniciar sesión</span>
                </button>
                
                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="mt-4 bg-red-50 border-l-4 border-red-500 p-4 rounded-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-circle text-red-500"></i>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Error de autenticación</h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <ul class="list-disc pl-5 space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </form>
            
            <!-- Footer Links -->
            <div class="mt-8 text-center text-sm text-gray-500">
                <p>¿Necesitas una cuenta? <a href="#" class="font-medium text-emerald-500 hover:text-emerald-600 hover:underline transition-colors">Contacta al administrador</a></p>
                <p class="mt-2">© {{ date('Y') }} Sistema POS. Todos los derechos reservados.</p>
            </div>
        </div>
    </div>

    <script>
        // Password toggle
        document.getElementById('togglePassword').addEventListener('click', function () {
            const password = document.getElementById('password');
            const icon = this.querySelector('i');
            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                password.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        });
        
        // Animation trigger
        document.addEventListener('DOMContentLoaded', () => {
            const element = document.querySelector('.animate-fade-in');
            element.style.opacity = 1;
        });
    </script>
</body>

</html>