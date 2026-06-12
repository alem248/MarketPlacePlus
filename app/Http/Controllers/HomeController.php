<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

        return view('auth.home', compact('products'));
    }
}
