<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TratosController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\UserController;

// ─── Rutas públicas ────────────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ─── Rutas de usuario autenticado (cualquier perfil) ──────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/mis-tratos', [TratosController::class, 'index'])->name('tratos.index');
    Route::get('/seller/products/create', [ProductController::class, 'create'])->name('seller.products.create');
    Route::post('/seller/products', [ProductController::class, 'store'])->name('seller.products.store');
});

// ─── Rutas de administrador (solo perfil admin) ───────────────────────────────
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', fn() => redirect()->route('admin.banners.index'))->name('dashboard');

    // CRUD Banners
    Route::resource('banners', BannerController::class)->except(['show']);

    // CRUD Publicaciones (Admin)
    Route::resource('products', AdminProductController::class)->except(['show']);

    // Gestión de usuarios (solo lectura + cambio de rol)
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::patch('users/{user}/role', [UserController::class, 'updateRole'])->name('users.updateRole');
});
