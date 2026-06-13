# 📚 Análisis Completo del Código - MarketPlacePlus

## 📋 Tabla de Contenidos

1. [Descripción General del Proyecto](#descripción-general-del-proyecto)
2. [Arquitectura y Stack Tecnológico](#arquitectura-y-stack-tecnológico)
3. [Modelos de Datos](#modelos-de-datos)
4. [Controladores](#controladores)
5. [Sistema de Rutas](#sistema-de-rutas)
6. [Migraciones de Base de Datos](#migraciones-de-base-de-datos)
7. [Flujos de Negocio](#flujos-de-negocio)
8. [Vistas y Templates](#vistas-y-templates)
9. [Seguridad y Autenticación](#seguridad-y-autenticación)

---

## Descripción General del Proyecto

**MarketPlacePlus** es una plataforma de marketplace desarrollada con **Laravel 13** que permite a usuarios registrados comprar y vender productos. La plataforma incluye un sistema de gestión de tratos (transacciones), calificaciones, comentarios y un panel administrativo para moderación.

### Características Principales:
- 🔐 **Sistema de Autenticación**: Registro e inicio de sesión de usuarios
- 📦 **Gestión de Productos**: Los vendedores pueden crear, editar y actualizar sus productos
- 💬 **Sistema de Tratos**: Negociación entre compradores y vendedores
- ⭐ **Calificaciones y Comentarios**: Los compradores pueden calificar al vendedor después de recibir el producto
- 🛡️ **Panel Administrativo**: Moderación de productos, usuarios, comentarios y banners
- 📊 **Dashboard**: Vendedores pueden ver sus productos, tratos y estado de suspensión

---

## Arquitectura y Stack Tecnológico

### Stack Utilizado:
```
Frontend:
├── Blade Templates (Laravel)
├── Tailwind CSS
└── JavaScript Vanilla/jQuery

Backend:
├── Laravel 13 (PHP)
├── MySQL (Base de Datos)
└── Vite (Build Tool)

Versionamiento:
└── Git (GitHub)
```

### Directorios Principales:
```
MarketPlacePlus/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/               # Controladores administrativos
│   │   │   ├── AuthController.php
│   │   │   ├── ProductController.php
│   │   │   ├── TratosController.php
│   │   │   └── CommentController.php
│   │   ├── Middleware/
│   │   └── Requests/
│   ├── Models/                       # Modelos Eloquent
│   ├── Mail/
│   └── Providers/
├── database/
│   ├── migrations/                   # Esquema de BD
│   └── factories/
├── resources/
│   └── views/                        # Templates Blade
├── routes/
│   └── web.php                       # Rutas de aplicación
├── config/                           # Configuración
└── storage/
```

---

## Modelos de Datos

### 1. **Modelo: User**
**Ubicación**: `app/Models/User.php`

**Propósito**: Representa a los usuarios del sistema (compradores, vendedores y administradores)

**Atributos Principales**:
```php
- id (PK)
- first_name        // Nombre
- last_name         // Apellido
- email             // Correo único
- password          // Contraseña hasheada
- phone             // Teléfono
- dob               // Fecha de nacimiento
- gender            // Género
- role              // 'user' o 'admin'
- is_active         // Boolean: usuario activo/suspendido
- email_verified_at // Timestamp de verificación
- remember_token    // Token para "recuérdame"
- timestamps        // created_at, updated_at
```

**Métodos Importantes**:
```php
public function getFullNameAttribute()      // Retorna "nombre apellido"
public function isAdmin()                   // Verifica si es administrador
public function isActive()                  // Verifica si está activo
public function suspend()                   // Suspende el usuario
public function reactivate()                // Reactiva el usuario
```

**Relaciones**:
```php
hasMany('products')  // Un usuario tiene muchos productos
```

**Constantes de Roles**:
```php
const ROLE_ADMIN = 'admin'   // Administrador
const ROLE_USER = 'user'     // Usuario regular
```

---

### 2. **Modelo: Product**
**Ubicación**: `app/Models/Product.php`

**Propósito**: Representa los productos puestos a la venta en el marketplace

**Atributos Principales**:
```php
- id (PK)
- user_id                    // FK: dueño del producto
- title                      // Título del producto
- category                   // Categoría (Electrónica, Ropa, etc.)
- location                   // Ubicación de venta
- description                // Descripción detallada
- price                      // Precio (decimal 2 decimales)
- image_path                 // JSON array de URLs de imágenes
- deleted_images_log         // JSON array: auditoría de imágenes eliminadas
- is_active                  // Boolean: activo/suspendido
- suspension_reason          // Razón de la suspensión (si aplica)
- condition                  // Condición del producto (nuevo, usado, etc.)
- tags                       // JSON array de etiquetas
- viewed_suspension_at       // Timestamp: cuándo el vendedor vio la suspensión
- reactivated_at             // Timestamp: cuándo se reactivó
- viewed_reactivation_at     // Timestamp: cuándo se vio la reactivación
- timestamps                 // created_at, updated_at
```

**Métodos Importantes**:
```php
public function needsSuspensionWarning()  // ¿Hay alerta de suspensión nueva?
public function suspend(string $reason)   // Suspende con motivo
public function reactivate()              // Reactiva el producto
```

**Relaciones**:
```php
belongsTo('user')            // El producto pertenece a un usuario
hasMany('comments')          // El producto tiene muchos comentarios (activos)
```

**Estados Principales**:
- `is_active = true`: Producto visible para compradores
- `is_active = false` + `suspension_reason`: Producto suspendido (con motivo)

---

### 3. **Modelo: Trato**
**Ubicación**: `app/Models/Trato.php`

**Propósito**: Representa una negociación/transacción entre un comprador y un vendedor

**Atributos Principales**:
```php
- id (PK)
- buyer_id                   // FK: quién compra
- seller_id                  // FK: quién vende
- product_id                 // FK: qué producto
- price                      // Precio acordado (puede cambiar)
- sku                        // Código de seguimiento único
- payment_method             // "Transferencia Bancaria", "Yape", etc.
- status                     // Estado actual del trato (ver abajo)
- timestamps                 // created_at, updated_at
```

**Estados del Trato** (máquina de estados):
```php
'pedido_realizado' => 1      // Comprador acaba de hacer el pedido
'en_discusion'     => 2      // Vendedor y comprador negocian
'aprobado'         => 3      // Vendedor aprobó, esperando pago
'recibido'         => 4      // Comprador recibió el producto
'cancelado'        => 0      // Trato cancelado
```

**Métodos Importantes**:
```php
public function cancel()                  // Cambia estado a 'cancelado'
public function getStatusLabelAttribute() // Retorna etiqueta legible (ej: "RECIBIDO")
```

**Relaciones**:
```php
belongsTo('buyer', 'buyer_id')        // Quién compra
belongsTo('seller', 'seller_id')      // Quién vende
belongsTo('product')                  // El producto del trato
```

**Constantes de Etiquetas**:
```php
const STATUS_LABELS = [
    'pedido_realizado' => 'PEDIDO REALIZADO',
    'en_discusion'     => 'EN DISCUSIÓN',
    'aprobado'         => 'APROBADO',
    'recibido'         => 'RECIBIDO',
    'cancelado'        => 'CANCELADO',
]
```

---

### 4. **Modelo: Comment**
**Ubicación**: `app/Models/Comment.php`

**Propósito**: Calificaciones y comentarios que dejan los compradores sobre los vendedores (después de recibir el producto)

**Atributos Principales**:
```php
- id (PK)
- user_id           // FK: quién escribió el comentario
- product_id        // FK: sobre qué producto
- content           // Texto del comentario
- rating            // Calificación (1-5 estrellas)
- is_active         // Boolean: visible/ocultado por admin
- timestamps        // created_at, updated_at
```

**Métodos Importantes**:
```php
public function hide()   // Oculta el comentario (es_activo = false)
public function show()   // Muestra el comentario (es_activo = true)
```

**Relaciones**:
```php
belongsTo('user')       // Quién escribió
belongsTo('product')    // Sobre qué producto
```

---

### 5. **Modelo: Banner**
**Ubicación**: `app/Models/Banner.php`

**Propósito**: Banners publicitarios en la página de inicio

**Atributos Principales**:
```php
- id (PK)
- title             // Título del banner
- description       // Descripción
- image_url         // URL o ruta de imagen
- link              // URL destino al clickear
- is_active         // Boolean: visible/oculto
- timestamps        // created_at, updated_at
```

---

### 6. **Modelo: Comprobante**
**Ubicación**: `app/Models/Comprobante.php`

**Propósito**: Comprobantes de venta/pago subidos por los compradores

**Atributos Principales**:
```php
- id (PK)
- trato_id          // FK: a qué trato pertenece
- file_path         // Ruta del archivo subido
- file_type         // Tipo de archivo (PDF, imagen, etc.)
- uploaded_at       // Cuándo se subió
- timestamps        // created_at, updated_at
```

---

## Controladores

### 1. **AuthController**
**Ubicación**: `app/Http/Controllers/AuthController.php`

**Responsabilidad**: Gestionar registro, login y logout de usuarios

#### Método: `showRegister()`
```php
- Retorna la vista de registro
- Si el usuario ya está autenticado, redirige al home
- Ruta: GET /register
```

#### Método: `register(RegisterRequest $request)`
```php
Validación:
├── first_name: requerido, string, máx 255
├── last_name: requerido, string, máx 255
├── email: requerido, email único
├── password: requerido, confirmación
├── phone: requerido
├── dob: requerido, fecha válida
└── gender: requerido

Acciones:
├── Crea nuevo usuario con contraseña hasheada
├── Redirecciona a login con mensaje de éxito
└── Ruta: POST /register
```

#### Método: `showLogin()`
```php
- Retorna vista de login
- Si ya está autenticado, redirige al home
- Ruta: GET /login
```

#### Método: `login(Request $request)`
```php
Validación:
├── email: requerido, email
└── password: requerido

Acciones:
├── Intenta autenticar con credenciales
├── Si es ADMIN → redirige a /admin/dashboard
├── Si es USER → redirige a /home
├── Si falla → retorna con error
└── Ruta: POST /login
```

#### Método: `logout(Request $request)`
```php
Acciones:
├── Cierra la sesión
├── Invalida sesión
├── Regenera token CSRF
└── Redirige a login
└── Ruta: POST /logout
```

---

### 2. **ProductController**
**Ubicación**: `app/Http/Controllers/ProductController.php`

**Responsabilidad**: Gestión de productos (CRUD) desde perspectiva del vendedor

#### Método: `show(Product $product)`
```php
- Muestra detalle público de un producto
- Si está desactivado: retorna 404
- Carga relación del vendedor
- Ruta: GET /products/{id}
```

#### Método: `create()`
```php
- Retorna formulario para crear producto
- Ruta: GET /seller/products/create
```

#### Método: `store(Request $request)`
```php
Validación:
├── title: requerido, string, máx 200
├── category: requerido, string
├── location: requerido, string
├── description: requerido, string, mín 20 caracteres
├── price: requerido, numérico, ≥ 0
└── image_path: requerido, array de imágenes (máx 5MB cada)

Acciones:
├── Almacena imágenes en storage/public/products/
├── Crea producto con user_id del autenticado
├── Establece is_active = true
└── Redirige con mensaje de éxito
└── Ruta: POST /seller/products
```

#### Método: `dashboard()`
```php
- Panel de vendedor con resumen
- Obtiene todos sus productos
- Obtiene producto suspendido (si existe)
- Obtiene producto reactivado no visto
- Ruta: GET /vendedor/panel
```

#### Método: `edit($id)`
```php
- Retorna formulario de edición
- Solo si el producto pertenece al usuario autenticado
- Ruta: GET /seller/products/{id}/edit
```

#### Método: `update(Request $request, $id)`
```php
Validación:
├── title, category, price, location: requeridos
├── image_path.*: imágenes opcionales (JPEG, PNG, máx 2MB)
└── removed_images: array de rutas a eliminar (lógicamente)

Proceso Importante:
├── 1️⃣ Obtiene imágenes activas actuales (JSON array)
├── 2️⃣ Obtiene log de eliminaciones (auditoría)
├── 3️⃣ Si hay removed_images:
│   ├── Las quita de activas
│   └── Las añade al log de auditoría
├── 4️⃣ Si hay nuevas imágenes:
│   ├── Las almacena en storage
│   └── Las añade al array de activas
├── 5️⃣ Guarda cambios con array_values() para resetear índices
└── Ruta: PUT /seller/products/{id}

⚠️ Nota: NO borra física de storage, solo marca como inactiva (auditoría)
```

#### Método: `acknowledge($id)`
```php
- Marca que el vendedor vio la notificación de suspensión
- Actualiza viewed_suspension_at = now()
- Ruta: POST /seller/products/{id}/acknowledge
```

#### Método: `acknowledgeReactivation($id)`
```php
- Marca que el vendedor vio la notificación de reactivación
- Actualiza viewed_reactivation_at = now()
- Ruta: POST /seller/products/{id}/acknowledge-reactivation
```

---

### 3. **TratosController**
**Ubicación**: `app/Http/Controllers/TratosController.php`

**Responsabilidad**: Gestión de tratos (transacciones) entre compradores y vendedores

#### Método: `show(Trato $trato)`
```php
- Muestra detalle de un trato para el COMPRADOR
- Seguridad: solo si auth()->id() === trato->buyer_id
- Carga producto y vendedor
- Ruta: GET /tratos/{id}
```

#### Método: `index()`
```php
- Lista todos los tratos donde el usuario es COMPRADOR
- Paginación: 10 por página
- Eager loads: producto y vendedor (evita N+1)
- Ordenado por más reciente
- Ruta: GET /tratos
```

#### Método: `sellerShow(Trato $trato)`
```php
- Muestra detalle de un trato para el VENDEDOR
- Seguridad: solo si auth()->id() === trato->seller_id
- Carga producto y comprador
- Ruta: GET /vendedor/tratos/{id}
```

#### Método: `sellerIndex()`
```php
- Lista todos los tratos donde el usuario es VENDEDOR
- Paginación: 10 por página
- Eager loads: producto y comprador
- Calcula conteos por estado (para filtros)
- Ruta: GET /vendedor/tratos
```

---

### 4. **CommentController**
**Ubicación**: `app/Http/Controllers/CommentController.php`

**Responsabilidad**: Crear calificaciones y comentarios

#### Método: `store(Request $request, Trato $trato)`
```php
- Solo comprador puede comentar (al recibir producto)
- Crea Comment con:
  ├── user_id: del autenticado
  ├── product_id: del producto del trato
  ├── content: comentario
  ├── rating: calificación (1-5)
  └── is_active: true (por defecto)
- Ruta: POST /tratos/{id}/calificar
```

---

### 5. **ComprobantesController**
**Ubicación**: `app/Http/Controllers/ComprobantesController.php`

**Responsabilidad**: Subir comprobantes de pago

#### Método: `index()`
```php
- Lista comprobantes del usuario autenticado
- Ruta: GET /mis-comprobantes
```

#### Método: `store(Request $request, Trato $trato)`
```php
- Almacena comprobante de pago del comprador
- Valida:
  ├── file: requerido, PDF o imagen
  └── máx: 5MB
- Ruta: POST /tratos/{id}/comprobante
```

---

### 6. **AdminProductController**
**Ubicación**: `app/Http/Controllers/AdminProductController.php`

**Responsabilidad**: Gestión administrativa de productos

#### Principales Métodos:
```php
index()                           // Lista todos productos
create()                          // Formulario crear
store(Request $request)           // Guardar nuevo
edit(Product $product)            // Formulario editar
update(Request $request, P)       // Guardar cambios
destroy(Product $product)         // Eliminar
updateStatus(Product $product)    // Cambiar estado
suspend(Product $product)         // Suspender + email
```

#### Método: `suspend(Product $product)`
```php
- Suspende un producto
- Envía email al vendedor con motivo
- Usa mailable: ProductSuspendedMail
- Ruta: POST /admin/products/{id}/suspend
```

---

### 7. **Controladores Administrativos**
**Ubicación**: `app/Http/Controllers/Admin/`

#### **BannerController**
- `index()`: Lista banners
- `create()`: Formulario crear
- `store()`: Guardar
- `edit()`: Formulario editar
- `update()`: Actualizar
- `destroy()`: Eliminar

#### **UserController**
- `index()`: Lista usuarios con conteos
- `updateRole()`: Cambiar rol (user/admin)

#### **CommentController** (Admin)
- `index()`: Lista todos comentarios
- `toggle()`: Activar/desactivar comentario

#### **AdminDashboardController**
- `index()`: Dashboard con estadísticas
  - Conteo de usuarios
  - Conteo de productos
  - Productos activos/inactivos
  - Últimos tratos
  - Últimos comentarios

---

## Sistema de Rutas

**Archivo**: `routes/web.php`

### Estructura de Rutas:

#### **🌐 Rutas Públicas**
```
GET  /                           → HomeController@index           (Home)
GET  /register                   → AuthController@showRegister    (Formulario registro)
POST /register                   → AuthController@register         (Procesar registro)
GET  /login                      → AuthController@showLogin        (Formulario login)
POST /login                      → AuthController@login            (Procesar login)
POST /logout                     → AuthController@logout           (Cerrar sesión)
GET  /proximamente               → View('proximamente')            (Página en construcción)
```

#### **🔐 Rutas Autenticadas (Usuario)**
```
Productos:
GET  /products/{id}              → ProductController@show         (Ver detalle)
GET  /seller/products/create     → ProductController@create       (Crear producto)
POST /seller/products            → ProductController@store        (Guardar producto)
GET  /seller/products/{id}/edit  → ProductController@edit         (Editar producto)
PUT  /seller/products/{id}       → ProductController@update       (Guardar cambios)
POST /seller/products/{id}/acknowledge 
                                 → ProductController@acknowledge  (Marcar suspensión vista)
POST /seller/products/{id}/acknowledge-reactivation
                                 → ProductController@acknowledgeReactivation (Marcar reactivación vista)

Panel Vendedor:
GET  /vendedor/panel             → ProductController@dashboard    (Panel de vendedor)

Tratos:
GET  /tratos                     → TratosController@index         (Mis compras)
GET  /tratos/{id}                → TratosController@show          (Detalle compra)
POST /tratos/{id}/calificar      → CommentController@store        (Calificar vendedor)
GET  /vendedor/tratos            → TratosController@sellerIndex   (Mis ventas)
GET  /vendedor/tratos/{id}       → TratosController@sellerShow    (Detalle venta)

Comprobantes:
GET  /mis-comprobantes           → ComprobantesController@index   (Mis comprobantes)
POST /tratos/{id}/comprobante    → ComprobantesController@store   (Subir comprobante)

Alternativas:
GET  /crear-producto             → View('create-product')         (Vista alternativa)
```

#### **👨‍💼 Rutas Administrativas** (prefix: `/admin`, middleware: `auth`, `admin`)
```
Dashboard:
GET  /admin/dashboard            → AdminDashboardController@index (Dashboard admin)

Productos:
GET    /admin/products           → AdminProductController@index   (Lista productos)
GET    /admin/products/create    → AdminProductController@create  (Crear)
POST   /admin/products           → AdminProductController@store   (Guardar)
GET    /admin/products/{id}/edit → AdminProductController@edit    (Editar)
PUT    /admin/products/{id}      → AdminProductController@update  (Guardar)
DELETE /admin/products/{id}      → AdminProductController@destroy (Eliminar)
POST   /admin/products/{id}/status → AdminProductController@updateStatus (Cambiar estado JS)
POST   /admin/products/{id}/suspend → AdminProductController@suspend (Suspender + email)

Banners:
GET    /admin/banners            → BannerController@index         (Lista)
GET    /admin/banners/create     → BannerController@create        (Crear)
POST   /admin/banners            → BannerController@store         (Guardar)
GET    /admin/banners/{id}/edit  → BannerController@edit          (Editar)
PUT    /admin/banners/{id}       → BannerController@update        (Guardar)
DELETE /admin/banners/{id}       → BannerController@destroy       (Eliminar)

Usuarios:
GET    /admin/users              → UserController@index           (Lista)
PUT    /admin/users/{id}/role    → UserController@updateRole      (Cambiar rol)

Comentarios:
GET    /admin/comments           → AdminCommentController@index   (Lista)
PATCH  /admin/comments/{id}/toggle → AdminCommentController@toggle (Activar/desactivar)
```

---

## Migraciones de Base de Datos

**Ubicación**: `database/migrations/`

### Estructura del Schema:

#### **tabla: users** (2026_01_01_000000)
```sql
CREATE TABLE users (
    id BIGINT PRIMARY KEY,
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255),
    phone VARCHAR(20),
    dob DATE,
    gender VARCHAR(50),
    role VARCHAR(50) DEFAULT 'user',
    is_active BOOLEAN DEFAULT true,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

#### **tabla: banners** (2026_01_01_000002)
```sql
CREATE TABLE banners (
    id BIGINT PRIMARY KEY,
    title VARCHAR(255),
    description TEXT,
    image_url VARCHAR(255),
    link VARCHAR(255),
    is_active BOOLEAN DEFAULT true,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

#### **tabla: products** (2026_01_01_000003)
```sql
CREATE TABLE products (
    id BIGINT PRIMARY KEY,
    user_id BIGINT FOREIGN KEY → users(id),
    title VARCHAR(255),
    category VARCHAR(255),
    location VARCHAR(255),
    description LONGTEXT,
    price DECIMAL(10,2),
    image_path JSON,                    // Array de URLs
    deleted_images_log JSON NULL,       // Auditoría
    is_active BOOLEAN DEFAULT true,
    suspension_reason TEXT NULL,
    condition VARCHAR(255),
    tags JSON,                          // Array de tags
    viewed_suspension_at TIMESTAMP NULL,
    reactivated_at TIMESTAMP NULL,
    viewed_reactivation_at TIMESTAMP NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

#### **tabla: tratos** (2026_06_11_000003)
```sql
CREATE TABLE tratos (
    id BIGINT PRIMARY KEY,
    buyer_id BIGINT FOREIGN KEY → users(id),
    seller_id BIGINT FOREIGN KEY → users(id),
    product_id BIGINT FOREIGN KEY → products(id),
    price DECIMAL(10,2),
    sku VARCHAR(255),
    payment_method VARCHAR(255),    // "Transferencia", "Yape", etc.
    status VARCHAR(50),             // Estados máquina
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

#### **tabla: comments** (2026_06_07_022419)
```sql
CREATE TABLE comments (
    id BIGINT PRIMARY KEY,
    user_id BIGINT FOREIGN KEY → users(id),
    product_id BIGINT FOREIGN KEY → products(id),
    content TEXT,
    rating INT (1-5),
    is_active BOOLEAN DEFAULT true,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

#### **tabla: comprobantes** (no encontrada en datos, pero se referencia)
```sql
CREATE TABLE comprobantes (
    id BIGINT PRIMARY KEY,
    trato_id BIGINT FOREIGN KEY → tratos(id),
    file_path VARCHAR(255),
    file_type VARCHAR(50),
    uploaded_at TIMESTAMP,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

---

## Flujos de Negocio

### 1️⃣ **Flujo: Registro e Inicio de Sesión**

```
Usuario no autenticado
    ↓
GET /register
    ↓
[Formulario de Registro]
    ├─ Nombre, Apellido
    ├─ Email
    ├─ Teléfono
    ├─ Fecha de nacimiento
    ├─ Género
    └─ Contraseña
    ↓
POST /register (AuthController@register)
    ├─ Validación
    ├─ Hash de contraseña
    ├─ Crear registro User
    └─ Redirigir a login
    ↓
GET /login
    ↓
[Formulario de Login]
    ├─ Email
    └─ Contraseña
    ↓
POST /login (AuthController@login)
    ├─ Validación
    ├─ Intentar autenticar
    ├─ Si es ADMIN → /admin/dashboard
    └─ Si es USER → /home
```

---

### 2️⃣ **Flujo: Crear y Vender Producto**

```
Usuario autenticado (Vendedor)
    ↓
GET /seller/products/create
    ↓
[Formulario Crear Producto]
    ├─ Título (máx 200)
    ├─ Categoría
    ├─ Ubicación
    ├─ Descripción (mín 20)
    ├─ Precio
    └─ Imágenes (array, máx 5MB)
    ↓
POST /seller/products (ProductController@store)
    ├─ Validación completa
    ├─ Almacenar imágenes en storage/products/
    ├─ Crear Product con is_active = true
    └─ Mensaje: "¡Producto publicado!"
    ↓
GET /vendedor/panel (Dashboard)
    ├─ Lista de productos
    ├─ Alertas de suspensión
    └─ Alertas de reactivación
    ↓
GET /seller/products/{id}/edit
    ↓
[Formulario Editar]
    ├─ Modificar datos
    ├─ Añadir nuevas imágenes
    └─ Marcar imágenes para eliminar (lógica, no física)
    ↓
PUT /seller/products/{id} (ProductController@update)
    ├─ Validación
    ├─ Actualizar imágenes activas
    ├─ Guardar en log de eliminadas
    └─ Guardar cambios
```

---

### 3️⃣ **Flujo: Comprar Producto**

```
Usuario autenticado (Comprador)
    ↓
GET / (HomeController@index)
    ├─ Muestra productos activos
    └─ Banners si existen
    ↓
GET /products/{id} (ProductController@show)
    ├─ Detalle completo
    ├─ Datos del vendedor
    ├─ Comentarios (solo activos)
    └─ [Botón para hacer trato/negociar]
    ↓
[Crea un Trato - Acción en JS/Blade]
    ├─ buyer_id = usuario autenticado
    ├─ seller_id = dueño del producto
    ├─ product_id = producto actual
    ├─ price = precio propuesto
    ├─ status = 'pedido_realizado'
    └─ Crea: Trato::create(...)
    ↓
GET /tratos (TratosController@index)
    ├─ Lista todos donde buyer_id = auth
    └─ Paginado
    ↓
GET /tratos/{id} (TratosController@show)
    ├─ Detalle del trato
    ├─ Estado actual
    ├─ Datos del vendedor
    ├─ Opción para subir comprobante
    └─ Cuando status = 'recibido', opción de calificar
    ↓
POST /tratos/{id}/comprobante (ComprobantesController@store)
    ├─ Sube comprobante de pago
    └─ Vinculado al trato
```

---

### 4️⃣ **Flujo: Vendedor Negocia Tratos**

```
Vendedor autenticado
    ↓
GET /vendedor/tratos (TratosController@sellerIndex)
    ├─ Lista todos donde seller_id = auth
    ├─ Filtros por estado
    ├─ Conteos por estado
    └─ Paginado
    ↓
GET /vendedor/tratos/{id} (TratosController@sellerShow)
    ├─ Detalle del trato
    ├─ Estado actual
    ├─ Datos del comprador
    ├─ Opción para cambiar estado
    └─ Chat/Mensajes (si está implementado)
    ↓
[Cambiar estado del trato - via JS/Blade]
    ├─ pedido_realizado → en_discusion (responder)
    ├─ en_discusion → aprobado (aceptar)
    ├─ aprobado → recibido (marcar como enviado/recibido)
    └─ Cualquier → cancelado (cancelar)
    ↓
POST /tratos/{id}/[update-status] (TratosController update)
    └─ Actualiza status en BD
```

---

### 5️⃣ **Flujo: Calificar y Comentar**

```
Comprador (después de recibir)
    ↓
GET /tratos/{id} (con status = 'recibido')
    ├─ Ver opción: "Calificar al vendedor"
    └─ Formulario con:
        ├─ Rating (1-5 estrellas)
        └─ Comentario (texto)
    ↓
POST /tratos/{id}/calificar (CommentController@store)
    ├─ Validación
    ├─ Crear Comment
    ├─ is_active = true (por defecto)
    └─ Mostrar: "Gracias por tu comentario"
    ↓
GET /products/{id} (ProductController@show)
    ├─ Mostrar comentarios activos
    └─ Mostrar rating promedio (si existe)
```

---

### 6️⃣ **Flujo: Suspender Producto (Admin)**

```
Admin en /admin/products
    ↓
[Click en botón "Suspender" de un producto]
    ↓
POST /admin/products/{id}/suspend (AdminProductController@suspend)
    ├─ Validación: solo admin
    ├─ product.is_active = false
    ├─ product.suspension_reason = "Razón escrita"
    ├─ Enviar email a vendedor (ProductSuspendedMail)
    └─ viewed_suspension_at = null
    ↓
GET /vendedor/panel (ProductController@dashboard)
    ├─ Mostrar alerta: "Tu producto fue suspendido"
    ├─ Mostrar motivo
    └─ Botón: "He leído el aviso"
    ↓
POST /seller/products/{id}/acknowledge
    ├─ viewed_suspension_at = now()
    └─ Alerta desaparece
    ↓
[Si admin REACTIVA el producto]
    ├─ product.is_active = true
    ├─ product.suspension_reason = null
    ├─ product.reactivated_at = now()
    └─ viewed_reactivation_at = null
    ↓
GET /vendedor/panel
    ├─ Mostrar alerta: "Tu producto fue reactivado"
    └─ Botón: "He leído el aviso"
    ↓
POST /seller/products/{id}/acknowledge-reactivation
    ├─ viewed_reactivation_at = now()
    └─ Alerta desaparece
```

---

### 7️⃣ **Flujo: Moderar Comentarios (Admin)**

```
Admin en /admin/comments
    ↓
[Lista de todos los comentarios]
    ├─ Mostrar usuario que comentó
    ├─ Mostrar contenido
    ├─ Mostrar producto
    └─ Botón: Toggle (visible/oculto)
    ↓
PATCH /admin/comments/{id}/toggle (AdminCommentController@toggle)
    ├─ is_active = !is_active
    └─ Guarda cambios
    ↓
GET /products/{id} (ProductController@show)
    ├─ Muestra solo comentarios donde is_active = true
    └─ Oculta comentarios desactivados
```

---

## Vistas y Templates

**Ubicación**: `resources/views/`

### Estructura de Vistas:

```
resources/views/
├── layouts/
│   ├── app.blade.php             // Layout principal
│   └── admin.blade.php           // Layout admin
├── auth/
│   ├── register.blade.php        // Formulario registro
│   └── login.blade.php           // Formulario login
├── home.blade.php                // Homepage
├── products/
│   └── show.blade.php            // Detalle producto
├── seller/
│   ├── panel.blade.php           // Dashboard vendedor
│   ├── create-product.blade.php  // Crear producto
│   ├── products/
│   │   └── edit.blade.php        // Editar producto
│   └── tratos/
│       ├── index.blade.php       // Mis ventas
│       └── show.blade.php        // Detalle venta
├── tratos/
│   ├── index.blade.php           // Mis compras
│   └── show.blade.php            // Detalle compra
├── admin/
│   ├── dashboard.blade.php       // Dashboard admin
│   ├── products/
│   │   ├── index.blade.php       // Lista productos
│   │   ├── create.blade.php      // Crear
│   │   └── edit.blade.php        // Editar
│   ├── banners/
│   │   ├── index.blade.php
│   │   ├── create.blade.php
│   │   └── edit.blade.php
│   ├── users/
│   │   └── index.blade.php
│   └── comments/
│       └── index.blade.php
└── proximamente.blade.php        // Página en construcción
```

---

## Seguridad y Autenticación

### 🔒 **Middleware de Seguridad**

#### **AdminMiddleware**
**Ubicación**: `app/Http/Middleware/AdminMiddleware.php`

```php
Verifica:
├─ Usuario autenticado
└─ Usuario tiene role = 'admin'

Si falla:
└─ Retorna 403 Forbidden
```

**Uso en rutas**:
```php
Route::middleware(['auth', 'admin'])->group(function () {
    // Solo accesibles para admins
});
```

### **Protected Routes**

```
🌐 PÚBLICAS (sin auth):
├─ GET  /
├─ GET  /register
├─ POST /register
├─ GET  /login
├─ POST /login
└─ GET  /proximamente

🔐 AUTENTICADAS (auth):
├─ Todas las rutas bajo middleware ['auth']
├─ GET  /products/{id}
├─ GET  /seller/products/*
├─ GET  /tratos*
└─ POST /tratos/*

👨‍💼 ADMINISTRATIVAS (auth + admin):
└─ Todas las rutas bajo /admin/*
```

### **Validación de Propiedad**

```php
// Productos: Solo el dueño puede editar
$product = Product::where('user_id', auth()->id())->findOrFail($id);

// Tratos: Solo buyer o seller pueden ver
abort_if($trato->buyer_id !== auth()->id(), 403);
abort_if($trato->seller_id !== auth()->id(), 403);
```

### **Casteos de Seguridad**

```php
// Contraseñas hasheadas
protected function casts(): array {
    return [
        'password' => 'hashed',  // Laravel hash automático
    ];
}

// Precios como decimales (evitar problemas de flotante)
protected $casts = [
    'price' => 'decimal:2',
];
```

---

## 📊 Diagrama de Relaciones

```
┌─────────────────────────────────────────────┐
│                   USERS                      │
│  (id, email, password, role, is_active)     │
└──────────────┬──────────────────────────────┘
               │
        ┌──────┴──────┬──────────────┐
        │             │              │
   ┌────▼─────┐  ┌───▼────┐  ┌─────▼────┐
   │ PRODUCTS  │  │ COMMENTS  │  │ TRATOS │
   │ (FK user) │  │(FK user)  │  │(FK buyer,│
   └──────────┘  └────┬────┘  │ seller) │
                 │(FK product)│ └──┬───┘
                 │             │   │
            ┌────▼────────┐   │   │
            │  BANNERS    │   │   │
            │ (publicidad) │   │   │
            └─────────────┘   │   │
                          ┌───▼───▼─┐
                          │COMPROBANTES│
                          │(FK trato) │
                          └──────────┘
```

---

## 🎯 Casos de Uso Principales

| Caso de Uso | Usuario | Descripción |
|---|---|---|
| **Registrarse** | Público | Crear cuenta en marketplace |
| **Login** | Público | Iniciar sesión |
| **Crear Producto** | Vendedor | Publicar producto para vender |
| **Editar Producto** | Vendedor | Actualizar datos del producto |
| **Ver Productos** | Comprador | Listar y buscar productos |
| **Hacer Trato** | Comprador | Crear negociación con vendedor |
| **Negociar Trato** | Vendedor | Cambiar estado del trato |
| **Subir Comprobante** | Comprador | Evidencia de pago |
| **Calificar Vendedor** | Comprador | Dejar comentario y rating |
| **Ver Dashboard** | Vendedor | Resumen de productos y tratos |
| **Suspender Producto** | Admin | Moderar contenido inapropiado |
| **Moderar Comentarios** | Admin | Activar/desactivar comentarios |
| **Gestionar Usuarios** | Admin | Cambiar roles, desactivar |
| **Crear Banners** | Admin | Publicidad en homepage |

---

## 📝 Notas Importantes

### ✅ Buenas Prácticas Implementadas:

1. **Eloquent Relations**: Uso correcto de belongsTo y hasMany
2. **Eager Loading**: `.with()` para evitar N+1 queries
3. **Validación**: Request classes y validación en controlador
4. **Seguridad**: 
   - Verificación de propiedad (usuario puede solo ver sus datos)
   - Roles de usuario (admin vs user)
   - Contraseñas hasheadas
5. **Soft Deletes Simulados**: En lugar de eliminar, marca como inactivo
6. **Auditoría**: Log de imágenes eliminadas para tracking
7. **Máquina de Estados**: Tratos con estados definidos
8. **Timestamps**: Tracking de cuándo se vio suspensión/reactivación

### ⚠️ Consideraciones de Escalabilidad:

1. **JSON Arrays**: Usado para imágenes y tags. Considerar tabla relacional si crece
2. **Paginación**: Implementada (10 items por página)
3. **Indexes**: Asegurar indexes en FK (user_id, product_id, etc.)
4. **Caché**: Considerar cachear banners y productos populares

---

## 🚀 Comandos Útiles para Desarrollo

```bash
# Instalar dependencias
composer install

# Ejecutar migraciones
php artisan migrate

# Crear usuario admin
php artisan tinker
> User::create([...])

# Ver rutas
php artisan route:list

# Ejecutar servidor
php artisan serve

# Queue (si se usa para emails)
php artisan queue:work
```

---

**Documento generado**: Junio 2026
**Versión del Proyecto**: MarketPlacePlus
**Framework**: Laravel 13
**Base de Datos**: MySQL
