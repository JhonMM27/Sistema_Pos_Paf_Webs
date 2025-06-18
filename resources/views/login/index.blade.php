<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | POS System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #e8fdf5 0%, #baf7d8 100%);
            min-height: 100vh;
        }
        .shadow-glass {
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.10);
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen px-2">
    <div class="w-full max-w-3xl bg-white/80 rounded-2xl shadow-glass flex flex-col md:flex-row overflow-hidden">
        <!-- Lado Izquierdo: Logo y descripción -->
        <div class="md:w-1/2 flex flex-col items-center justify-center bg-gradient-to-br from-green-100 via-green-50 to-green-200 p-8 relative">
            <!-- Logo de la empresa -->
            <div class="mb-6 flex items-center justify-center w-32 h-32 rounded-full bg-white/70 shadow-lg border-4 border-green-100">
                <img src="{{ asset('img/Logo-Tienda.jpg') }}" alt="Logo Empresa" class="object-contain w-24 h-24 rounded-full shadow-md">
            </div>
            <h2 class="text-2xl font-extrabold text-green-800 mb-2">Sistema POS</h2>
            <p class="text-green-600 text-base mb-8 text-center">Gestión de ventas y inventario</p>
            <span class="absolute bottom-4 left-1/2 -translate-x-1/2 text-green-400 text-xs">Versión 1.0</span>
        </div>
        <!-- Lado Derecho: Formulario -->
        <div class="md:w-1/2 w-full bg-white/90 p-8 flex flex-col justify-center">
            <h2 class="text-2xl font-extrabold text-green-800 mb-2 text-center">Bienvenido</h2>
            <p class="text-green-700 text-sm mb-6 text-center">Ingresa tus credenciales para acceder al sistema</p>
            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-semibold text-green-800 mb-1">Correo electrónico</label>
                    <div class="flex items-center border-2 border-green-100 rounded-lg overflow-hidden focus-within:ring-2 focus-within:ring-green-200 bg-white transition-all">
                        <span class="px-3 text-green-400"><i class="fas fa-envelope"></i></span>
                        <input type="email" id="email" name="email" required class="w-full px-3 py-2 outline-none bg-transparent text-green-900 placeholder-green-400 text-base" placeholder="tucorreo@ejemplo.com">
                    </div>
                </div>
                <div>
                    <label for="password" class="block text-sm font-semibold text-green-800 mb-1">Contraseña</label>
                    <div class="flex items-center border-2 border-green-100 rounded-lg overflow-hidden focus-within:ring-2 focus-within:ring-green-200 bg-white transition-all">
                        <span class="px-3 text-green-400"><i class="fas fa-lock"></i></span>
                        <input type="password" id="password" name="password" required class="w-full px-3 py-2 outline-none bg-transparent text-green-900 placeholder-green-400 text-base" placeholder="********">
                        <button type="button" id="togglePassword" class="px-3 text-green-400 hover:text-green-600 focus:outline-none">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <label class="inline-flex items-center text-green-700 text-sm">
                        <input type="checkbox" class="form-checkbox accent-green-500 mr-2" name="remember">
                        Recordarme
                    </label>
                    <a href="#" class="text-green-500 text-sm hover:underline">¿Olvidaste tu contraseña?</a>
                </div>
                <button type="submit" class="w-full bg-green-400 hover:bg-green-500 text-white py-2.5 rounded-lg font-bold text-lg shadow-md transition-all flex items-center justify-center gap-2">
                    <i class="fas fa-sign-in-alt"></i> Iniciar sesión
                </button>
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-2 rounded-md mt-2 shadow">
                        <ul class="text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </form>
            <div class="text-center mt-6 text-sm">
                <p>¿No tienes una cuenta? <a href="#" class="text-green-600 hover:underline font-semibold">Contacta al administrador</a></p>
            </div>
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
