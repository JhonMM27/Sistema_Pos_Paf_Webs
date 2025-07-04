@extends('layout.app')

@section('contenido')
    @push('estilos')
        <style>
            .product-card {
                transition: all 0.3s ease;
                border: 2px solid transparent;
            }

            .product-card:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
                border-color: #3b82f6;
            }

            .cart-item {
                animation: slideIn 0.3s ease-out;
            }

            @keyframes slideIn {
                from {
                    opacity: 0;
                    transform: translateX(-20px);
                }

                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            .barcode-input {
                font-size: 1.2rem;
                letter-spacing: 2px;
                font-weight: 600;
            }

            .barcode-input:focus {
                transform: scale(1.02);
                box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
            }

            .quantity-input {
                width: 80px;
                text-align: center;
                font-weight: 600;
            }

            .total-display {
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                color: white;
                font-weight: bold;
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            }

            .payment-method-btn {
                transition: all 0.3s ease;
                border: 2px solid transparent;
            }

            .payment-method-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            }

            .payment-method-btn.active {
                border-color: #3b82f6;
                background-color: #eff6ff;
                color: #1d4ed8;
            }

            .search-results {
                max-height: 300px;
                overflow-y: auto;
                z-index: 50;
            }

            .search-result-item {
                transition: background-color 0.2s ease;
            }

            .search-result-item:hover {
                background-color: #f3f4f6;
            }

            .stock-warning {
                animation: pulse 2s infinite;
            }

            @keyframes pulse {

                0%,
                100% {
                    opacity: 1;
                }

                50% {
                    opacity: 0.7;
                }
            }

            .barcode-input {
                font-size: 1.2rem;
                letter-spacing: 2px;
                font-weight: 600;
            }

            .barcode-input:focus {
                transform: scale(1.02);
                box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
            }

            .camera-scan-btn {
                margin-left: 0.5rem;
                background-color: #eff6ff;
                border: 1px solid #3b82f6;
                color: #1d4ed8;
                padding: 0.4rem 0.6rem;
                border-radius: 0.375rem;
                cursor: pointer;
            }

            .camera-scan-btn:hover {
                background-color: #dbeafe;
            }

            #cameraModal video {
                width: 100%;
                height: auto;
            }
        </style>
    @endpush

    <div class="w-full px-4 py-6">
        <main class="w-full px-4 md:px-6 py-6">
            <!-- Header -->
            <div class="mb-6">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-cash-register text-blue-600 text-3xl"></i>
                        <h1 class="text-3xl font-bold text-gray-900">Nueva Venta</h1>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('ventas.index') }}"
                            class="px-4 py-2 text-gray-600 hover:text-gray-800 transition-colors flex items-center">
                            <i class="fas fa-arrow-left mr-2"></i>Volver
                        </a>
                    </div>
                </div>
                <p class="text-gray-600 mt-2 ml-1 flex items-center"><i class="fas fa-info-circle mr-2"></i>Registra una nueva venta con escáner de código o cámara móvil</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column - Product Search and Cart -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Barcode Scanner Section -->
                    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-barcode mr-2 text-blue-600"></i> Lector de Códigos de Barras
                        </h2>
                        <div class="flex items-center gap-2">
                            <div class="relative flex-1">
                                <i class="fas fa-barcode absolute left-3 top-3 text-blue-300"></i>
                                <input type="text" id="barcodeInput"
                                    class="barcode-input w-full pl-10 px-4 py-3 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-center"
                                    placeholder="Escanea o ingresa el código de barras..." autocomplete="off">
                            </div>
                            <button type="button" id="openCameraBtn" class="camera-scan-btn hidden">
                                <i class="fas fa-camera"></i>
                            </button>
                        </div>
                        <p class="text-sm text-gray-500 mt-2 flex items-center">
                            <i class="fas fa-info-circle mr-1"></i>
                            El lector se activa automáticamente. Usa escáner físico o cámara en dispositivos móviles.
                        </p>
                    </div>

                    <!-- Product Search Section -->
                    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-search mr-2 text-green-600"></i>
                            Búsqueda de Productos
                        </h2>

                        <div class="relative">
                            <i class="fas fa-search absolute left-3 top-3 text-green-300"></i>
                            <input type="text" id="productSearchInput"
                                class="w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                placeholder="Busca productos por nombre, código o descripción..." autocomplete="off">

                            <!-- Search Results Dropdown -->
                            <div id="searchResults"
                                class="search-results absolute w-full bg-white border border-gray-200 rounded-lg shadow-lg mt-1 hidden">
                                <!-- Results will be populated here -->
                            </div>
                        </div>
                    </div>

                    <!-- Shopping Cart -->
                    <div class="bg-white rounded-xl shadow-md border border-gray-100">
                        <div class="p-6 border-b border-gray-200">
                            <h2 class="text-xl font-semibold text-gray-900 flex items-center">
                                <i class="fas fa-shopping-cart mr-2 text-purple-600"></i>
                                Carrito de Compras
                            </h2>
                        </div>

                        <div class="p-6">
                            <div id="cartItems" class="space-y-4">
                                <!-- Cart items will be populated here -->
                                <div class="text-center text-gray-500 py-8">
                                    <i class="fas fa-shopping-cart text-4xl mb-4"></i>
                                    <p class="text-lg font-medium">Carrito vacío</p>
                                    <p class="text-sm">Escanea productos para comenzar</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Customer and Payment -->
                <div class="space-y-6">
                    <!-- Customer Selection -->
                    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-user mr-2 text-indigo-600"></i>
                            Cliente
                        </h2>
                        <div class="space-y-4">
                            <div>
                                <label for="clienteSearchInput" class="block text-sm font-medium text-gray-700 mb-2 flex items-center"><i class="fas fa-user mr-1 text-indigo-300"></i>Buscar Cliente (DNI o Nombre)</label>
                                <div class="relative">
                                    <input type="text" id="clienteSearchInput" autocomplete="off"
                                        class="w-full pl-10 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                        placeholder="Escribe el nombre o DNI del cliente...">
                                    <i class="fas fa-search absolute left-3 top-3 text-indigo-300"></i>
                                    <div id="clienteSearchResults" class="absolute w-full bg-white border border-gray-200 rounded-lg shadow-lg mt-1 hidden z-20"></div>
                                    <input type="hidden" id="clienteSelect" name="cliente_id" value="">
                                </div>
                            </div>
                            <div class="text-center">
                                <span class="text-gray-500 text-sm">o</span>
                            </div>
                            <button id="registerClientBtn"
                                class="w-full px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors flex items-center justify-center gap-2">
                                <i class="fas fa-user-plus"></i>
                                Registrar Nuevo Cliente
                            </button>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-credit-card mr-2 text-green-600"></i>
                            Método de Pago
                        </h2>

                        <div class="grid grid-cols-1 gap-3">
                            <button
                                class="payment-method-btn p-4 border border-gray-200 rounded-lg text-left flex items-center gap-2"
                                data-method="efectivo">
                                <i class="fas fa-money-bill-wave text-green-600 text-xl"></i>
                                <div>
                                    <div class="font-medium">Efectivo</div>
                                    <div class="text-sm text-gray-500">Pago en efectivo</div>
                                </div>
                            </button>

                            <button
                                class="payment-method-btn p-4 border border-gray-200 rounded-lg text-left flex items-center gap-2"
                                data-method="tarjeta">
                                <i class="fas fa-credit-card text-blue-600 text-xl"></i>
                                <div>
                                    <div class="font-medium">Tarjeta</div>
                                    <div class="text-sm text-gray-500">Débito o crédito</div>
                                </div>
                            </button>

                            <button
                                class="payment-method-btn p-4 border border-gray-200 rounded-lg text-left flex items-center gap-2"
                                data-method="transferencia">
                                <i class="fas fa-university text-purple-600 text-xl"></i>
                                <div>
                                    <div class="font-medium">Transferencia</div>
                                    <div class="text-sm text-gray-500">Banca por internet</div>
                                </div>
                            </button>

                            <button
                                class="payment-method-btn p-4 border border-gray-200 rounded-lg text-left flex items-center gap-2"
                                data-method="yape">
                                <i class="fas fa-mobile-alt text-purple-700 text-xl"></i>
                                <div>
                                    <div class="font-medium">Yape</div>
                                    <div class="text-sm text-gray-500">Billetera digital</div>
                                </div>
                            </button>

                            <button
                                class="payment-method-btn p-4 border border-gray-200 rounded-lg text-left flex items-center gap-2"
                                data-method="plin">
                                <i class="fas fa-bolt text-blue-500 text-xl"></i>
                                <div>
                                    <div class="font-medium">Plin</div>
                                    <div class="text-sm text-gray-500">Billetera digital</div>
                                </div>
                            </button>
                        </div>
                    </div>

                    <!-- Total and Actions -->
                    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
                        <div class="space-y-4">
                            <div class="flex justify-between items-center text-lg font-medium">
                                <span><i class="fas fa-money-bill-wave text-green-400 mr-1"></i>Subtotal:</span>
                                <span id="subtotal">S/ 0.00</span>
                            </div>

                            <div class="flex justify-between items-center text-lg font-medium">
                                <span><i class="fas fa-percentage text-yellow-400 mr-1"></i>IGV (18%):</span>
                                <span id="igv">S/ 0.00</span>
                            </div>

                            <hr class="border-gray-200">

                            <div class="flex justify-between items-center text-2xl font-bold total-display p-4 rounded-lg">
                                <span><i class="fas fa-coins text-blue-200 mr-1"></i>TOTAL:</span>
                                <span id="total">S/ 0.00</span>
                            </div>

                            <div class="space-y-3">
                                <button id="completeSaleBtn"
                                    class="w-full px-6 py-3 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-colors flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed"
                                    disabled>
                                    <i class="fas fa-check"></i>
                                    Completar Venta
                                </button>

                                <button id="completeAndPrintSaleBtn"
                                    class="w-full px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed"
                                    disabled>
                                    <i class="fas fa-print"></i>
                                    Completar e Imprimir
                                </button>

                                <button id="saveAsPendingBtn"
                                    class="w-full px-6 py-3 bg-yellow-500 text-white font-medium rounded-lg hover:bg-yellow-600 transition-colors flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed"
                                    disabled>
                                    <i class="fas fa-save"></i>
                                    Guardar como Pendiente
                                </button>

                                <button id="cancelSaleBtn"
                                    class="w-full px-6 py-3 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition-colors flex items-center justify-center gap-2">
                                    <i class="fas fa-times"></i>
                                    Cancelar Venta
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>


    <!-- Modal para cámara -->
    <div id="cameraModal" class="fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center z-50 hidden transition-opacity duration-300">
        <div class="bg-white rounded-lg p-6 max-w-2xl w-full mx-4 md:mx-6 sm:mx-2 overflow-y-auto max-h-[90vh]">
            <button id="closeCameraBtn" class="absolute top-2 right-3 text-gray-500 hover:text-red-500">
                <i class="fas fa-times text-xl"></i>
            </button>
            <div id="cameraPreview"></div>
            <p class="text-center text-sm text-gray-600 mt-2">Escanea el código con la cámara</p>
        </div>
    </div>


    <!-- Register Client Modal -->
    <div id="registerClientModal" class="fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center z-50 hidden transition-opacity duration-300">
        <div class="bg-white rounded-lg p-6 max-w-2xl w-full mx-4 md:mx-6 sm:mx-2 overflow-y-auto max-h-[90vh]">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-semibold text-gray-900">Registrar Nuevo Cliente</h3>
                <button id="closeClientModal" aria-label="Cerrar modal" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <form id="clientForm" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="md:col-span-2">
                        <label for="clientName" class="block text-sm font-medium text-gray-700 mb-1">Nombre Completo
                            <span class="text-red-500">*</span></label>
                        <input type="text" id="clientName" name="name" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="clientEmail" class="block text-sm font-medium text-gray-700 mb-1">Correo Electrónico
                            <span class="text-red-500">*</span></label>
                        <input type="email" id="clientEmail" name="email" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="clientDocument" class="block text-sm font-medium text-gray-700 mb-1">Documento (DNI/RUC)</label>
                        <input type="text" id="clientDocument" name="documento"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="clientPhone" class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                        <input type="text" id="clientPhone" name="telefono"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div class="md:col-span-2">
                        <label for="clientAddress" class="block text-sm font-medium text-gray-700 mb-1">Dirección</label>
                        <input type="text" id="clientAddress" name="direccion"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4 border-t border-gray-200">
                    <button type="button" id="cancelClientBtn"
                        class="px-5 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">Cancelar</button>
                    <button type="submit"
                        class="px-5 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 flex items-center justify-center">
                        <i class="fas fa-save mr-2"></i>Registrar Cliente
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        const barcodeInput = document.getElementById('barcodeInput');
        const openCameraBtn = document.getElementById('openCameraBtn');
        const cameraModal = document.getElementById('cameraModal');
        const closeCameraBtn = document.getElementById('closeCameraBtn');
        const cameraPreview = document.getElementById('cameraPreview');

        // Mostrar botón cámara solo si es móvil y el navegador soporta HTTPS o es HTTP en Android
        if (/Mobi|Android|iPhone|iPad/i.test(navigator.userAgent)) {
            const isHttps = location.protocol === 'https:';
            const isAndroid = /Android/i.test(navigator.userAgent);
            openCameraBtn.classList.remove('hidden');

            if (isHttps || isAndroid) {
                openCameraBtn.classList.remove('hidden');
            } else {
                console.warn('La cámara solo está disponible por HTTPS o en HTTP desde Android.');
            }
        }

        openCameraBtn.addEventListener('click', () => {
            cameraModal.classList.remove('hidden');
            startCameraScanner();
        });

        closeCameraBtn.addEventListener('click', () => {
            cameraModal.classList.add('hidden');
            if (window.html5QrCodeScanner) {
                window.html5QrCodeScanner.stop().then(() => {
                    cameraPreview.innerHTML = "";
                });
            }
        });

        function startCameraScanner() {
            const html5QrCode = new Html5Qrcode("cameraPreview");
            window.html5QrCodeScanner = html5QrCode;

            Html5Qrcode.getCameras().then(devices => {
                if (devices && devices.length > 0) {
                    // Usa la cámara trasera si está disponible
                    const rearCamera = devices.find(device => /back|rear|environment/i.test(device.label)) ||
                        devices[0];

                    html5QrCode.start(
                        rearCamera.id, {
                            fps: 10,
                            qrbox: 250
                        },
                        (decodedText, decodedResult) => {
                            barcodeInput.value = decodedText;
                            barcodeInput.dispatchEvent(new KeyboardEvent('keypress', {
                                key: 'Enter'
                            }));
                            cameraModal.classList.add('hidden');
                            html5QrCode.stop().then(() => {
                                cameraPreview.innerHTML = "";
                            });
                        },
                        error => {
                            // Errores ignorados para evitar ruido visual
                        }
                    );
                } else {
                    alert('No se encontraron cámaras disponibles.');
                }
            }).catch(err => {
                console.error('Error al acceder a la cámara:', err);
                Swal.fire({
                    icon: 'error',
                    title: 'Cámara no disponible',
                    text: 'El navegador no permite acceder a la cámara en este contexto.'
                });
            });
        }
    </script>

    <script>
        // Global variables
        let cart = [];
        let selectedPaymentMethod = null;
        let selectedClientId = null;

        document.addEventListener('DOMContentLoaded', function() {
            // Debug info
            console.log('Usuario autenticado:', {{ Auth::check() ? 'true' : 'false' }});
            console.log('Ruta buscar producto:', '{{ route('api.pos.buscar-producto') }}');
            console.log('Ruta buscar productos:', '{{ route('api.pos.buscar-productos') }}');

            // Focus on barcode input for instant scanning
            document.getElementById('barcodeInput').focus();

            // Event listeners
            setupBarcodeScanner();
            setupProductSearch();
            setupPaymentMethods();
            setupClientSelection();
            setupClientModal();
            setupSaleActions();

            // --- Cliente autocompletar ---
            const clienteSearchInput = document.getElementById('clienteSearchInput');
            const clienteSearchResults = document.getElementById('clienteSearchResults');
            const clienteSelect = document.getElementById('clienteSelect');
            let clienteTimeout = null;
            clienteSearchInput.addEventListener('input', function() {
                const query = this.value.trim();
                if (query.length < 2) {
                    clienteSearchResults.innerHTML = '';
                    clienteSearchResults.classList.add('hidden');
                    clienteSelect.value = '';
                    return;
                }
                clearTimeout(clienteTimeout);
                clienteTimeout = setTimeout(() => {
                    fetch(`/api/pos/buscar-cliente?q=${encodeURIComponent(query)}`)
                        .then(res => res.json())
                        .then(data => {
                            if (data.length === 0) {
                                clienteSearchResults.innerHTML = '<div class="p-3 text-gray-500">No se encontraron clientes</div>';
                                clienteSearchResults.classList.remove('hidden');
                                return;
                            }
                            clienteSearchResults.innerHTML = data.map(cliente => `
                                <div class="p-3 hover:bg-indigo-50 cursor-pointer flex flex-col sm:flex-row sm:items-center gap-2 border-b last:border-b-0" data-id="${cliente.id}" data-nombre="${cliente.name}">
                                    <span class="font-semibold text-indigo-700">${cliente.name}</span>
                                    <span class="text-xs text-gray-500">DNI: ${cliente.documento || '-'}</span>
                                    <span class="text-xs text-gray-400">${cliente.email || ''}</span>
                                </div>
                            `).join('');
                            clienteSearchResults.classList.remove('hidden');
                        });
                }, 250);
            });
            clienteSearchResults.addEventListener('click', function(e) {
                const item = e.target.closest('[data-id]');
                if (item) {
                    clienteSearchInput.value = item.getAttribute('data-nombre');
                    clienteSelect.value = item.getAttribute('data-id');
                    clienteSearchResults.classList.add('hidden');
                }
            });
            document.addEventListener('click', function(e) {
                if (!clienteSearchResults.contains(e.target) && e.target !== clienteSearchInput) {
                    clienteSearchResults.classList.add('hidden');
                }
            });
        });

        // Barcode Scanner Setup
        function setupBarcodeScanner() {
            const barcodeInput = document.getElementById('barcodeInput');

            barcodeInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    const barcode = this.value.trim();
                    if (barcode) {
                        searchProductByBarcode(barcode);
                        this.value = '';
                    }
                }
            });

            // Smart auto-focus for continuous scanning
            document.body.addEventListener('click', function(e) {
                // A list of selectors for elements that should PREVENT the refocus
                const noRefocusSelectors = [
                    'input',
                    'select',
                    'button',
                    'a',
                    '.search-result-item', // Clicks on search results
                    '.cart-item', // Clicks within a cart item
                    '.swal2-container', // Clicks on SweetAlert modals
                ];

                // If the clicked element or any of its parents match the selectors, do not refocus.
                if (noRefocusSelectors.some(selector => e.target.closest(selector))) {
                    return;
                }

                // If the click is on the background, then focus.
                setTimeout(() => {
                    barcodeInput.focus();
                }, 100);
            });
        }

        // Product Search Setup
        function setupProductSearch() {
            const searchInput = document.getElementById('productSearchInput');
            const searchResults = document.getElementById('searchResults');
            let searchTimeout;

            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                const query = this.value.trim();

                if (query.length < 2) {
                    searchResults.classList.add('hidden');
                    return;
                }

                searchTimeout = setTimeout(() => {
                    searchProducts(query);
                }, 300);
            });

            // Hide results when clicking outside
            document.addEventListener('click', function(e) {
                if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                    searchResults.classList.add('hidden');
                }
            });
        }

        // Search product by barcode
        function searchProductByBarcode(barcode) {
            console.log('Buscando producto con código:', barcode);

            fetch(`/api/pos/buscar-producto?codigo=${encodeURIComponent(barcode)}`)
                .then(response => {
                    console.log('Response status:', response.status);

                    // Intentar leer la respuesta JSON primero
                    return response.json().then(data => {
                        // Si la respuesta no es exitosa, lanzar el error con el mensaje del servidor
                        if (!response.ok) {
                            throw new Error(data.message || `Error ${response.status}: ${response.statusText}`);
                        }
                        return data;
                    });
                })
                .then(data => {
                    console.log('Response data:', data);
                    if (data.success) {
                        addProductToCart(data.producto);
                        showNotification('Producto agregado al carrito', 'success');
                    } else {
                        showNotification(data.message || 'Error desconocido al buscar el producto', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error completo:', error);

                    // Mostrar mensaje específico del error
                    let mensajeError = 'Error al buscar producto';

                    if (error.message.includes('Producto no encontrado')) {
                        mensajeError = `❌ Código de barras "${barcode}" no encontrado en el sistema`;
                    } else if (error.message.includes('sin stock')) {
                        mensajeError = `⚠️ Producto sin stock disponible`;
                    } else if (error.message.includes('no disponible')) {
                        mensajeError = `🚫 Producto no disponible para venta`;
                    } else if (error.message.includes('Código de barras requerido')) {
                        mensajeError = `📝 Por favor, ingresa un código de barras válido`;
                    } else {
                        mensajeError = error.message;
                    }

                    showNotification(mensajeError, 'error');
                });
        }

        // Search products by term
        function searchProducts(query) {
            console.log('Buscando productos con término:', query);

            fetch(`/api/pos/buscar-productos?termino=${encodeURIComponent(query)}`)
                .then(response => {
                    console.log('Response status:', response.status);

                    // Intentar leer la respuesta JSON primero
                    return response.json().then(data => {
                        // Si la respuesta no es exitosa, lanzar el error con el mensaje del servidor
                        if (!response.ok) {
                            throw new Error(data.message || `Error ${response.status}: ${response.statusText}`);
                        }
                        return data;
                    });
                })
                .then(data => {
                    console.log('Response data:', data);
                    if (data.success) {
                        displaySearchResults(data.productos);
                    } else {
                        console.error('Error en respuesta:', data.message);
                        showNotification(data.message || 'Error al buscar productos', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error completo:', error);

                    // Mostrar mensaje específico del error
                    let mensajeError = 'Error al buscar productos';

                    if (error.message.includes('Término de búsqueda debe tener al menos 2 caracteres')) {
                        mensajeError = `📝 Ingresa al menos 2 caracteres para buscar`;
                    } else if (error.message.includes('No se encontraron productos')) {
                        mensajeError = `🔍 No se encontraron productos con "${query}"`;
                    } else {
                        mensajeError = error.message;
                    }

                    showNotification(mensajeError, 'error');
                });
        }

        // Display search results
        function displaySearchResults(products) {
            const searchResults = document.getElementById('searchResults');

            if (products.length === 0) {
                searchResults.innerHTML = '<div class="p-4 text-center text-gray-500">No se encontraron productos</div>';
            } else {
                searchResults.innerHTML = products.map(product => `
            <div class="search-result-item p-3 border-b border-gray-100 cursor-pointer hover:bg-gray-50" 
                 onclick="addProductToCart(${JSON.stringify(product).replace(/"/g, '&quot;')})">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="font-medium text-gray-900">${product.nombre}</div>
                        <div class="text-sm text-gray-500">${product.codigo_barras} - ${product.categoria}</div>
                    </div>
                    <div class="text-right">
                        <div class="font-semibold text-green-600">${product.precio_formateado}</div>
                        <div class="text-sm text-gray-500">Stock: ${product.stock}</div>
                    </div>
                </div>
            </div>
        `).join('');
            }

            searchResults.classList.remove('hidden');
        }

        // Add product to cart
        function addProductToCart(product) {
            const precio = parseFloat(product.precio);
            const existingItem = cart.find(item => item.id === product.id);

            if (existingItem) {
                existingItem.cantidad += 1;
                existingItem.subtotal = existingItem.cantidad * existingItem.precio_unitario;
            } else {
                cart.push({
                    id: product.id,
                    nombre: product.nombre,
                    codigo_barras: product.codigo_barras,
                    precio_unitario: precio,
                    cantidad: 1,
                    subtotal: precio,
                    stock: product.stock
                });
            }

            updateCartDisplay();
            updateTotals();
        }

        // Update cart display
        function updateCartDisplay() {
            const cartItems = document.getElementById('cartItems');

            if (cart.length === 0) {
                cartItems.innerHTML = `
            <div class="text-center text-gray-500 py-8">
                <i class="fas fa-shopping-cart text-4xl mb-4"></i>
                <p class="text-lg font-medium">Carrito vacío</p>
                <p class="text-sm">Escanea productos para comenzar</p>
            </div>
        `;
            } else {
                cartItems.innerHTML = cart.map((item, index) => `
            <div class="cart-item bg-gray-50 rounded-lg p-4 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <div class="font-medium text-gray-900">${item.nombre}</div>
                        
                        <div class="text-sm text-gray-600">S/ ${item.precio_unitario.toFixed(2)} c/u</div>
                        ${item.stock <= 10 ? '<div class="text-sm text-red-600 stock-warning"><i class="fas fa-exclamation-triangle mr-1"></i>Stock bajo</div>' : ''}
                    </div>
                    
                    <div class="flex items-center space-x-3">
                        <div class="flex items-center space-x-2">
                            <button onclick="updateQuantity(${index}, -1)" class="w-8 h-8 bg-red-500 text-white rounded-full flex items-center justify-center hover:bg-red-600 transition-colors">
                                <i class="fas fa-minus text-xs"></i>
                            </button>
                            <input type="number" value="${item.cantidad}" min="1" max="${item.stock}" 
                                   onchange="updateQuantityInput(${index}, this.value)"
                                   class="quantity-input border border-gray-300 rounded px-2 py-1">
                            <button onclick="updateQuantity(${index}, 1)" class="w-8 h-8 bg-green-500 text-white rounded-full flex items-center justify-center hover:bg-green-600 transition-colors">
                                <i class="fas fa-plus text-xs"></i>
                            </button>
                        </div>
                        
                        <div class="text-right">
                            <div class="font-semibold text-gray-900">S/ ${item.subtotal.toFixed(2)}</div>
                        </div>
                        
                        <button onclick="removeFromCart(${index})" class="text-red-600 hover:text-red-800 transition-colors">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        `).join('');
            }
        }

        // Update quantity
        function updateQuantity(index, change) {
            const item = cart[index];
            const newQuantity = item.cantidad + change;

            if (newQuantity >= 1 && newQuantity <= item.stock) {
                item.cantidad = newQuantity;
                item.subtotal = item.cantidad * item.precio_unitario;
                updateCartDisplay();
                updateTotals();
            }
        }

        // Update quantity input
        function updateQuantityInput(index, value) {
            const item = cart[index];
            const newQuantity = parseInt(value);

            if (newQuantity >= 1 && newQuantity <= item.stock) {
                item.cantidad = newQuantity;
                item.subtotal = item.cantidad * item.precio_unitario;
                updateCartDisplay();
                updateTotals();
            }
        }

        // Remove from cart
        function removeFromCart(index) {
            cart.splice(index, 1);
            updateCartDisplay();
            updateTotals();
        }

        // Update totals
        function updateTotals() {
            const subtotal = cart.reduce((sum, item) => sum + item.subtotal, 0);
            const igv = subtotal * 0.18;
            const total = subtotal + igv;

            document.getElementById('subtotal').textContent = `S/ ${subtotal.toFixed(2)}`;
            document.getElementById('igv').textContent = `S/ ${igv.toFixed(2)}`;
            document.getElementById('total').textContent = `S/ ${total.toFixed(2)}`;

            // Enable/disable action buttons
            const completeBtn = document.getElementById('completeSaleBtn');
            const completeAndPrintBtn = document.getElementById('completeAndPrintSaleBtn');
            const saveAsPendingBtn = document.getElementById('saveAsPendingBtn');

            const canComplete = cart.length > 0 && selectedPaymentMethod;
            const canSaveAsPending = cart.length > 0;

            completeBtn.disabled = !canComplete;
            completeAndPrintBtn.disabled = !canComplete;
            saveAsPendingBtn.disabled = !canSaveAsPending;
        }

        // Payment methods setup
        function setupPaymentMethods() {
            const paymentBtns = document.querySelectorAll('.payment-method-btn');

            paymentBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    paymentBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    selectedPaymentMethod = this.dataset.method;
                    updateTotals();
                });
            });
        }

        // Client selection setup
        function setupClientSelection() {
            const clienteSelect = document.getElementById('clienteSelect');

            clienteSelect.addEventListener('change', function() {
                selectedClientId = this.value || null;
            });
        }

        // Client modal setup
        function setupClientModal() {
            const modal = document.getElementById('registerClientModal');
            const openBtn = document.getElementById('registerClientBtn');
            const closeBtn = document.getElementById('closeClientModal');
            const cancelBtn = document.getElementById('cancelClientBtn');
            const form = document.getElementById('clientForm');

            openBtn.addEventListener('click', () => modal.classList.remove('hidden'));
            closeBtn.addEventListener('click', () => modal.classList.add('hidden'));
            cancelBtn.addEventListener('click', () => modal.classList.add('hidden'));

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);

                fetch('/api/pos/registrar-cliente', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content'),
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(Object.fromEntries(formData))
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showNotification(data.message, 'success');
                            modal.classList.add('hidden');
                            form.reset();

                            // Add new client to select
                            const select = document.getElementById('clienteSelect');
                            const option = new Option(
                                `${data.cliente.name} - ${data.cliente.documento || 'Sin documento'}`,
                                data.cliente.id
                            );
                            select.add(option);
                            select.value = data.cliente.id;
                            selectedClientId = data.cliente.id;
                        } else {
                            showNotification(data.message, 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showNotification('Error al registrar cliente', 'error');
                    });
            });
        }

        // Sale actions setup
        function setupSaleActions() {
            document.getElementById('completeSaleBtn').addEventListener('click', () => processSale('completada', false));
            document.getElementById('completeAndPrintSaleBtn').addEventListener('click', () => processSale('completada',
                true));
            document.getElementById('saveAsPendingBtn').addEventListener('click', () => processSale('pendiente'));
            document.getElementById('cancelSaleBtn').addEventListener('click', cancelSale);
        }

        // Process sale function (replaces completeSale)
        function processSale(estado, printAfter = false) {
            // Validations
            if (cart.length === 0) {
                showNotification('El carrito está vacío', 'error');
                return;
            }

            if (estado === 'completada' && !selectedPaymentMethod) {
                showNotification('Selecciona un método de pago para completar la venta', 'error');
                return;
            }

            const subtotal = cart.reduce((sum, item) => sum + item.subtotal, 0);
            const igv = subtotal * 0.18;
            const total = subtotal + igv;

            const saleData = {
                cliente_id: selectedClientId,
                metodo_pago: estado === 'completada' ? selectedPaymentMethod : null,
                total: total,
                estado: estado,
                productos: cart.map(item => ({
                    producto_id: item.id,
                    cantidad: item.cantidad,
                    precio_unitario: item.precio_unitario
                }))
            };

            // Show loading state
            const buttons = {
                complete: document.getElementById('completeSaleBtn'),
                print: document.getElementById('completeAndPrintSaleBtn'),
                pending: document.getElementById('saveAsPendingBtn')
            };
            const originalTexts = {
                complete: buttons.complete.innerHTML,
                print: buttons.print.innerHTML,
                pending: buttons.pending.innerHTML
            };

            Object.values(buttons).forEach(btn => {
                btn.disabled = true;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Procesando...';
            });

            fetch('{{ route('ventas.store') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(saleData)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const title = estado === 'completada' ? '¡Venta Completada!' : '¡Venta Guardada!';
                        Swal.fire({
                            icon: 'success',
                            title: title,
                            text: data.message,
                            confirmButtonText: 'Aceptar'
                        }).then(() => {
                            if (printAfter && data.venta_id) {
                                window.open(`/ventas/${data.venta_id}`, '_blank');
                            }
                            window.location.href = '{{ route('ventas.index') }}';
                        });
                    } else {
                        showNotification(data.message || 'Ocurrió un error', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Error al procesar la venta', 'error');
                })
                .finally(() => {
                    // Restore button states
                    buttons.complete.innerHTML = originalTexts.complete;
                    buttons.print.innerHTML = originalTexts.print;
                    buttons.pending.innerHTML = originalTexts.pending;
                    updateTotals();
                });
        }

        // Cancel sale
        function cancelSale() {
            Swal.fire({
                title: '¿Cancelar venta?',
                text: 'Se perderán todos los productos del carrito',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Sí, cancelar',
                cancelButtonText: 'Continuar'
            }).then((result) => {
                if (result.isConfirmed) {
                    resetSale();
                }
            });
        }

        // Reset sale
        function resetSale() {
            cart = [];
            selectedPaymentMethod = null;
            selectedClientId = null;

            // Reset UI
            document.getElementById('clienteSelect').value = '';
            document.querySelectorAll('.payment-method-btn').forEach(btn => btn.classList.remove('active'));
            updateCartDisplay();
            updateTotals();

            // Focus on barcode input
            document.getElementById('barcodeInput').focus();
        }

        // Show notification
        function showNotification(message, type) {
            Swal.fire({
                icon: type,
                title: type === 'success' ? '¡Éxito!' : '¡Error!',
                text: message,
                timer: type === 'success' ? 2000 : 3000,
                timerProgressBar: true,
                toast: true,
                position: 'top-end',
                showConfirmButton: false
            });
        }
    </script>
@endpush
