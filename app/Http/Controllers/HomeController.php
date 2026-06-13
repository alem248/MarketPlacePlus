<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // Traemos solo productos activos, con su vendedor, más recientes primero
        $products = Product::where('is_active', true)
            ->with('user')
            ->latest()
            ->get();

        // Banners activos ordenados por creación: [0] hero, [1] sidebar
        $banners = Banner::where('is_active', true)
            ->orderBy('created_at')
            ->get();

        return view('auth.home', compact('products', 'banners'));
    }
}
