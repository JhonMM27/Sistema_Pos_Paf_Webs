# Sistema POS - Tecnologías Web

## 📋 Descripción

Sistema de Punto de Venta (POS) desarrollado en Laravel 12 para la gestión integral de un negocio comercial. El sistema incluye módulos completos para ventas, compras, inventario, clientes, proveedores, reportes y configuración de usuarios.

## 🚀 Características Principales

### 🔐 Autenticación y Autorización
- Sistema de login seguro con Laravel
- Control de acceso basado en roles y permisos (Spatie Laravel Permission)
- Roles disponibles: Administrador, Manager, Vendedor, Cliente
- Middleware de autenticación en todas las rutas protegidas

### 💰 Gestión de Ventas
- **Interfaz POS moderna** con búsqueda de productos en tiempo real
- **Múltiples métodos de pago**: Efectivo, Tarjeta, Transferencia, Yape, Plin
- **Gestión de clientes** integrada con registro rápido
- **Control de stock** automático al procesar ventas
- **Estados de venta**: Pendiente, Completada, Anulada
- **Historial completo** de transacciones

### 🛒 Gestión de Compras
- **Registro de compras** a proveedores
- **Control de inventario** automático
- **Múltiples estados**: Pendiente, Completada, Cancelada
- **Historial de compras** con detalles completos

### 📦 Gestión de Inventario
- **Productos** con códigos de barras, categorías y precios
- **Control de stock** en tiempo real
- **Categorías** organizadas
- **Precios de compra y venta** separados
- **Alertas de stock bajo**

### 👥 Gestión de Clientes y Proveedores
- **Base de datos de clientes** con información completa
- **Gestión de proveedores** con tipos categorizados
- **Historial de transacciones** por cliente/proveedor

### 📊 Reportes y Análisis
- **Reporte de ventas** con filtros por fecha
- **Reporte de compras** detallado
- **Análisis de ganancias** y márgenes
- **Reporte de inventario** con valorización
- **Exportación a PDF** de todos los reportes
- **Gráficos interactivos** con Chart.js

### 🔄 Devoluciones
- **Sistema de devoluciones** completo
- **Control de stock** en devoluciones
- **Historial de devoluciones** por venta

### ⚙️ Configuración del Sistema
- **Gestión de usuarios** con roles y permisos
- **Configuración general** del negocio
- **Tipos de usuario** personalizables

## 🛠️ Tecnologías Utilizadas

### Backend
- **Laravel 12** - Framework PHP
- **PHP 8.2+** - Lenguaje de programación
- **MySQL/PostgreSQL** - Base de datos
- **Spatie Laravel Permission** - Control de roles y permisos
- **Barryvdh DomPDF** - Generación de PDFs
- **PhpSpreadsheet** - Exportación a Excel

### Frontend
- **Tailwind CSS 4** - Framework CSS
- **Alpine.js** - JavaScript reactivo
- **Chart.js** - Gráficos interactivos
- **SweetAlert2** - Alertas y notificaciones
- **Font Awesome** - Iconografía
- **Vite** - Build tool

### Herramientas de Desarrollo
- **Laravel Sail** - Entorno de desarrollo Docker
- **Laravel Pint** - Formateo de código
- **Pest** - Testing framework
- **Laravel Pail** - Debugging

## 📁 Estructura del Proyecto

```
Sistema_POS_Tecno_Web/
├── app/
│   ├── Http/Controllers/     # Controladores del sistema
│   ├── Models/              # Modelos Eloquent
│   ├── Http/Requests/       # Validaciones de formularios
│   └── Providers/           # Proveedores de servicios
├── database/
│   ├── migrations/          # Migraciones de base de datos
│   └── seeders/            # Datos de prueba
├── resources/
│   └── views/              # Vistas Blade
├── routes/
│   └── web.php             # Rutas de la aplicación
├── config/                 # Archivos de configuración
└── public/                 # Archivos públicos
```

## 🗄️ Base de Datos

### Tablas Principales
- **users** - Usuarios del sistema
- **productos** - Catálogo de productos
- **categorias** - Categorías de productos
- **ventas** - Registro de ventas
- **detalle_ventas** - Detalles de cada venta
- **compras** - Registro de compras
- **detalle_compras** - Detalles de cada compra
- **clientes** - Base de datos de clientes
- **proveedores** - Base de datos de proveedores
- **devoluciones** - Registro de devoluciones
- **configuracions** - Configuración del sistema

### Relaciones Clave
- Usuarios → Ventas (vendedor)
- Usuarios → Ventas (cliente)
- Productos → DetalleVentas
- Productos → DetalleCompras
- Ventas → Devoluciones

## 🚀 Instalación

### Requisitos Previos
- PHP 8.2 o superior
- Composer
- Node.js y npm
- Base de datos MySQL/PostgreSQL

### Pasos de Instalación

1. **Clonar el repositorio**
```bash
git clone [URL_DEL_REPOSITORIO]
cd Sistema_POS_Tecno_Web
```

2. **Instalar dependencias PHP**
```bash
composer install
```

3. **Instalar dependencias Node.js**
```bash
npm install
```

4. **Configurar variables de entorno**
```bash
cp .env.example .env
php artisan key:generate
```

5. **Configurar base de datos en .env**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sistema_pos
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_password
```

6. **Ejecutar migraciones**
```bash
php artisan migrate
```

7. **Ejecutar seeders (datos de prueba)**
```bash
php artisan db:seed
```

8. **Compilar assets**
```bash
npm run build
```

9. **Iniciar servidor de desarrollo**
```bash
php artisan serve
```

## 👤 Usuarios de Prueba

### Administrador
- **Email**: admin@pos.com
- **Password**: password
- **Rol**: Administrador

### Vendedor
- **Email**: vendedor@pos.com
- **Password**: password
- **Rol**: Vendedor

## 🔧 Configuración

### Permisos del Sistema
El sistema utiliza Spatie Laravel Permission con los siguientes permisos:

- **Ventas**: crear, listar, editar, eliminar, anular, ver
- **Compras**: crear, listar, editar, eliminar, ver
- **Productos**: crear, listar, editar, eliminar
- **Categorías**: crear, listar, editar, eliminar
- **Clientes**: crear, listar, editar, eliminar, ver
- **Proveedores**: crear, listar, editar, eliminar, ver
- **Reportes**: ver, exportar
- **Usuarios**: crear, listar, editar, eliminar

### Roles Predefinidos
- **Administrador**: Acceso completo al sistema
- **Manager**: Gestión de ventas, compras, inventario y reportes
- **Vendedor**: Solo gestión de ventas y clientes
- **Cliente**: Solo visualización de sus propias transacciones

## 📊 Funcionalidades por Módulo

### Dashboard
- Resumen de ventas del día
- Productos con stock bajo
- Gráficos de rendimiento
- Acceso rápido a funciones principales

### Ventas
- Interfaz POS moderna
- Búsqueda de productos por código o nombre
- Registro rápido de clientes
- Múltiples métodos de pago
- Control automático de stock
- Impresión de tickets

### Inventario
- Gestión completa de productos
- Categorización
- Control de stock
- Precios de compra y venta
- Códigos de barras

### Reportes
- Ventas por período
- Compras por período
- Análisis de ganancias
- Productos más vendidos
- Exportación a PDF/Excel

## 🔒 Seguridad

- **Autenticación** con Laravel
- **Autorización** basada en roles y permisos
- **Validación** de formularios
- **Protección CSRF**
- **Sanitización** de datos
- **Logs** de auditoría

## 📱 Responsive Design

El sistema está completamente optimizado para:
- **Desktop** (1024px+)
- **Tablet** (768px - 1023px)
- **Mobile** (320px - 767px)

## 🚀 Comandos Útiles

```bash
# Ejecutar migraciones
php artisan migrate

# Ejecutar seeders
php artisan db:seed

# Limpiar cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Crear usuario administrador
php artisan make:user

# Generar reportes
php artisan report:generate
```

## 📝 Licencia

Este proyecto está bajo la Licencia MIT. Ver el archivo `LICENSE` para más detalles.

## 👥 Contribución

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📞 Soporte

Para soporte técnico o preguntas sobre el sistema, contacta al equipo de desarrollo.

---

**Desarrollado con ❤️ usando Laravel 12 y Tailwind CSS**
