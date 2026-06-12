# Guía de Referencia Rápida - Soft Delete

## Resumen Ejecutivo

**Cambio Principal:** Todas las eliminaciones ahora son "soft delete" (suspensión/inactividad)  
**Excepción:** Imágenes SÍ se pueden eliminar del storage  
**Fecha:** 12 de Junio de 2026

---

## Comandos Rápidos

### Ver Documentación
```bash
# Documentación técnica completa (751 líneas)
cat TECHNICAL_DOCUMENTATION.md

# Resumen de cambios (248 líneas)
cat REFACTORING_SUMMARY.md
```

### Verificar Estado en Base de Datos

```php
# Terminal Artisan (php artisan tinker)

# Productos activos
Product::where('is_active', true)->count()

# Productos suspendidos
Product::where('is_active', false)->count()

# Ver motivo de suspensión
Product::where('is_active', false)->first()->suspension_reason

# Usuarios activos
User::where('is_active', true)->count()

# Ver todos (incluidos suspendidos)
Product::all()->count()
```

---

## Sintaxis de Soft Delete

### En Controladores

```php
// Suspender
$product->suspend('Motivo de suspensión');
$user->suspend();
$banner->suspend();
$comment->hide();
$trato->cancel();

// Reactivar
$product->reactivate();
$user->reactivate();
$banner->reactivate();
$comment->show();
```

### En Consultas

```php
// Solo activos (DEFAULT)
Product::where('is_active', true)->get()
Product::all()  // Automáticamente filtra activos

// Solo inactivos (auditoría)
Product::where('is_active', false)->get()

// Todos incluidos inactivos
Product::withoutGlobalScopes()->get()
```

### En Vistas Blade

```blade
@if($product->is_active)
    <p>Producto activo</p>
@else
    <p>Producto suspendido</p>
@endif
```

---

## Archivos Clave Modificados

| Archivo | Líneas | Cambio |
|---------|--------|--------|
| `app/Models/User.php` | +19 | Métodos suspend/reactivate |
| `app/Models/Product.php` | +18 | Métodos suspend/reactivate + reason |
| `app/Models/Banner.php` | +12 | Métodos suspend/reactivate |
| `app/Models/Comment.php` | +12 | Métodos hide/show |
| `app/Models/Trato.php` | +10 | Método cancel |
| `Admin/AdminProductController.php` | -3 | destroy() ahora usa suspend() |
| `Admin/BannerController.php` | -3 | destroy() ahora usa suspend() |
| `admin/dashboard.blade.php` | +10 | Cambios visuales de UI |
| `admin/banners/index.blade.php` | -8 | Remover botón eliminar |

---

## Casos de Uso Comunes

### Caso 1: Suspender Producto por Admin

```php
// En AdminProductController::destroy()
public function destroy(Product $product)
{
    $product->suspend('Eliminado por administrador');
    return redirect()->back()->with('success', 'Producto desactivado');
}
```

### Caso 2: Usuario Suspende su Propio Producto

```php
// En ProductController::userSuspend()
public function userSuspend(Product $product)
{
    if ($product->user_id !== auth()->id()) {
        abort(403);
    }
    
    $product->suspend('Suspendido por vendedor');
    return redirect()->back()->with('success', 'Tu producto fue desactivado');
}
```

### Caso 3: Listar Solo Productos Activos en Tienda

```php
// En ProductController::index()
public function index()
{
    $products = Product::where('is_active', true)
        ->paginate(12);
    
    return view('products.index', compact('products'));
}
```

### Caso 4: Reportes - Incluir Suspendidos

```php
// Para auditoría interna
$report = Product::withoutGlobalScopes()
    ->select([
        'id', 'name', 'is_active', 
        'suspension_reason', 'created_at', 'updated_at'
    ])
    ->get();
```

### Caso 5: Reactivar Producto

```php
// En AdminProductController::reactivate()
public function reactivate(Product $product)
{
    if (!$product->is_active) {
        $product->reactivate();
        Mail::to($product->user->email)->send(new ProductReactivatedMail());
    }
    
    return redirect()->back()->with('success', 'Producto reactivado');
}
```

---

## Flujos Visuales

### Flujo: Admin Suspende Producto

```
Admin hace click en "Bloquear"
            ↓
Confirmación: "¿Desactivar esta publicación?"
            ↓
Controller::destroy()
            ↓
$product->suspend('Eliminado por administrador')
            ↓
BD: is_active = false
    suspension_reason = 'Eliminado por administrador'
            ↓
Redirect con mensaje de éxito
            ↓
Producto no visible en tienda
            ↓
Datos se conservan para auditoría
```

### Flujo: Ver Producto Suspendido

```
Admin intenta editar producto suspendido
            ↓
Validación: if (!$product->is_active) { error }
            ↓
Error: "No puede editar un producto suspendido"
            ↓
Opción: Reactivar primero (si es autorizado)
```

---

## Checklist para Nuevas Funcionalidades

Cuando agregues nuevas funcionalidades, verifica:

- [ ] ¿Hay eliminación de datos? → Usar soft delete en lugar de `delete()`
- [ ] ¿Muestro datos del usuario? → Filtrar por `is_active = true`
- [ ] ¿Tengo un botón eliminar? → Cambiar a "Desactivar" / "Bloquear"
- [ ] ¿Necesito auditoría? → Incluir `suspension_reason` o `suspended_at`
- [ ] ¿Hay relaciones? → Considerar filtrar activos en relaciones

---

## Errores Comunes a Evitar

### ❌ INCORRECTO

```php
// ❌ No hagas esto
$product->delete();  // Borra todo

// ❌ Ni esto en vistas
@foreach(Product::all() as $product)
    // Mostrará productos suspendidos

// ❌ Ni tampoco
Product::withoutGlobalScopes()->delete();  // Peligroso

// ❌ No elimines directamente
Storage::delete($image);  // Sin antes marcar como inactivo
```

### ✅ CORRECTO

```php
// ✅ Haz esto
$product->suspend('Motivo aquí');

// ✅ En vistas
@foreach(Product::where('is_active', true)->get() as $product)
    // Solo activos

// ✅ Para auditoría
$deleted = Product::where('is_active', false)->first();

// ✅ Eliminar imágenes (SOLO excepción permitida)
if ($product->is_active === false) {
    Storage::delete($product->image);
}
```

---

## Estructura de Datos

### Usuario Suspendido
```json
{
    "id": 1,
    "name": "Juan Pérez",
    "email": "juan@example.com",
    "is_active": false,
    "created_at": "2026-01-01",
    "updated_at": "2026-06-12"
}
```

### Producto Suspendido
```json
{
    "id": 5,
    "name": "Laptop XYZ",
    "is_active": false,
    "suspension_reason": "Incumplimiento de políticas",
    "created_at": "2026-03-15",
    "updated_at": "2026-06-12"
}
```

### Trato Cancelado
```json
{
    "id": 10,
    "producto_id": 5,
    "usuario_id": 2,
    "status": "cancelado",
    "created_at": "2026-05-01",
    "updated_at": "2026-06-12"
}
```

---

## Eventos y Notificaciones

### Cuando Suspender Envía Notificaciones

```php
// AdminProductController::destroy()
$product->suspend('Incumplimiento de políticas');

// Opcionalmente: Notificar al vendedor
Mail::to($product->user->email)
    ->send(new ProductSuspendedMail($product));

// Log para auditoría
Log::channel('suspensions')->info('Producto suspendido', [
    'product_id' => $product->id,
    'reason' => 'Incumplimiento de políticas',
    'suspended_by' => auth()->id(),
    'timestamp' => now(),
]);
```

---

## Preguntas Frecuentes

**P: ¿Se pueden recuperar productos suspendidos?**  
R: Sí, llamando a `$product->reactivate()`

**P: ¿Se pierden los datos del producto?**  
R: No, se conservan todos en la BD. Solo se marca `is_active = false`

**P: ¿Qué pasa con las imágenes?**  
R: Las imágenes SÍ pueden eliminarse del storage. El registro en BD se conserva

**P: ¿Puedo ver productos suspendidos?**  
R: Sí, con `Product::where('is_active', false)->get()`

**P: ¿Cómo revertir cambios accidentales?**  
R: `$product->reactivate()` vuelve todo a normal

**P: ¿Hay límite de registros suspendidos?**  
R: No, pero monitorea el tamaño de BD regularmente

---

## Recursos Adicionales

- **Documentación técnica completa**: `TECHNICAL_DOCUMENTATION.md` (751 líneas)
- **Resumen de cambios**: `REFACTORING_SUMMARY.md` (248 líneas)
- **Rama del proyecto**: `code-cleanup-and-inactivation`

---

**Última actualización:** 12 de Junio de 2026  
**Versión:** 2.0.0  
**Estado:** Producción
