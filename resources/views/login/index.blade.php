<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | POS System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        @keyframes bounce-in {
            0% { transform: scale(0.9); opacity: 0; }
            60% { transform: scale(1.05); opacity: 1; }
            100% { transform: scale(1); }
        }

        .animate-bounce-in {
            animation: bounce-in 0.6s ease-out;
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-blue-500 to-indigo-700 flex items-center justify-center px-4">
    <div class="bg-white rounded-xl shadow-lg max-w-md w-full overflow-hidden animate-bounce-in">
        <!-- Encabezado -->
        <div class="bg-blue-600 text-white text-center py-6 px-4">
            <div class="bg-white inline-flex p-4 rounded-full shadow mb-3">
                <i class="fas fa-lock text-blue-600 text-2xl"></i>
            </div>
            <h1 class="text-xl font-bold">Sistema POS</h1>
            <p class="text-sm">Ingrese sus credenciales para continuar</p>
        </div>

        <!-- Formulario -->
        <div class="p-6">
            <form action="{{ route('login') }}" method="POST" class="space-y-4" id="loginForm">
                @csrf
                <!-- Usuario -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico</label>
                    <div class="flex items-center border rounded-md overflow-hidden focus-within:ring-2 focus-within:ring-blue-500">
                        <span class="px-3 text-gray-500"><i class="fas fa-user"></i></span>
                        <input type="email" id="email" name="email" required class="w-full px-3 py-2 outline-none" placeholder="ejemplo@correo.com">
                    </div>
                </div>

                <!-- Contraseña -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
                    <div class="flex items-center border rounded-md overflow-hidden focus-within:ring-2 focus-within:ring-blue-500">
                        <span class="px-3 text-gray-500"><i class="fas fa-key"></i></span>
                        <input type="password" id="password" name="password" required class="w-full px-3 py-2 outline-none" placeholder="********">
                        <button type="button" id="togglePassword" class="px-3 text-gray-500 hover:text-blue-600">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Botón -->
                <div>
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-md font-semibold transition-all">
                        <i class="fas fa-sign-in-alt mr-2"></i> Iniciar Sesión
                    </button>
                </div>

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded-md">
                        <ul class="text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </form>

            <!-- Enlace adicional -->
            <div class="text-center mt-4 text-sm">
                <p>¿No tienes una cuenta? <a href="#" class="text-blue-600 hover:underline">Contáctanos</a></p>
            </div>
        </div>

        <!-- Pie -->
        <div class="bg-gray-50 text-center py-3 text-xs text-gray-500">
            &copy; 2025 POS System. Todos los derechos reservados.
        </div>
    </div>

    <script>
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
    </script>
</body>

</html>
