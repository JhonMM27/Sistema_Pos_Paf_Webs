@extends('layout.app')

@section('title', 'Nueva Compra')

@section('contenido')
    <div class="container mx-auto px-4 py-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 space-y-4 sm:space-y-0">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-shopping-cart text-purple-600 mr-3"></i>
                Nueva Compra
            </h1>
            <a href="{{ route('compras.index') }}"
                class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300 flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>
                Volver
            </a>
        </div>

        <!-- Mensajes de sesión -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                <strong>Error:</strong> {{ session('error') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <strong class="font-bold">Hay problemas con tu registro</strong>
                <ul class="list-disc list-inside mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario -->
        <form action="{{ route('compras.store') }}" method="POST" id="compraForm">
            @csrf
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
                <!-- Columna Izquierda -->
                <div class="xl:col-span-2 space-y-6">
                    <!-- Escáner de código de barras -->
                    <div class="bg-white rounded-xl shadow-md p-4 sm:p-6 border border-gray-100">
                        <h2 class="text-lg sm:text-xl font-semibold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-barcode mr-2 text-blue-600"></i>
                            Lector de Códigos de Barras
                        </h2>
                        <div class="flex items-center gap-2">
                            <div class="relative flex-1">
                                <input type="text" id="barcodeInput"
                                    class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-center"
                                    placeholder="Escanea o ingresa el código de barras..." autocomplete="off">
                            </div>
                            <button type="button" id="openCameraBtn" class="camera-scan-btn hidden">
                                <i class="fas fa-camera"></i>
                            </button>
                        </div>
                        <p class="text-sm text-gray-500 mt-2">
                            <i class="fas fa-info-circle mr-1"></i>
                            El lector se activa automáticamente. Usa escáner físico o cámara en dispositivos móviles.
                        </p>
                    </div>

                    <!-- Búsqueda de productos -->
                    <div class="bg-white rounded-xl shadow-md p-4 sm:p-6 border border-gray-100">
                        <h2 class="text-lg sm:text-xl font-semibold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-search mr-2 text-green-600"></i>
                            Búsqueda de Productos
                        </h2>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <div class="relative flex-grow">
                                <input type="text" id="productSearchInput"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                    placeholder="Busca productos por nombre..." autocomplete="off">
                                <div id="searchResults"
                                    class="absolute w-full bg-white border border-gray-200 rounded-lg shadow-lg mt-1 hidden z-10">
                                </div>
                            </div>
                            <button type="button" id="agregarProductoNuevoBtn"
                                class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300 flex items-center">
                                <i class="fas fa-plus mr-2"></i>
                                Producto Nuevo
                            </button>
                        </div>
                    </div>

                    <!-- Tabla de productos -->
                    <div class="bg-white rounded-lg shadow-md p-4 sm:p-6">
                        <h2 class="text-lg sm:text-xl font-semibold text-gray-800 mb-4">
                            <i class="fas fa-boxes text-purple-600 mr-2"></i>
                            Productos
                        </h2>
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm divide-y divide-gray-200" id="tablaProductos">
                                <thead class="bg-purple-50">
                                    <tr>
                                        <th
                                            class="px-4 py-3 text-left font-medium text-purple-700 uppercase tracking-wider">
                                            Producto</th>
                                        <th
                                            class="px-4 py-3 text-left font-medium text-purple-700 uppercase tracking-wider">
                                            Cantidad</th>
                                        <th
                                            class="px-4 py-3 text-left font-medium text-purple-700 uppercase tracking-wider">
                                            Precio Unit.</th>
                                        <th
                                            class="px-4 py-3 text-left font-medium text-purple-700 uppercase tracking-wider">
                                            Subtotal</th>
                                        <th
                                            class="px-4 py-3 text-left font-medium text-purple-700 uppercase tracking-wider">
                                            Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200" id="productosBody">
                                    <tr id="empty-row">
                                        <td colspan="5" class="text-center text-gray-500 py-8">
                                            <i class="fas fa-barcode text-4xl mb-4"></i>
                                            <p class="text-lg font-medium">Aún no hay productos</p>
                                            <p class="text-sm">Escanea un producto para comenzar</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Columna Derecha -->
                <div class="space-y-6">
                    <!-- Card de productos sin stock y críticos -->
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 rounded-lg shadow-md p-4 sm:p-6 mb-4">
                        <h2 class="text-lg font-semibold text-yellow-700 mb-2 flex items-center">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            Productos sin stock y críticos
                        </h2>
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-xs divide-y divide-gray-200">
                                <thead class="bg-yellow-100">
                                    <tr>
                                        <th class="px-2 py-1 text-left font-medium text-yellow-800 uppercase">Nombre</th>
                                        <th class="px-2 py-1 text-left font-medium text-yellow-800 uppercase">Stock</th>
                                        <th class="px-2 py-1 text-left font-medium text-yellow-800 uppercase">Compra</th>
                                        <th class="px-2 py-1 text-left font-medium text-yellow-800 uppercase">Venta</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($productosSinStock as $producto)
                                        <tr>
                                            <td class="px-2 py-1 text-red-700 font-semibold">{{ $producto->nombre }}</td>
                                            <td class="px-2 py-1 text-red-600 font-bold">{{ $producto->stock }}</td>
                                            <td class="px-2 py-1">S/ {{ number_format($producto->precio_compra, 2) }}</td>
                                            <td class="px-2 py-1">S/ {{ number_format($producto->precio, 2) }}</td>
                                        </tr>
                                    @endforeach
                                    @foreach($productosCriticos as $producto)
                                        @if($producto->stock > 0)
                                        <tr>
                                            <td class="px-2 py-1">{{ $producto->nombre }}</td>
                                            <td class="px-2 py-1">{{ $producto->stock }}</td>
                                            <td class="px-2 py-1">S/ {{ number_format($producto->precio_compra, 2) }}</td>
                                            <td class="px-2 py-1">S/ {{ number_format($producto->precio, 2) }}</td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-md p-4 sm:p-6">
                        <h2 class="text-lg sm:text-xl font-semibold text-gray-800 mb-4">
                            <i class="fas fa-info-circle text-purple-600 mr-2"></i>
                            Información de la Compra
                        </h2>
                        <div class="space-y-4">
                            <div>
                                <label for="proveedor_id" class="block text-sm font-medium text-gray-700 mb-1">Proveedor
                                    *</label>
                                <select name="proveedor_id" id="proveedor_id" required
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                                    <option value="">Seleccionar proveedor</option>
                                    @foreach ($proveedores as $proveedor)
                                        <option value="{{ $proveedor->id }}" data-ruc="{{ $proveedor->ruc_dni }}"
                                            data-telefono="{{ $proveedor->telefono }}">{{ $proveedor->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="fecha" class="block text-sm font-medium text-gray-700 mb-1">Fecha de Compra
                                    *</label>
                                <input type="date" name="fecha" id="fecha" required value="{{ date('Y-m-d') }}"
                                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-purple-500">
                            </div>
                            <div id="infoProveedor" class="hidden bg-gray-50 p-4 rounded-md">
                                <h3 class="font-medium text-gray-800 mb-2">Información del Proveedor</h3>
                                <p class="text-sm text-gray-600"><strong>RUC/DNI:</strong> <span id="rucProveedor"></span>
                                </p>
                                <p class="text-sm text-gray-600"><strong>Teléfono:</strong> <span
                                        id="telefonoProveedor"></span></p>
                            </div>
                        </div>
                    </div>

                    <!-- Total y botones -->
                    <div class="bg-white rounded-lg shadow-md p-4 sm:p-6">
                        <div class="flex flex-col space-y-4">
                            <div class="w-full bg-purple-50 p-4 rounded-lg">
                                <div class="text-xl sm:text-2xl font-bold text-purple-800 text-right">
                                    Total: $<span id="totalCompra">0.00</span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row justify-end gap-4">
                                <button type="button" onclick="window.location.href='{{ route('compras.index') }}'"
                                    class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 sm:px-6 rounded-lg transition duration-300">
                                    Cancelar
                                </button>
                                <button type="submit"
                                    class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 sm:px-6 rounded-lg transition duration-300">
                                    <i class="fas fa-save mr-2"></i>
                                    Guardar Compra
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <!-- Modal para agregar producto nuevo -->
    <div id="modalProductoNuevo"
        class="fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center z-50 hidden transition-opacity duration-300">
        <div class="bg-white rounded-lg p-6 max-w-2xl w-full mx-4 md:mx-6 sm:mx-2 overflow-y-auto max-h-[90vh]">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4 gap-2">
                <h3 class="text-lg font-semibold text-gray-800">Agregar Producto Nuevo</h3>
                <button id="cerrarModalNuevo" class="text-gray-500 hover:text-gray-700 self-end sm:self-auto">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="formProductoNuevo" class="space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="nombreProducto" class="block text-sm font-medium text-gray-700 mb-2">Nombre *</label>
                        <input type="text" id="nombreProducto" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2">
                    </div>
                    <div>
                        <label for="codigoProducto" class="block text-sm font-medium text-gray-700 mb-2">Código *</label>
                        <input type="text" id="codigoProducto" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2">
                    </div>
                    <div>
                        <label for="categoriaProducto" class="block text-sm font-medium text-gray-700 mb-2">Categoría
                            *</label>
                        <select id="categoriaProducto" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2">
                            <option value="">Seleccionar categoría</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="precioVentaProducto" class="block text-sm font-medium text-gray-700 mb-2">Precio de
                            Venta *</label>
                        <input type="number" id="precioVentaProducto" step="0.01" min="0" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2">
                    </div>
                    <div>
                        <label for="cantidadProducto" class="block text-sm font-medium text-gray-700 mb-2">Cantidad a
                            Comprar *</label>
                        <input type="number" id="cantidadProducto" min="1" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2">
                    </div>
                    <div>
                        <label for="precioCompraProducto" class="block text-sm font-medium text-gray-700 mb-2">Precio de
                            Compra *</label>
                        <input type="number" id="precioCompraProducto" step="0.01" min="0" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2">
                    </div>
                </div>
                <div>
                    <label for="descripcionProducto"
                        class="block text-sm font-medium text-gray-700 mb-2">Descripción</label>
                    <textarea id="descripcionProducto" rows="3" class="w-full border border-gray-300 rounded-md px-3 py-2"></textarea>
                </div>
                <div class="flex flex-col sm:flex-row justify-end sm:space-x-3 gap-3 pt-4">
                    <button type="button" id="cancelarProductoNuevo"
                        class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg w-full sm:w-auto">Cancelar</button>
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg w-full sm:w-auto">
                        <i class="fas fa-plus mr-2"></i>Agregar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal para cámara -->
    <div id="cameraModal" class="fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center z-50 hidden transition-opacity duration-300">
        <div class="bg-white rounded-lg p-6 max-w-2xl w-full mx-4 md:mx-6 sm:mx-2 overflow-y-auto max-h-[90vh] relative">
            <button id="closeCameraBtn" class="absolute top-2 right-3 text-gray-500 hover:text-red-500">
                <i class="fas fa-times text-xl"></i>
            </button>
            <div id="cameraPreview"></div>
            <p class="text-center text-sm text-gray-600 mt-2">Escanea el código con la cámara</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#34D399',
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: '¡Error!',
                text: '{{ session('error') }}',
                confirmButtonColor: '#F87171',
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            let errores = '';
            @foreach ($errors->all() as $error)
                errores += '<li class="text-left py-1">{{ $error }}</li>';
            @endforeach

            Swal.fire({
                icon: 'error',
                title: 'Errores de validación',
                html: `<ul class="list-disc pl-5">${errores}</ul>`,
                confirmButtonColor: '#F87171',
            });
        </script>
    @endif

    <script>
        let productos = [];
        let contadorProductos = 0;

        document.addEventListener('DOMContentLoaded', function() {
            const barcodeInput = document.getElementById('barcodeInput');
            const productSearchInput = document.getElementById('productSearchInput');
            const searchResults = document.getElementById('searchResults');

            const agregarProductoNuevoBtn = document.getElementById('agregarProductoNuevoBtn');
            const modalProductoNuevo = document.getElementById('modalProductoNuevo');
            const cerrarModalNuevo = document.getElementById('cerrarModalNuevo');
            const cancelarProductoNuevo = document.getElementById('cancelarProductoNuevo');
            const formProductoNuevo = document.getElementById('formProductoNuevo');

            barcodeInput.focus();

            barcodeInput.addEventListener('keypress', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    const codigo = this.value.trim();
                    if (codigo) {
                        buscarProductoPorCodigo(codigo, true);
                        this.value = '';
                    }
                }
            });

            productSearchInput.addEventListener('input', function() {
                const query = this.value.trim();
                if (query.length >= 2) {
                    buscarProductosPorNombre(query);
                } else {
                    searchResults.innerHTML = '';
                    searchResults.classList.add('hidden');
                }
            });

            agregarProductoNuevoBtn.addEventListener('click', () => modalProductoNuevo.classList.remove('hidden'));
            cerrarModalNuevo.addEventListener('click', () => modalProductoNuevo.classList.add('hidden'));
            cancelarProductoNuevo.addEventListener('click', () => modalProductoNuevo.classList.add('hidden'));
            modalProductoNuevo.addEventListener('click', function(e) {
                if (e.target === this) {
                    this.classList.add('hidden');
                }
            });

            formProductoNuevo.addEventListener('submit', function(e) {
                e.preventDefault();
                const productoNuevo = {
                    id: 'nuevo_' + Date.now(),
                    nombre: document.getElementById('nombreProducto').value,
                    codigo: document.getElementById('codigoProducto').value,
                    categoria_id: document.getElementById('categoriaProducto').value,
                    precio: document.getElementById('precioVentaProducto').value,
                    cantidad: document.getElementById('cantidadProducto').value,
                    precio_compra: document.getElementById('precioCompraProducto').value,
                    descripcion: document.getElementById('descripcionProducto').value,
                };
                agregarProductoATabla(productoNuevo, true);
                modalProductoNuevo.classList.add('hidden');
                this.reset();
            });

            const proveedorSelect = document.getElementById('proveedor_id');
            const infoProveedor = document.getElementById('infoProveedor');
            const rucProveedor = document.getElementById('rucProveedor');
            const telefonoProveedor = document.getElementById('telefonoProveedor');

            proveedorSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                if (this.value) {
                    rucProveedor.textContent = selectedOption.dataset.ruc;
                    telefonoProveedor.textContent = selectedOption.dataset.telefono;
                    infoProveedor.classList.remove('hidden');
                } else {
                    infoProveedor.classList.add('hidden');
                }
            });

            document.getElementById('compraForm').addEventListener('submit', function(e) {
                if (productos.length === 0) {
                    e.preventDefault();
                    alert('Debe agregar al menos un producto a la compra');
                    return false;
                }
                const proveedor = document.getElementById('proveedor_id').value;
                if (!proveedor) {
                    e.preventDefault();
                    alert('Debe seleccionar un proveedor');
                    return false;
                }
            });

            const openCameraBtn = document.getElementById('openCameraBtn');
            const cameraModal = document.getElementById('cameraModal');
            const closeCameraBtn = document.getElementById('closeCameraBtn');
            const cameraPreview = document.getElementById('cameraPreview');
            // Mostrar botón de cámara solo en dispositivos móviles
            if (window.innerWidth < 1024) {
                openCameraBtn.classList.remove('hidden');
            }
            openCameraBtn.addEventListener('click', function() {
                cameraModal.classList.remove('hidden');
                cameraPreview.innerHTML = "";
                if (window.html5QrCodeScanner) {
                    window.html5QrCodeScanner.stop().then(() => {
                        iniciarCamara();
                    }).catch(() => iniciarCamara());
                } else {
                    iniciarCamara();
                }
            });
            closeCameraBtn.addEventListener('click', function() {
                cameraModal.classList.add('hidden');
                if (window.html5QrCodeScanner) {
                    window.html5QrCodeScanner.stop().then(() => {
                        cameraPreview.innerHTML = "";
                    });
                } else {
                    cameraPreview.innerHTML = "";
                }
            });
            function iniciarCamara() {
                const html5QrCode = new Html5Qrcode("cameraPreview");
                window.html5QrCodeScanner = html5QrCode;
                Html5Qrcode.getCameras().then(devices => {
                    if (devices && devices.length) {
                        html5QrCode.start(
                            { facingMode: "environment" },
                            {
                                fps: 10,
                                qrbox: { width: 250, height: 250 }
                            },
                            (decodedText, decodedResult) => {
                                document.getElementById('barcodeInput').value = decodedText;
                                // Simular Enter para buscar producto
                                const event = new KeyboardEvent('keypress', { key: 'Enter' });
                                document.getElementById('barcodeInput').dispatchEvent(event);
                                cameraModal.classList.add('hidden');
                                html5QrCode.stop().then(() => {
                                    cameraPreview.innerHTML = "";
                                });
                            },
                            (errorMessage) => {
                                // console.log(errorMessage);
                            }
                        ).catch(err => {
                            cameraPreview.innerHTML = '<p class="text-red-500 text-center">No se pudo acceder a la cámara</p>';
                        });
                    } else {
                        cameraPreview.innerHTML = '<p class="text-red-500 text-center">No se encontró cámara disponible</p>';
                    }
                });
            }
        });

        function buscarProductoPorCodigo(codigo, exactMatch = false) {
            let query = `q=${encodeURIComponent(codigo)}`;
            if (exactMatch) query += '&exact=true';

            fetch(`/api/compras/buscar-producto?${query}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        const producto = data[0];
                        const productoExistente = productos.find(p => p.id === producto.id);

                        if (productoExistente) {
                            const row = document.getElementById(productoExistente.rowId);
                            const cantidadInput = row.querySelector('input[name*="[cantidad]"]');
                            cantidadInput.value = parseInt(cantidadInput.value) + 1;
                            calcularSubtotal(productoExistente.rowId);
                        } else {
                            agregarProductoATabla(producto);
                        }
                    } else {
                        alert('Producto no encontrado');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al buscar el producto.');
                });
        }

        function buscarProductosPorNombre(nombre) {
            fetch(`/api/compras/buscar-producto?q=${encodeURIComponent(nombre)}`)
                .then(response => response.json())
                .then(data => {
                    const searchResults = document.getElementById('searchResults');
                    searchResults.innerHTML = '';
                    if (data.length > 0) {
                        searchResults.classList.remove('hidden');
                        data.forEach(producto => {
                            const div = document.createElement('div');
                            div.className = 'p-3 hover:bg-gray-100 cursor-pointer';
                            div.textContent = `${producto.nombre} (${producto.codigo})`;
                            div.onclick = () => {
                                seleccionarProducto(producto);
                                searchResults.classList.add('hidden');
                                document.getElementById('productSearchInput').value = '';
                            };
                            searchResults.appendChild(div);
                        });
                    } else {
                        searchResults.classList.add('hidden');
                    }
                });
        }

        function seleccionarProducto(producto) {
            const productoExistente = productos.find(p => p.id === producto.id);
            if (productoExistente) {
                const row = document.getElementById(productoExistente.rowId);
                const cantidadInput = row.querySelector('input[name*="[cantidad]"]');
                cantidadInput.value = parseInt(cantidadInput.value) + 1;
                calcularSubtotal(productoExistente.rowId);
            } else {
                agregarProductoATabla(producto);
            }
        }

        function agregarProductoATabla(producto, esNuevo = false) {
            document.getElementById('empty-row')?.remove();

            contadorProductos++;
            const rowId = `row_producto_${contadorProductos}`;

            // Convertir precios a número para evitar errores
            const precioCompra = parseFloat(producto.precio_compra) || 0;
            const precioVenta = parseFloat(producto.precio) || 0;


            if (esNuevo) {
                // Lógica para un producto que no existe en la BD
                const nuevoProducto = {
                    id: producto.id, // ID temporal
                    esNuevo: true,
                    rowId: rowId
                };
                productos.push(nuevoProducto);

                const row = document.createElement('tr');
                row.id = rowId;
                row.innerHTML = `
                <td class="px-4 py-3">
                    <div>
                        <div class="font-medium text-gray-900">${producto.nombre}</div>
                        <div class="text-sm text-gray-500">${producto.codigo}</div>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            Nuevo
                        </span>
                    </div>
                    <input type="hidden" name="productos[${contadorProductos}][es_nuevo]" value="true">
                    <input type="hidden" name="productos[${contadorProductos}][nombre]" value="${producto.nombre}">
                    <input type="hidden" name="productos[${contadorProductos}][codigo]" value="${producto.codigo}">
                    <input type="hidden" name="productos[${contadorProductos}][categoria_id]" value="${producto.categoria_id}">
                    <input type="hidden" name="productos[${contadorProductos}][precio]" value="${precioVenta}">
                    <input type="hidden" name="productos[${contadorProductos}][descripcion]" value="${producto.descripcion || ''}">
                </td>
                <td class="px-4 py-3">
                    <input type="number" name="productos[${contadorProductos}][cantidad]" 
                            value="${producto.cantidad || 1}" min="1" step="1" required
                            class="w-20 border border-gray-300 rounded-md px-2 py-1 text-center"
                            oninput="calcularSubtotal('${rowId}')">
                </td>
                <td class="px-4 py-3">
                    <input type="number" name="productos[${contadorProductos}][precio_unitario]" 
                            value="${precioCompra}" min="0" step="0.01" required
                            class="w-24 border border-gray-300 rounded-md px-2 py-1 text-center"
                            oninput="calcularSubtotal('${rowId}')">
                </td>
                <td class="px-4 py-3">
                    <span class="font-medium text-gray-900" id="subtotal_${rowId}">$${(precioCompra * (producto.cantidad || 1)).toFixed(2)}</span>
                </td>
                <td class="px-4 py-3">
                    <button type="button" onclick="eliminarProducto('${rowId}', '${producto.id}')" 
                            class="text-red-600 hover:text-red-900">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            `;
                document.getElementById('productosBody').appendChild(row);

            } else {
                // Lógica para un producto existente
                const nuevoProducto = {
                    id: producto.id,
                    esNuevo: false,
                    rowId: rowId
                };
                productos.push(nuevoProducto);

                const row = document.createElement('tr');
                row.id = rowId;
                row.innerHTML = `
                <td class="px-4 py-3">
                    <div>
                        <div class="font-medium text-gray-900">${producto.nombre}</div>
                        <div class="text-sm text-gray-500">${producto.codigo}</div>
                    </div>
                    <input type="hidden" name="productos[${contadorProductos}][producto_id]" value="${producto.id}">
                     <input type="hidden" name="productos[${contadorProductos}][es_nuevo]" value="false">
                </td>
                <td class="px-4 py-3">
                    <input type="number" name="productos[${contadorProductos}][cantidad]" 
                            value="1" min="1" step="1" required
                            class="w-20 border border-gray-300 rounded-md px-2 py-1 text-center"
                            oninput="calcularSubtotal('${rowId}')">
                </td>
                <td class="px-4 py-3">
                    <input type="number" name="productos[${contadorProductos}][precio_unitario]" 
                            value="${precioCompra}" min="0" step="0.01" required
                            class="w-24 border border-gray-300 rounded-md px-2 py-1 text-center"
                            oninput="calcularSubtotal('${rowId}')">
                </td>
                <td class="px-4 py-3">
                    <span class="font-medium text-gray-900" id="subtotal_${rowId}">$${precioCompra.toFixed(2)}</span>
                </td>
                <td class="px-4 py-3">
                    <button type="button" onclick="eliminarProducto('${rowId}', ${producto.id})" 
                            class="text-red-600 hover:text-red-900">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            `;
                document.getElementById('productosBody').appendChild(row);
            }

            calcularTotal();
        }

        function calcularSubtotal(rowId) {
            const row = document.getElementById(rowId);
            const cantidad = parseFloat(row.querySelector('input[name*="[cantidad]"]').value) || 0;
            const precio = parseFloat(row.querySelector('input[name*="[precio_unitario]"]').value) || 0;
            const subtotal = cantidad * precio;

            document.getElementById(`subtotal_${rowId}`).textContent = `$${subtotal.toFixed(2)}`;
            calcularTotal();
        }

        function calcularTotal() {
            let total = 0;
            productos.forEach(p => {
                const row = document.getElementById(p.rowId);
                if (row) {
                    const subtotal = parseFloat(row.querySelector(`[id^="subtotal_"]`).textContent.replace('$',
                    ''));
                    total += subtotal;
                }
            });
            document.getElementById('totalCompra').textContent = total.toFixed(2);
        }

        function eliminarProducto(rowId, productoId) {
            const row = document.getElementById(rowId);
            row.remove();

            productos = productos.filter(p => p.id !== productoId && p.rowId !== rowId);

            if (productos.length === 0) {
                const tbody = document.getElementById('productosBody');
                tbody.innerHTML = `
                <tr id="empty-row">
                    <td colspan="5" class="text-center text-gray-500 py-8">
                        <i class="fas fa-barcode text-4xl mb-4"></i>
                        <p class="text-lg font-medium">Aún no hay productos</p>
                        <p class="text-sm">Escanea un producto para comenzar</p>
                    </td>
                </tr>`;
            }
            calcularTotal();
        }
    </script>
@endsection
