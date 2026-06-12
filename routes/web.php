<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TratosController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminDashboardController;

// ==========================================
// RUTAS PÚBLICAS Y DE AUTENTICACIÓN
// ==========================================
Route::get('/', [HomeController::class, 'index'])->name('home');

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

// ==========================================
// ZONA CLIENTE / VENDEDOR (Unificada)
// ==========================================
Route::middleware(['auth'])->group(function () {
    // Panel general y tratos
    Route::get('/vendedor/panel', [ProductController::class, 'dashboard'])->name('seller.panel');
    Route::get('/tratos', [TratosController::class, 'index'])->name('tratos.index');

    // Gestión de productos del vendedor
    Route::get('/seller/products/create', [ProductController::class, 'create'])->name('seller.products.create');
    Route::post('/seller/products', [ProductController::class, 'store'])->name('seller.products.store');
<<<<<<< HEAD
    Route::get('/seller/products/{id}/edit', [ProductController::class, 'edit'])->name('seller.products.edit');
    Route::put('/seller/products/{id}', [ProductController::class, 'update'])->name('seller.products.update');
    Route::post('/seller/products/{id}/acknowledge', [App\Http\Controllers\ProductController::class, 'acknowledge'])
    ->name('seller.products.acknowledge');
=======

    Route::get('/tratos', [TratosController::class, 'index'])->name('tratos.index');

    // Detalle/seguimiento de un trato específico del comprador
    Route::get('/tratos/{trato}', [TratosController::class, 'show'])->name('tratos.show');
>>>>>>> 0c905f4df2eb846b652ae3ba3f27768d528c12c7
});

// Ruta de vista simple (Independiente)
Route::view('/crear-producto', 'create-product')->name('products.create.view'); // Cambié el nombre ligeramente para evitar choques con el admin


// ==========================================
// ZONA ADMINISTRADOR
// ==========================================
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
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
});
