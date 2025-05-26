<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Sistema Corporativo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            min-height: 100vh;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .active-menu {
            border-left: 4px solid #3b82f6;
            background-color: #f0f7ff;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in {
            animation: fadeIn 0.3s ease-out forwards;
        }
    </style>
</head>
<body>
    <div class="d-flex flex-column flex-md-row">
        <!-- Sidebar -->
        <div class="bg-white shadow-lg d-none d-md-block" style="width: 235px; min-height: 100vh;">
            <div class="p-2 border-bottom">
                <div class="text-center mb-3">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex p-3">
                        <i class="fas fa-lock text-primary fs-3"></i>
                    </div>
                </div>
                <h5 class="text-center fw-bold text-dark">Sistema Ventas</h5>
            </div>
            <div class="p-2">
                <div class="d-flex align-items-center bg-light p-2 rounded mb-4">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                        <i class="fas fa-user"></i>
                    </div>
                    <div>
                        {{-- <small class="text-muted">Bienvenido(a),</small><br> --}}
                        <strong id="usernameDisplay">{{Auth::user()->name}}</strong>
                    </div>
                </div>
                <nav class="nav flex-column">
                    <a href="#" class="nav-link text-dark active-menu"><i class="fas fa-tachometer-alt me-2 text-primary"></i>Resumen</a>
                    <a href="#" class="nav-link text-dark"><i class="fas fa-shopping-cart me-2 text-success"></i>Ventas</a>
                    <a href="#" class="nav-link text-dark"><i class="fas fa-boxes me-2 text-warning"></i>Inventario</a>
                    <a href="#" class="nav-link text-dark"><i class="fas fa-users me-2 text-purple"></i>Clientes</a>
                    <a href="#" class="nav-link text-dark"><i class="fas fa-truck me-2 text-info"></i>Proveedores</a>
                    <a href="#" class="nav-link text-dark"><i class="fas fa-chart-bar me-2 text-danger"></i>Reportes</a>
                    <a href="#" class="nav-link text-dark"><i class="fas fa-cog me-2"></i>Configuración</a>
                </nav>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <div class="p-4 border-top mt-auto">
                <a id="logoutBtn" class="btn btn-outline-danger w-100"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt me-2"></i>Cerrar sesión</a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1 p-4">
            <div class="bg-white rounded shadow-sm p-4 mb-4">
                <h2 class="fw-bold"><span id="usernameDisplayMobile">{{Auth::user()->name}}</span></h2>
                <p class="text-muted">¿Qué te gustaría hacer hoy?</p>
                <div class="row g-4 mt-3">
                    <div class="col-sm-6 col-md-3">
                        <div class="bg-primary bg-opacity-10 p-3 rounded">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="text-muted">Ventas hoy</small>
                                    <div class="fw-bold fs-5">$4,200</div>
                                </div>
                                <i class="fas fa-shopping-cart text-primary fs-4"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="bg-success bg-opacity-10 p-3 rounded">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="text-muted">Nuevos clientes</small>
                                    <div class="fw-bold fs-5">12</div>
                                </div>
                                <i class="fas fa-user-plus text-success fs-4"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="bg-warning bg-opacity-10 p-3 rounded">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="text-muted">Stock bajo</small>
                                    <div class="fw-bold fs-5">5</div>
                                </div>
                                <i class="fas fa-exclamation-triangle text-warning fs-4"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="bg-secondary bg-opacity-10 p-3 rounded">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="text-muted">Tareas pendientes</small>
                                    <div class="fw-bold fs-5">3</div>
                                </div>
                                <i class="fas fa-tasks text-secondary fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Functional Cards -->
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm fade-in">
                        <div class="card-header bg-success text-white d-flex justify-content-between">
                            <h5 class="mb-0"><i class="fas fa-shopping-cart me-2"></i>Ventas</h5>
                            <i class="fas fa-ellipsis-h"></i>
                        </div>
                        <div class="card-body">
                            <p>Gestión de ventas, facturación y transacciones.</p>
                            <a href="#" class="btn btn-success btn-sm me-2">Nueva venta</a>
                            <a href="#" class="btn btn-outline-secondary btn-sm">Ver historial</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm fade-in">
                        <div class="card-header bg-warning text-white d-flex justify-content-between">
                            <h5 class="mb-0"><i class="fas fa-boxes me-2"></i>Inventario</h5>
                            <i class="fas fa-ellipsis-h"></i>
                        </div>
                        <div class="card-body">
                            <p>Administración de productos y existencias.</p>
                            <a href="#" class="btn btn-warning btn-sm me-2">Agregar producto</a>
                            <a href="#" class="btn btn-outline-secondary btn-sm">Ver stock</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm fade-in">
                        <div class="card-header bg-secondary text-white d-flex justify-content-between">
                            <h5 class="mb-0"><i class="fas fa-users me-2"></i>Clientes</h5>
                            <i class="fas fa-ellipsis-h"></i>
                        </div>
                        <div class="card-body">
                            <p>Gestión de clientes y base de datos.</p>
                            <a href="#" class="btn btn-secondary btn-sm me-2">Nuevo cliente</a>
                            <a href="#" class="btn btn-outline-secondary btn-sm">Lista completa</a>
                        </div>
                    </div>
                </div>
                <!-- Agrega más tarjetas similares aquí si es necesario -->
            </div>
        </div>
    </div>

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            const username = localStorage.getItem('username') || '{{ auth()->user()->name ?? "Usuario Demo" }}';
            document.getElementById('usernameDisplay').textContent = username;
            document.getElementById('usernameDisplayMobile').textContent = username;

            document.getElementById('logoutBtn').addEventListener('click', function () {
                if (confirm('¿Está seguro que desea cerrar sesión?')) {
                    localStorage.removeItem('username');
                    window.location.href = '{{route("logout")}}';
                    
                }
            });
        });
    </script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
