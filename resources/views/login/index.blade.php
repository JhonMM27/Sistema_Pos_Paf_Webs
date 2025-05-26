{{-- <!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS System Pro - Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <!-- Iconos de Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="logo-container">
                    <div class="logo-icon">
                        <i class='bx bx-store'></i>
                    </div>
                </div>
                <h1>POS System Pro</h1>
                <p>Ingrese sus credenciales para continuar</p>
            </div>

            <div class="login-form">
                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="username">Usuario</label>
                        <div class="input-container">
                            <i class='bx bx-user input-icon'></i>
                            <input type="email" id="username" name="email" placeholder="Ingrese su correo">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <div class="input-container">
                            <i class='bx bx-lock-alt input-icon'></i>
                            <input type="password" id="password" name="password" placeholder="Ingrese su contraseña">
                            <i class='bx bx-show password-toggle' id="togglePassword"></i>
                        </div>
                    </div>


                    <div class="form-options">
                        <div class="remember-me">
                            <input type="checkbox" id="remember">
                            <label for="remember">Recordarme</label>
                        </div>
                        <a href="#" class="forgot-password">¿Olvidó su contraseña?</a>
                    </div>

                    <button type="submit" class="login-button" id="loginBtn">
                        <i class='bx bx-log-in-circle'></i>
                        Iniciar Sesión
                    </button>
                    @if ($errors->any())
                        <div class="errors">
                            <ul class="l-errors">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </form>

                <div class="signup-link">
                    <p>¿No tiene una cuenta? <a href="#">Contáctenos</a></p>
                </div>
            </div>
        </div>

        <div class="footer">
            <p>&copy; 2023 POS System Pro. Todos los derechos reservados.</p>
        </div>
    </div>

    <script>
        
        
        
    </script>
</body>

</html> --}}




<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Inicio de Sesión | Sistema Corporativo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <style>
        body {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        /* .errors {
            color: red;
            margin-top: 1rem;
        } */
        .card {
            border-radius: 1.5rem;
            overflow: hidden;
        }
        .shake {
            animation: shake 0.5s;
        }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
    </style>
</head>
<body>
    <div class="card shadow w-100" style="max-width: 400px;">
        <!-- Encabezado -->
        <div class="bg-primary text-white text-center p-4">
            <div class="mb-3">
                <div class="bg-white d-inline-flex p-3 rounded-circle shadow">
                    <i class="fas fa-lock text-primary fs-3"></i>
                </div>
            </div>
            <h1 class="h4 mb-0 fw-bold">Sistema POS</h1>
            <p class="small">Ingrese sus credenciales para continuar</p>
        </div>

        <!-- Formulario -->
        <div class="p-4">
            <form action="{{ route('login') }}" method="POST" id="loginForm" class="needs-validation" >
                @csrf
                <!-- Usuario -->
                <div class="mb-3">
                    <label for="username" class="form-label">Usuario</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="email" class="form-control" id="username" name="email" required placeholder="Ingrese su correo">
                    </div>
                </div>

                <!-- Contraseña -->
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                        <input type="password" class="form-control" id="password" name="password" required placeholder="Ingrese su contraseña">
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword"><i class="fas fa-eye"></i></button>
                    </div>
                </div>

                <!-- Botón -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
                    </button>
                    @if ($errors->any())
                        <div class="text-danger mt-1">
                            <ul class="l-errors">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </form>

            {{-- <!-- Enlace -->
            <div class="text-center mt-3">
                <a href="#" class="text-decoration-none text-primary">¿Olvidó su contraseña?</a>
            </div> --}}
        </div>
        <div class="card-footer text-center text-muted">
            <p>&copy; 2025 Todos los derechos reservados.</p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const loginForm = document.getElementById('loginForm');
            const errorMessage = document.getElementById('errorMessage');
            const togglePassword = document.getElementById('togglePassword');
            const passwordField = document.getElementById('password');

            // Mostrar/Ocultar contraseña
            togglePassword.addEventListener('click', function () {
                const icon = this.querySelector('i');
                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    icon.classList.replace('fa-eye', 'fa-eye-slash');
                } else {
                    passwordField.type = 'password';
                    icon.classList.replace('fa-eye-slash', 'fa-eye');
                }
            });

            // // Validación de formulario
            // loginForm.addEventListener('submit', function (e) {
            //     e.preventDefault();

            //     const username = document.getElementById('username').value.trim();
            //     const password = document.getElementById('password').value.trim();

            //     if (username === '' || password === '') {
            //         showError('Por favor ingrese usuario y contraseña');
            //     } else if (username === 'demo' && password === 'demo') {
            //         alert('¡Inicio de sesión exitoso! Redirigiendo...');
            //         // window.location.href = 'dashboard.html';
            //     } else {
            //         showError('Usuario o contraseña incorrectos');
            //     }
            // });

            // function showError(message) {
            //     errorMessage.classList.remove('d-none');
            //     document.getElementById('errorText').textContent = message;
            //     loginForm.classList.add('shake');
            //     setTimeout(() => {
            //         loginForm.classList.remove('shake');
            //     }, 500);
            // }
        });
    </script>
<script src="{{asset('js/bootstrap.js')}}"></script>
</body>
</html>