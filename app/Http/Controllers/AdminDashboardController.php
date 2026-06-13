<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Comment;
use App\Models\Banner;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Últimos 5 productos con su vendedor para la tabla de publicaciones recientes
        $products = Product::with('user')->latest()->take(5)->get();

        // Últimos 3 comentarios para el panel de moderación del dashboard
        $recentComments = Comment::with(['user', 'product'])->latest()->take(3)->get();

        // Banners para la sección de publicidad del dashboard (activos primero)
        $banners = Banner::orderByDesc('is_active')->orderByDesc('created_at')->take(4)->get();

        return view('admin.dashboard', compact('products', 'recentComments', 'banners'));
    }
}