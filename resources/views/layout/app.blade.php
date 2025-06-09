<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control</title>
    <script src="https://cdn.tailwindcss.com"></script>

       
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            transition: background-color 0.3s;
        }

        @media (max-width: 640px) {
            .greeting-text {
                font-size: 1.5rem;
            }
        }
    </style>

    @stack('estilos')
</head>

<body class="bg-gray-100 min-h-screen">
    <div class="flex flex-col lg:flex-row min-h-screen ">
        @include('layout.sidebar')
        @yield('contenido')
    </div>

</body>
@stack('scripts')

</html>
