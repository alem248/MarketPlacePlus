<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use Illuminate\Http\Request;

class DealController extends Controller
{
    public function index()
    {
        // Traemos los tratos donde el usuario logueado es el vendedor
        $deals = Deal::where('seller_id', auth()->id())
            ->with(['product', 'buyer'])
            ->latest()
            ->get();

        // Apuntamos a la carpeta correspondiente
        return view('seller.deals.active-deals', compact('deals'));
    }
}