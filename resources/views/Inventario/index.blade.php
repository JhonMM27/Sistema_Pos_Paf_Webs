@extends('layout.app')
@section('contenido')
    {{-- <script>
        // Set default active tab as "Products"
        window.onload = function() {
            document.getElementById("productsTab").click(); // Activate Products Tab
        };
    </script> --}}
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="mb-6">
            <ul class="flex space-x-4 border-b border-gray-200">
                <li>
                    <button id="productsTab"
                        class="px-4 py-2 text-lg font-medium text-gray-700 hover:text-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        Productos
                    </button>
                </li>
                <li>
                    <button id="categoriesTab"
                        class="px-4 py-2 text-lg font-medium text-gray-700 hover:text-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        Categorias
                    </button>
                </li>
            </ul>
        </div>

        
        @include('inventario.producto.index')


        @include('inventario.categoria.index')

    </main>
    
    {{-- @include('producto.index') --}}


    <!-- Modales -->
    @include('inventario.categoria.modal')
    <script>
        // // Set default active tab as "Products"
        // window.onload = function() {
        //     document.getElementById("productsTab").click(); // Activate Products Tab
        // };
        // Mostrar y ocultar modales
        const closeModalButtons = document.querySelectorAll('.close-modal');
        closeModalButtons.forEach(button => {
            button.addEventListener('click', () => {
                button.closest('.fixed').classList.add('hidden');
            });
        });


        document.getElementById("productsTab").addEventListener("click", function() {
            document.getElementById("productsContent").classList.remove("hidden");
            document.getElementById("categoriesContent").classList.add("hidden");
        });

        document.getElementById("categoriesTab").addEventListener("click", function() {
            document.getElementById("categoriesContent").classList.remove("hidden");
            document.getElementById("productsContent").classList.add("hidden");
        });

        // Función para abrir el modal de agregar categoría
        document.getElementById("addCategoryBtn").addEventListener('click', function() {
            document.getElementById("addCategoryModal").classList.remove('hidden');
        });

        // Función para abrir el modal de agregar producto
        document.getElementById("addProductBtn").addEventListener('click', function() {
            document.getElementById("addProductModal").classList.remove('hidden');
        });
    </script>
@endsection
