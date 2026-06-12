# Documentación Técnica - MarketPlacePlus
## Refactorización: Implementación de Soft Delete Global

**Última actualización:** 12 de Junio de 2026  
**Versión:** 2.0.0  
**Estado:** Producción

---

## 📋 Tabla de Contenidos

1. [Introducción](#introducción)
2. [Arquitectura General](#arquitectura-general)
3. [Cambios en Base de Datos](#cambios-en-base-de-datos)
4. [Cambios en Modelos](#cambios-en-modelos)
5. [Cambios en Controladores](#cambios-en-controladores)
6. [Cambios en Vistas](#cambios-en-vistas)
7. [Patrones y Mejores Prácticas](#patrones-y-mejores-prácticas)
8. [Ejemplos de Uso](#ejemplos-de-uso)
9. [Migración de Datos](#migración-de-datos)
10. [Guía de Mantenimiento](#guía-de-mantenimiento)

---

## Introducción

### Contexto y Propósito

El proyecto MarketPlacePlus ha sido refactorizado para implementar una **política global de Soft Delete**, lo que significa que los registros nunca se eliminan físicamente de la base de datos, sino que se marcan como "inactivos" o "suspendidos".

### Razones Principales

1. **Auditoría y Cumplimiento**: Mantener un historial completo de todos los datos para propósitos de auditoría regulatoria
2. **Recuperación de Datos**: Posibilidad de reactivar registros si se toma una decisión incorrecta
3. **Integridad Referencial**: Evitar errores por claves foráneas huérfanas
4. **Cumplimiento Legal**: Algunos marcos regulatorios requieren mantener datos históricos
5. **Análisis**: Datos históricos necesarios para análisis de negocio

### Excepciones Permitidas

- **Imágenes**: Las imágenes del almacenamiento SÍ pueden eliminarse, pero el registro en BD se conserva
- **Logs**: Los archivos de log pueden limpiarse regularmente

---

## Arquitectura General

### Diagrama de Relaciones

```
Users (is_active)
  ├── Products (is_active, suspension_reason)
  │   ├── Comments (is_active)
  │   └── Tratos (status: cancelado/pendiente/completado)
  └── Banners (is_active)
```

### Flujo de Suspensión

```
Usuario/Admin solicita eliminación
        ↓
Controller captura la solicitud
        ↓
Model aplica suspend() o reactivate()
        ↓
BD actualiza campo is_active = false/true
        ↓
Redirecciona con mensaje de éxito
        ↓
Datos conservados en BD para auditoría
```

---

## Cambios en Base de Datos

### Migración: add_is_active_to_users_table.php

**Ubicación:** `database/migrations/2026_06_12_140000_add_is_active_to_users_table.php`

**Código:**
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->after('role');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
    }
};
```

**Explicación:**
- **`boolean('is_active')`**: Crea un campo booleano para rastrear si el usuario está activo
- **`default(true)`**: Por defecto todos los usuarios nuevos están activos
- **`after('role')`**: Se coloca después de la columna 'role' para mantener orden lógico
- **`dropColumn()`**: Permite revertir la migración si es necesario

**Importancia:**
- Proporciona el mecanismo de base de datos para el soft delete de usuarios
- Mantiene compatibilidad con registros anteriores (todos inician en true)

### Campos Existentes en Otros Modelos

| Tabla | Campos | Propósito |
|-------|--------|----------|
| `users` | `is_active` | Activar/Desactivar usuarios |
| `products` | `is_active`, `suspension_reason` | Suspender publicaciones con motivo |
| `banners` | `is_active` | Activar/Desactivar banners |
| `comments` | `is_active` | Ocultar/Mostrar comentarios |
| `tratos` | `status` | Estado del trato (cancelado, pendiente, completado) |

---

## Cambios en Modelos

### User Model

**Ubicación:** `app/Models/User.php`

**Adiciones:**

```php
// En $fillable
protected $fillable = [
    'first_name',
    'last_name',
    'email',
    'password',
    'phone',
    'dob',
    'gender',
    'role',
    'is_active',  // ← NUEVO
];

// En casts()
protected function casts(): array
{
    return [
        'email_verified_at' => 'datetime',
        'dob'               => 'date',
        'password'          => 'hashed',
        'is_active'         => 'boolean',  // ← NUEVO
    ];
}

// Métodos nuevos para soft delete
public function isActive(): bool
{
    return $this->is_active;
}

public function suspend(): void
{
    $this->update(['is_active' => false]);
}

public function reactivate(): void
{
    $this->update(['is_active' => true]);
}
```

**Explicación:**

| Elemento | Propósito |
|----------|-----------|
| `'is_active'` en `$fillable` | Permite asignación masiva del campo |
| `'is_active' => 'boolean'` en `casts()` | Convierte automáticamente a booleano en BD |
| `isActive()` | Método helper para verificar si el usuario está activo |
| `suspend()` | Desactiva el usuario (soft delete) |
| `reactivate()` | Reactiva el usuario |

**Importancia:**
- Define el comportamiento estándar para desactivación de usuarios
- Proporciona métodos reutilizables en todo el código

### Product Model

**Ubicación:** `app/Models/Product.php`

**Adiciones:**

```php
public function suspend(string $reason = null): void
{
    $this->update([
        'is_active' => false,
        'suspension_reason' => $reason,
    ]);
}

public function reactivate(): void
{
    $this->update([
        'is_active' => true,
        'suspension_reason' => null,
    ]);
}
```

**Explicación:**
- **`suspend($reason)`**: Desactiva el producto y guarda el motivo de suspensión
- **`reactivate()`**: Reactiva el producto limpiando el motivo anterior
- El motivo es útil para auditoría y notificaciones al vendedor

**Importancia:**
- Permite rastrear por qué se suspendió un producto
- Facilita la comunicación con vendedores

### Banner Model

**Ubicación:** `app/Models/Banner.php`

**Adiciones:**

```php
public function suspend(): void
{
    $this->update(['is_active' => false]);
}

public function reactivate(): void
{
    $this->update(['is_active' => true]);
}
```

**Importancia:**
- Mantiene consistencia en toda la aplicación
- Permite gestionar banners sin perder el historial

### Comment Model

**Ubicación:** `app/Models/Comment.php`

**Adiciones:**

```php
public function hide(): void
{
    $this->update(['is_active' => false]);
}

public function show(): void
{
    $this->update(['is_active' => true]);
}
```

**Explicación:**
- Métodos `hide()`/`show()` para comentarios (en lugar de suspend/reactivate)
- Refleja mejor la intención: ocultar comentarios inadecuados

### Trato Model

**Ubicación:** `app/Models/Trato.php`

**Adiciones:**

```php
public function cancel(): void
{
    $this->update(['status' => 'cancelado']);
}
```

**Explicación:**
- Los tratos usan un modelo diferente basado en estado
- En lugar de `is_active`, usa `status` con valores: `cancelado`, `pendiente`, `completado`
- El método `cancel()` marca el trato como cancelado sin eliminar registros

**Importancia:**
- Mantiene flexibilidad para diferentes tipos de estados
- Permite historial completo de transacciones

---

## Cambios en Controladores

### AdminProductController

**Ubicación:** `app/Http/Controllers/Admin/AdminProductController.php`

**Cambio en método `destroy()`:**

```php
// ANTES (Eliminación física):
public function destroy(Product $product)
{
    if ($product->image_path) {
        Storage::disk('public')->delete($product->image_path);
    }
    $product->delete();  // ← Eliminaba todo
    return redirect()->route('admin.products.index')
        ->with('success', 'Publicación eliminada.');
}

// AHORA (Soft delete):
public function destroy(Product $product)
{
    // Soft delete: solo desactivar el producto, no eliminar datos
    $product->reactivate(); // Primero limpiamos el motivo anterior
    $product->suspend('Eliminado por administrador');

    return redirect()->route('admin.products.index')
        ->with('success', 'Publicación desactivada. Los datos se conservan para auditoría.');
}
```

**Explicación del flujo:**

1. **`reactivate()`**: Limpia el motivo anterior y establece `is_active = true`
2. **`suspend()`**: Desactiva el producto y registra el motivo
3. El registro permanece en la BD pero inactivo

**Importancia:**
- Preserva el historial completo del producto
- Facilita investigación de por qué se suspendió
- Permite reactivación rápida si fue error

**Imports necesarios:**
```php
use Illuminate\Support\Facades\Storage;  // Para eliminar imágenes
use App\Mail\ProductSuspendedMail;       // Para notificaciones
use Illuminate\Support\Facades\Mail;     // Para enviar correos
```

### BannerController

**Ubicación:** `app/Http/Controllers/Admin/BannerController.php`

**Cambio en método `destroy()`:**

```php
// AHORA (Soft delete):
public function destroy(Banner $banner)
{
    // Soft delete: solo desactivar el banner, no eliminar datos
    $banner->suspend();

    return redirect()->route('admin.banners.index')
        ->with('success', 'Banner desactivado. Los datos se conservan para auditoría.');
}
```

**Simplificación:**
- No necesita limpiar motivo anterior (banners no tienen motivo de suspensión)
- Llamada directa a `suspend()`

---

## Cambios en Vistas

### admin/dashboard.blade.php

**Ubicación:** `resources/views/admin/dashboard.blade.php`

**Cambio en sección de productos:**

```blade
{{-- ANTES --}}
<td class="px-6 py-4 text-right">
    <a href="{{ route('admin.products.edit', $product->id) }}" class="text-primary hover:bg-primary-fixed p-1 rounded-full">
        <span class="material-symbols-outlined">edit</span>
    </a>
    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline">
        @csrf @method('DELETE')
        <button type="submit" class="text-error hover:bg-error-container p-1 rounded-full ml-2">
            <span class="material-symbols-outlined">delete</span>
        </button>
    </form>
</td>

{{-- AHORA --}}
<td class="px-6 py-4 text-right">
    <a href="{{ route('admin.products.edit', $product->id) }}" class="text-primary hover:bg-primary-fixed p-1 rounded-full" title="Editar">
        <span class="material-symbols-outlined">edit</span>
    </a>
    @if($product->is_active)
        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline" onsubmit="return confirm('¿Desactivar esta publicación?')">
            @csrf @method('DELETE')
            <button type="submit" class="text-error hover:bg-error-container p-1 rounded-full ml-2" title="Desactivar">
                <span class="material-symbols-outlined">block</span>
            </button>
        </form>
    @else
        <button disabled class="text-on-surface-variant p-1 rounded-full ml-2 opacity-50 cursor-not-allowed" title="Publicación desactivada">
            <span class="material-symbols-outlined">block</span>
        </button>
    @endif
</td>
```

**Explicación de cambios:**

| Aspecto | Cambio | Razón |
|--------|--------|-------|
| Ícono | `delete` → `block` | Refleja "bloqueo" en lugar de eliminación |
| Confirmación | `confirm()` | Pregunta antes de desactivar |
| Lógica | Condicional `@if` | Mostrar botón solo si está activo |
| Estado inactivo | Botón deshabilitado | Indica que ya está desactivado |

**Importancia:**
- Interfaz clara al usuario sobre qué sucede
- Evita desactivaciones accidentales
- Feedback visual del estado actual

### admin/banners/index.blade.php

**Ubicación:** `resources/views/admin/banners/index.blade.php`

**Cambio:**

```blade
{{-- REMOVIDO: Botón "Eliminar definitivamente" --}}
{{-- ANTES: Había un formulario para eliminar permanentemente banners --}}
<form action="{{ route('admin.banners.destroy', $banner) }}" method="POST"
      onsubmit="return confirm('¿Eliminar definitivamente este banner?')">
    @csrf @method('DELETE')
    <button type="submit" class="p-2 text-error hover:bg-error/10 rounded-full transition-colors" title="Eliminar definitivamente">
        <span class="material-symbols-outlined">delete</span>
    </button>
</form>

{{-- AHORA: Solo opción de reactivar --}}
<form action="{{ route('admin.banners.update', $banner) }}" method="POST" class="inline">
    @csrf @method('PUT')
    <input type="hidden" name="title"     value="{{ $banner->title }}">
    <input type="hidden" name="link_url"  value="{{ $banner->link_url }}">
    <input type="hidden" name="is_active" value="1">
    <button type="submit"
        class="px-4 py-2 bg-primary/10 text-primary font-bold rounded-lg hover:bg-primary/20 transition-colors flex items-center gap-2">
        <span class="material-symbols-outlined text-[20px]">play_arrow</span> Reactivar
    </button>
</form>
```

**Importancia:**
- Elimina la posibilidad de borrado permanente
- Mantiene acceso a historial de banners
- Permite recuperación fácil de banners suspendidos

---

## Patrones y Mejores Prácticas

### 1. Patrón de Soft Delete

```php
// ✅ CORRECTO: Usar método del modelo
$product->suspend('Motivo de la suspensión');

// ❌ INCORRECTO: Eliminación directa
$product->delete();

// ✅ CORRECTO: Reactivar
$product->reactivate();
```

### 2. Consultas con Soft Delete

```php
// ✅ Obtener solo productos activos
$activeProducts = Product::where('is_active', true)->get();

// ✅ Obtener todos incluidos inactivos
$allProducts = Product::withoutGlobalScopes()->get();

// ✅ Para auditoría: obtener inactivos
$suspendedProducts = Product::where('is_active', false)->get();
```

### 3. Relaciones Filtrando por Estado

```php
// En User.php
public function products()
{
    return $this->hasMany(Product::class)
                ->where('is_active', true);  // Solo activos
}

// En Product.php
public function comments()
{
    return $this->hasMany(Comment::class)
                ->where('is_active', true);  // Solo comentarios visibles
}
```

### 4. Validaciones Importantes

```php
// En controladores, validar estado
public function update(Product $product, Request $request)
{
    // ✅ CORRECTO: Verificar que esté activo antes de permitir cambios
    if (!$product->is_active) {
        return redirect()->back()
            ->with('error', 'No puede editar un producto suspendido.');
    }
    
    // Continuar con actualización...
}
```

---

## Ejemplos de Uso

### Ejemplo 1: Suspender un Usuario

```php
// En un controlador de admin
public function suspendUser(User $user, Request $request)
{
    $user->suspend();
    
    // Opcional: Notificar al usuario
    Mail::to($user->email)->send(new UserSuspendedMail($user));
    
    return redirect()->back()
        ->with('success', 'Usuario suspendido correctamente.');
}
```

### Ejemplo 2: Reactivar un Producto

```php
// En AdminProductController
public function reactivateProduct(Product $product)
{
    if (!$product->is_active) {
        $product->reactivate();
        
        // Notificar al vendedor
        Mail::to($product->user->email)
            ->send(new ProductReactivatedMail($product));
    }
    
    return redirect()->back()
        ->with('success', 'Producto reactivado correctamente.');
}
```

### Ejemplo 3: Listar Banners Activos

```php
// En vista
@foreach(Banner::where('is_active', true)->get() as $banner)
    <div class="banner">
        <h2>{{ $banner->title }}</h2>
        <p>{{ $banner->description }}</p>
    </div>
@endforeach
```

### Ejemplo 4: Auditoría - Ver Historial

```php
// Obtener todos los productos (activos + inactivos)
$allProducts = Product::withoutGlobalScopes()->get();

foreach ($allProducts as $product) {
    echo "ID: {$product->id} | Estado: ";
    echo $product->is_active ? 'Activo' : 'Suspendido';
    echo " | Motivo: {$product->suspension_reason}\n";
}
```

---

## Migración de Datos

### Para Usuarios Existentes

```php
// Command para migrar (si fuera necesario)
php artisan tinker

User::query()->update(['is_active' => true]);
// Todos los usuarios existentes comienzan como activos
```

### Para Recuperar Datos Históricos

```php
// Script para auditoría
$suspendedProducts = Product::where('is_active', false)
    ->orderBy('updated_at', 'desc')
    ->get();

foreach ($suspendedProducts as $product) {
    echo "Producto: {$product->name} | ";
    echo "Suspendido: {$product->updated_at} | ";
    echo "Motivo: {$product->suspension_reason}\n";
}
```

---

## Guía de Mantenimiento

### Monitoreo Regular

```bash
# Ver productos suspendidos
php artisan tinker
Product::where('is_active', false)->count()

# Ver usuarios suspendidos
User::where('is_active', false)->count()

# Ver tratos cancelados
Trato::where('status', 'cancelado')->count()
```

### Limpieza de Imágenes Huérfanas

```php
// Script para eliminar imágenes de productos suspendidos (SOLO imágenes, no registros)
$suspendedProducts = Product::where('is_active', false)->get();

foreach ($suspendedProducts as $product) {
    if ($product->image_path) {
        // Opcionalmente: Aquí SÍ se puede eliminar la imagen del storage
        // Storage::disk('public')->delete($product->image_path);
    }
}
```

### Backup de Datos Suspendidos

```bash
# Crear export de datos inactivos para auditoría
php artisan tinker
$suspended = Product::where('is_active', false)->get();
// Exportar a CSV, JSON, etc.
```

### Actualización de Queries

**Puntos a verificar en toda la app:**

1. ✅ Listar productos → Agregar `.where('is_active', true)`
2. ✅ Búsquedas → Filtrar solo activos
3. ✅ Reportes → Incluir datos inactivos con anotación
4. ✅ APIs → Documentar que retorna solo activos
5. ✅ Cache → Invalidar cuando cambia `is_active`

### Script de Verificación

```bash
# Verificar que todas las consultas usan soft delete correctamente
grep -r "->delete()" app/ --include="*.php"
# Debería retornar 0 resultados en controladores normales

grep -r "is_active" app/ --include="*.php" | wc -l
# Debería mostrar múltiples ocurrencias en modelos y vistas
```

---

## Matriz de Cambios Resumida

| Archivo | Cambio | Tipo |
|---------|--------|------|
| `migrations/2026_06_12_140000...` | Crear columna `is_active` en users | ✅ Creado |
| `migrations/2026_06_12_131051...` | Migración duplicada | ❌ Eliminado |
| `Models/User.php` | Agregar métodos suspend/reactivate | ✅ Modificado |
| `Models/Product.php` | Agregar métodos suspend/reactivate | ✅ Modificado |
| `Models/Banner.php` | Agregar métodos suspend/reactivate | ✅ Modificado |
| `Models/Comment.php` | Agregar métodos hide/show | ✅ Modificado |
| `Models/Trato.php` | Agregar método cancel | ✅ Modificado |
| `Admin/AdminProductController.php` | Cambiar destroy a soft delete | ✅ Modificado |
| `Admin/BannerController.php` | Cambiar destroy a soft delete | ✅ Modificado |
| `admin/dashboard.blade.php` | Cambiar ícono delete a block | ✅ Modificado |
| `admin/banners/index.blade.php` | Remover botón eliminar permanente | ✅ Modificado |

---

## Consideraciones de Seguridad

### 1. Control de Acceso

```php
// Verificar permisos antes de suspender
if (!auth()->user()->isAdmin()) {
    abort(403, 'No autorizado para suspender usuarios');
}
```

### 2. Auditoría de Cambios

```php
// Registrar quién suspendió y cuándo
$product->update([
    'is_active' => false,
    'suspended_by' => auth()->id(),
    'suspended_at' => now(),
]);
```

### 3. Protección de Datos Sensibles

```php
// No mostrar motivos de suspensión a usuarios finales
@if(auth()->user()->isAdmin())
    <p>Motivo: {{ $product->suspension_reason }}</p>
@endif
```

---

## Conclusión

Esta refactorización implementa un modelo robusto de soft delete que:

- ✅ Mantiene integridad de datos
- ✅ Facilita auditoría
- ✅ Permite recuperación de datos
- ✅ Cumple con regulaciones
- ✅ Mejora la experiencia de usuario
- ✅ Facilita el mantenimiento futuro

**Para preguntas o reportar problemas**, consultar el archivo `REFACTORING_SUMMARY.md` o contactar al equipo de desarrollo.

---

**Creado:** 12 de Junio de 2026  
**Versión:** 2.0.0  
**Estado:** Producción  
**Mantenedor:** Equipo de Desarrollo
