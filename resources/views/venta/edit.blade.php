@extends('layout.app')

@section('title', 'Editar Venta #' . $venta->id)

@push('estilos')
    <style>
        .product-card { transition: all 0.3s ease; border: 2px solid transparent; }
        .product-card:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15); border-color: #3b82f6; }
        .cart-item { animation: slideIn 0.3s ease-out; }
        @keyframes slideIn { from { opacity: 0; transform: translateX(-20px); } to { opacity: 1; transform: translateX(0); } }
        .quantity-input { width: 80px; text-align: center; font-weight: 600; }
        .total-display { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; font-weight: bold; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3); }
        .payment-method-btn { transition: all 0.3s ease; border: 2px solid transparent; }
        .payment-method-btn:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15); }
        .payment-method-btn.active { border-color: #3b82f6; background-color: #eff6ff; color: #1d4ed8; }
        .search-results { max-height: 300px; overflow-y: auto; z-index: 50; }
        .search-result-item { transition: background-color 0.2s ease; }
        .search-result-item:hover { background-color: #f3f4f6; }
    </style>
@endpush

@section('contenido')
<div class="w-full px-4 py-6">
    <main class="w-full px-4 md:px-6 py-6">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Editar Venta #{{ $venta->id }}</h1>
            <p class="text-gray-600 mt-2">Modifica los productos y finaliza la venta pendiente.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Columna Izquierda -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Búsqueda de Productos -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4 flex items-center"><i class="fas fa-search mr-2 text-green-600"></i> Búsqueda de Productos</h2>
                    <div class="relative">
                        <input type="text" id="productSearchInput" class="w-full px-4 py-3 border border-gray-300 rounded-lg" placeholder="Busca productos por nombre o código..." autocomplete="off">
                        <div id="searchResults" class="search-results absolute w-full bg-white border rounded-lg shadow-lg mt-1 hidden"></div>
                    </div>
                </div>

                <!-- Carrito de Compras -->
                <div class="bg-white rounded-xl shadow-md">
                    <div class="p-6 border-b"><h2 class="text-xl font-semibold"><i class="fas fa-shopping-cart mr-2 text-purple-600"></i> Carrito de Compras</h2></div>
                    <div class="p-6"><div id="cartItems" class="space-y-4"></div></div>
                </div>
            </div>

            <!-- Columna Derecha -->
            <div class="space-y-6">
                <!-- Cliente -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4"><i class="fas fa-user mr-2 text-indigo-600"></i> Cliente</h2>
                    <select id="clienteSelect" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                        <option value="">Cliente General</option>
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}" {{ $venta->cliente_id == $cliente->id ? 'selected' : '' }}>
                                {{ $cliente->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Método de Pago -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4"><i class="fas fa-credit-card mr-2 text-green-600"></i> Método de Pago</h2>
                    <div class="grid grid-cols-1 gap-3">
                        @foreach (['efectivo', 'tarjeta', 'transferencia', 'yape', 'plin'] as $metodo)
                            @php
                                $icons = ['efectivo' => 'fa-money-bill-wave', 'tarjeta' => 'fa-credit-card', 'transferencia' => 'fa-university', 'yape' => 'fa-mobile-alt', 'plin' => 'fa-bolt'];
                                $colors = ['efectivo' => 'text-green-600', 'tarjeta' => 'text-blue-600', 'transferencia' => 'text-purple-600', 'yape' => 'text-purple-700', 'plin' => 'text-blue-500'];
                            @endphp
                            <button class="payment-method-btn p-4 border rounded-lg text-left flex items-center" data-method="{{ $metodo }}">
                                <i class="fas {{ $icons[$metodo] }} {{ $colors[$metodo] }} text-xl mr-3"></i>
                                <div>
                                    <div class="font-medium">{{ ucfirst($metodo) }}</div>
                                </div>
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Total y Acciones -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="space-y-4">
                        <div class="flex justify-between text-lg"><span>Subtotal:</span><span id="subtotal">S/ 0.00</span></div>
                        <div class="flex justify-between text-lg"><span>IGV (18%):</span><span id="igv">S/ 0.00</span></div>
                        <hr>
                        <div class="flex justify-between text-2xl font-bold total-display p-4 rounded-lg"><span>TOTAL:</span><span id="total">S/ 0.00</span></div>
                        <div class="space-y-3 pt-2">
                            <button id="updateAndCompleteBtn" class="w-full px-6 py-3 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-colors flex items-center justify-center disabled:opacity-50" disabled>
                                <i class="fas fa-check mr-2"></i> Actualizar y Completar
                            </button>
                            <a href="{{ route('ventas.index') }}" class="block text-center w-full px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                                Cancelar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // --- VARIABLES GLOBALES ---
    let cart = [];
    let selectedPaymentMethod = null;
    let selectedClientId = "{{ $venta->cliente_id }}";

    // --- INICIALIZACIÓN ---
    document.addEventListener('DOMContentLoaded', function() {
        // Cargar carrito inicial
        @foreach ($venta->detalles as $detalle)
            cart.push({
                id: "{{ $detalle->producto_id }}",
                nombre: "{{ $detalle->producto->nombre }}",
                precio_unitario: parseFloat("{{ $detalle->precio_unitario }}"),
                cantidad: parseInt("{{ $detalle->cantidad }}"),
                subtotal: parseFloat("{{ $detalle->subtotal }}"),
                stock: parseInt("{{ $detalle->producto->stock }}") + parseInt("{{ $detalle->cantidad }}") // Stock actual + lo que estaba en esta venta
            });
        @endforeach

        setupEventListeners();
        updateCartDisplay();
        updateTotals();
    });

    function setupEventListeners() {
        // Búsqueda de productos
        const searchInput = document.getElementById('productSearchInput');
        searchInput.addEventListener('input', () => searchProducts(searchInput.value));

        // Selección de cliente
        document.getElementById('clienteSelect').addEventListener('change', (e) => {
            selectedClientId = e.target.value || null;
        });

        // Métodos de pago
        document.querySelectorAll('.payment-method-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.payment-method-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                selectedPaymentMethod = this.dataset.method;
                updateTotals();
            });
        });

        // Botón de actualizar
        document.getElementById('updateAndCompleteBtn').addEventListener('click', processUpdate);
    }
    
    // --- LÓGICA DE BÚSQUEDA ---
    function searchProducts(query) {
        const searchResultsEl = document.getElementById('searchResults');
        if (query.length < 2) {
            searchResultsEl.innerHTML = '';
            searchResultsEl.classList.add('hidden');
            return;
        }

        fetch(`/api/pos/buscar-productos?termino=${encodeURIComponent(query)}`)
            .then(response => {
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
                searchResultsEl.classList.remove('hidden');
                if (!data.success || data.productos.length === 0) {
                    searchResultsEl.innerHTML = '<div class="p-3 text-center text-gray-500">No se encontraron productos.</div>';
                    return;
                }
                searchResultsEl.innerHTML = data.productos.map(product => `
                    <div class="search-result-item p-3 flex justify-between items-center cursor-pointer border-b" onclick='addProductToCart(${JSON.stringify(product)})'>
                        <div>
                            <div class="font-medium">${product.nombre}</div>
                            <div class="text-sm text-gray-500">${product.codigo_barras}</div>
                        </div>
                        <div class="text-right">
                            <div class="font-semibold">S/ ${parseFloat(product.precio).toFixed(2)}</div>
                            <div class="text-xs ${product.stock > 10 ? 'text-green-500' : 'text-red-500'}">Stock: ${product.stock}</div>
                        </div>
                    </div>
                `).join('');
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
                searchResultsEl.classList.add('hidden');
            });
    }

    // --- LÓGICA DEL CARRITO ---
    function addProductToCart(product) {
        document.getElementById('productSearchInput').value = '';
        document.getElementById('searchResults').classList.add('hidden');

        const existingItem = cart.find(item => item.id === product.id);
        if (existingItem) {
            if (existingItem.cantidad < product.stock) {
                existingItem.cantidad++;
                existingItem.subtotal = existingItem.cantidad * existingItem.precio_unitario;
            } else {
                showNotification(`No hay más stock para ${product.nombre}.`, 'warning');
            }
        } else {
            if (product.stock > 0) {
                cart.push({
                    id: product.id,
                    nombre: product.nombre,
                    precio_unitario: parseFloat(product.precio),
                    cantidad: 1,
                    subtotal: parseFloat(product.precio),
                    stock: product.stock
                });
            } else {
                showNotification(`El producto ${product.nombre} está agotado.`, 'error');
            }
        }
        updateCartDisplay();
        updateTotals();
    }
    
    function updateQuantity(index, change) {
        const item = cart[index];
        const newQuantity = item.cantidad + change;
        if (newQuantity > 0 && newQuantity <= item.stock) {
            item.cantidad = newQuantity;
            item.subtotal = item.cantidad * item.precio_unitario;
        } else if (newQuantity > item.stock) {
            showNotification(`Stock máximo alcanzado para ${item.nombre}.`, 'warning');
        }
        if (newQuantity === 0) {
            removeFromCart(index);
        }
        updateCartDisplay();
        updateTotals();
    }

    function updateQuantityInput(index, value) {
        const item = cart[index];
        const newQuantity = parseInt(value);
        if (!isNaN(newQuantity) && newQuantity > 0) {
            if (newQuantity <= item.stock) {
                item.cantidad = newQuantity;
                item.subtotal = item.cantidad * item.precio_unitario;
            } else {
                item.cantidad = item.stock;
                item.subtotal = item.cantidad * item.precio_unitario;
                showNotification(`Stock máximo (${item.stock}) para ${item.nombre}.`, 'warning');
            }
        }
        updateCartDisplay();
        updateTotals();
    }

    function removeFromCart(index) {
        cart.splice(index, 1);
        updateCartDisplay();
        updateTotals();
    }
    
    // --- LÓGICA DE LA INTERFAZ ---
    function updateCartDisplay() {
        const cartItemsEl = document.getElementById('cartItems');
        if (cart.length === 0) {
            cartItemsEl.innerHTML = `<div class="text-center text-gray-500 py-8"><i class="fas fa-shopping-cart text-4xl mb-4"></i><p>Carrito vacío</p></div>`;
            return;
        }

        cartItemsEl.innerHTML = cart.map((item, index) => `
            <div class="cart-item bg-gray-50 rounded-lg p-4 border">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <div class="font-medium">${item.nombre}</div>
                        <div class="text-sm text-gray-600">S/ ${item.precio_unitario.toFixed(2)} c/u</div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="flex items-center space-x-2">
                            <button onclick="updateQuantity(${index}, -1)" class="w-8 h-8 bg-red-500 text-white rounded-full">&minus;</button>
                            <input type="number" value="${item.cantidad}" class="quantity-input border rounded px-2 py-1" onchange="updateQuantityInput(${index}, this.value)">
                            <button onclick="updateQuantity(${index}, 1)" class="w-8 h-8 bg-green-500 text-white rounded-full">&plus;</button>
                        </div>
                        <div class="text-right w-24 font-semibold">S/ ${item.subtotal.toFixed(2)}</div>
                        <button onclick="removeFromCart(${index})" class="text-red-600 hover:text-red-800"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
                ${item.cantidad >= item.stock ? `<div class="text-red-500 text-xs mt-2 font-bold stock-warning">Has alcanzado el stock máximo para este producto.</div>` : ''}
            </div>
        `).join('');
    }

    function updateTotals() {
        const subtotal = cart.reduce((sum, item) => sum + item.subtotal, 0);
        const igv = subtotal * 0.18;
        const total = subtotal + igv;
        document.getElementById('subtotal').textContent = `S/ ${subtotal.toFixed(2)}`;
        document.getElementById('igv').textContent = `S/ ${igv.toFixed(2)}`;
        document.getElementById('total').textContent = `S/ ${total.toFixed(2)}`;
        document.getElementById('updateAndCompleteBtn').disabled = cart.length === 0 || !selectedPaymentMethod;
    }

    // --- PROCESAMIENTO ---
    function processUpdate() {
        if (cart.length === 0) {
            showNotification('El carrito no puede estar vacío.', 'error');
            return;
        }
        if (!selectedPaymentMethod) {
            showNotification('Debes seleccionar un método de pago.', 'error');
            return;
        }

        const total = cart.reduce((sum, item) => sum + item.subtotal, 0) * 1.18;
        const saleData = {
            _method: 'PUT',
            cliente_id: selectedClientId,
            metodo_pago: selectedPaymentMethod,
            total: total,
            estado: 'completada',
            productos: cart.map(item => ({
                producto_id: item.id,
                cantidad: item.cantidad,
                precio_unitario: item.precio_unitario
            }))
        };

        const btn = document.getElementById('updateAndCompleteBtn');
        btn.disabled = true;
        btn.innerHTML = `<i class="fas fa-spinner fa-spin mr-2"></i> Procesando...`;

        fetch("{{ route('ventas.update', $venta->id) }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}",
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(saleData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Venta Actualizada!',
                    text: data.message,
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    window.location.href = "{{ route('ventas.index') }}";
                });
            } else {
                showNotification(data.message || 'Ocurrió un error.', 'error');
                btn.disabled = false;
                btn.innerHTML = `<i class="fas fa-check mr-2"></i> Actualizar y Completar`;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Error de conexión al actualizar la venta.', 'error');
            btn.disabled = false;
            btn.innerHTML = `<i class="fas fa-check mr-2"></i> Actualizar y Completar`;
        });
    }
    
    // --- FUNCIONES DE AYUDA ---
    function showNotification(message, type = 'info') {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
        Toast.fire({
            icon: type,
            title: message
        });
    }
</script>
@endpush