<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Traemos los últimos 5 productos con su vendedor asociado
        $products = Product::with('user')->latest()->take(5)->get();
        return view('admin.dashboard', compact('products'));
    }
}