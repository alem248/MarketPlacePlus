<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TratosController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ComprobantesController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\Admin\DeliveryController as AdminDeliveryController;


// RUTAS PÚBLICAS Y DE AUTENTICACIÓN

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('products.search');

// Detalle público de un producto (requiere login para ver el chat y los tratos)
Route::middleware(['auth'])->get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register.show');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login.show');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/proximamente', function () {
    return view('proximamente');
})->name('proximamente');


// ZONA CLIENTE / VENDEDOR (Unificada)

Route::middleware(['auth'])->group(function () {
    // Panel general y tratos
    Route::get('/vendedor/panel', [ProductController::class, 'dashboard'])->name('seller.panel');
    Route::get('/tratos', [TratosController::class, 'index'])->name('tratos.index');
    // Lista de tratos donde el usuario autenticado es el VENDEDOR
    Route::get('/vendedor/tratos', [TratosController::class, 'sellerIndex'])->name('seller.tratos.index');

    // Gestión de productos del vendedor
    Route::get('/seller/products/create', [ProductController::class, 'create'])->name('seller.products.create');
    Route::post('/seller/products', [ProductController::class, 'store'])->name('seller.products.store');

    Route::get('/seller/products/{id}/edit', [ProductController::class, 'edit'])->name('seller.products.edit');
    Route::put('/seller/products/{id}', [ProductController::class, 'update'])->name('seller.products.update');
    Route::post('/seller/products/{id}/acknowledge', [App\Http\Controllers\ProductController::class, 'acknowledge'])
    ->name('seller.products.acknowledge');
    Route::post('/seller/products/{id}/acknowledge-reactivation', [ProductController::class, 'acknowledgeReactivation'])->name('seller.products.acknowledgeReactivation');

    // Detalle/seguimiento de un trato específico del comprador
    Route::get('/tratos/{trato}', [TratosController::class, 'show'])->name('tratos.show');

    // Detalle de un trato específico para el VENDEDOR
    Route::get('/vendedor/tratos/{trato}', [TratosController::class, 'sellerShow'])->name('seller.tratos.show');

    // Crear trato desde página de producto
    Route::post('/products/{product}/trato', [TratosController::class, 'store'])->name('tratos.store');

    // Acciones del comprador sobre un trato
    Route::post('/tratos/{trato}/cancel',          [TratosController::class, 'cancel'])->name('tratos.cancel');
    Route::post('/tratos/{trato}/received',        [TratosController::class, 'buyerConfirm'])->name('tratos.received');
    Route::post('/tratos/{trato}/received/undo',   [TratosController::class, 'buyerUnconfirm'])->name('tratos.received.undo');
    Route::patch('/tratos/{trato}/payment', [TratosController::class, 'updatePayment'])->name('tratos.payment');
    Route::post('/tratos/{trato}/messages', [TratosController::class, 'sendMessage'])->name('tratos.messages.store');

    // Acciones del vendedor sobre un trato
    Route::post('/vendedor/tratos/{trato}/accept',          [TratosController::class, 'accept'])->name('seller.tratos.accept');
    Route::post('/vendedor/tratos/{trato}/reject',          [TratosController::class, 'reject'])->name('seller.tratos.reject');
    Route::post('/vendedor/tratos/{trato}/delivered',       [TratosController::class, 'sellerConfirm'])->name('seller.tratos.delivered');
    Route::post('/vendedor/tratos/{trato}/delivered/undo',  [TratosController::class, 'sellerUnconfirm'])->name('seller.tratos.delivered.undo');
    Route::post('/vendedor/tratos/{trato}/messages',  [TratosController::class, 'sendMessage'])->name('seller.tratos.messages.store');

    // Guardar calificación y comentario del comprador al vendedor (solo estado 'recibido')
    Route::post('/tratos/{trato}/calificar', [CommentController::class, 'store'])->name('tratos.calificar');

    // Foto de perfil
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo.update');

    // Favoritos
    Route::get('/favoritos', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favoritos', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('/favoritos', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
    Route::get('/favoritos/colecciones', [FavoriteController::class, 'collections'])->name('favorites.collections');
    Route::post('/favoritos/colecciones', [FavoriteController::class, 'storeCollection'])->name('favorites.collections.store');
    Route::get('/favoritos/colecciones/{collection}', [FavoriteController::class, 'showCollection'])->name('favorites.collections.show');
    Route::delete('/favoritos/colecciones/{collection}/productos/{product}', [FavoriteController::class, 'destroyFromCollection'])->name('favorites.collections.destroyProduct');
    Route::delete('/favoritos/colecciones/{collection}', [FavoriteController::class, 'destroyCollection'])->name('favorites.collections.destroy');

    // Delivery del comprador
    Route::get('/delivery', [DeliveryController::class, 'buyerIndex'])->name('delivery.index');
    Route::post('/delivery/{trato}/confirmar', [DeliveryController::class, 'buyerConfirm'])->name('delivery.confirm');

    // Delivery del vendedor
    Route::get('/vendedor/delivery', [DeliveryController::class, 'sellerIndex'])->name('seller.delivery.index');
    Route::get('/vendedor/delivery/{trato}/solicitar', [DeliveryController::class, 'sellerCreate'])->name('seller.delivery.create');
    Route::post('/vendedor/delivery/{trato}/solicitar', [DeliveryController::class, 'sellerStore'])->name('seller.delivery.store');
    Route::get('/vendedor/delivery/{trato}/seguimiento', [DeliveryController::class, 'sellerShow'])->name('seller.delivery.show');
    Route::post('/vendedor/delivery/{trato}/en-camino', [DeliveryController::class, 'sellerMarkEnCamino'])->name('seller.delivery.en-camino');

    // Comprobantes de venta del comprador
    Route::get('/mis-comprobantes', [ComprobantesController::class, 'index'])->name('comprobantes.index');
    Route::post('/tratos/{trato}/comprobante', [ComprobantesController::class, 'store'])->name('comprobantes.store');

    // Comprobantes del vendedor
    Route::get('/vendedor/mis-comprobantes', [ComprobantesController::class, 'sellerIndex'])->name('seller.comprobantes.index');

});

// Ruta de vista simple (Independiente)
Route::view('/crear-producto', 'create-product')->name('products.create.view'); // Cambié el nombre ligeramente para evitar choques con el admin



// ZONA ADMINISTRADOR

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Gestión de Productos
    Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('products.create');
    Route::post('/products', [AdminProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [AdminProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])->name('products.destroy');
    // Ruta extra para cambiar el estado desde JS:
    Route::post('/products/{product}/status', [AdminProductController::class, 'updateStatus'])->name('products.updateStatus');

    // Dentro del grupo admin
Route::post('/products/{product}/suspend', [AdminProductController::class, 'suspend'])->name('products.suspend');

    // Gestión de Banners
    Route::get('/banners', [BannerController::class, 'index'])->name('banners.index');
    Route::get('/banners/create', [BannerController::class, 'create'])->name('banners.create');
    Route::post('/banners', [BannerController::class, 'store'])->name('banners.store');
    Route::get('/banners/{banner}/edit', [BannerController::class, 'edit'])->name('banners.edit');
    Route::put('/banners/{banner}', [BannerController::class, 'update'])->name('banners.update');
    Route::delete('/banners/{banner}', [BannerController::class, 'destroy'])->name('banners.destroy');

    // Gestión de Usuarios
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::put('/users/{user}/role', [UserController::class, 'updateRole'])->name('users.updateRole');

    // Gestión de Comentarios
    Route::get('/comments', [AdminCommentController::class, 'index'])->name('comments.index');
    Route::patch('/comments/{comment}/toggle', [AdminCommentController::class, 'toggle'])->name('comments.toggle');

    // Gestión de Deliveries
    Route::get('/delivery', [AdminDeliveryController::class, 'index'])->name('delivery.index');
    Route::get('/delivery/{delivery}', [AdminDeliveryController::class, 'show'])->name('delivery.show');
    Route::post('/delivery/{delivery}/aprobar', [AdminDeliveryController::class, 'approve'])->name('delivery.approve');
    Route::post('/delivery/{delivery}/rechazar', [AdminDeliveryController::class, 'reject'])->name('delivery.reject');
});
