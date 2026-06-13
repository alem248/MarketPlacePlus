<?php

namespace App\Http\Controllers;

use App\Models\Trato;

class TratosController extends Controller
{
    // Vista de seguimiento de un trato individual
    public function show(Trato $trato)
    {
        // Seguridad: solo el comprador del trato puede verlo
        abort_if($trato->buyer_id !== auth()->id(), 403);

        // Cargamos producto y vendedor para la vista
        $trato->load(['product', 'seller']);

        return view('tratos.show', compact('trato'));
    }

    public function index()
    {
        // Tratos donde el usuario autenticado es el comprador, paginados de 10 en 10
        $tratos = Trato::where('buyer_id', auth()->id())
            ->with(['product', 'seller']) // cargamos relaciones para evitar N+1 queries
            ->latest()
            ->paginate(10);

        return view('tratos.index', compact('tratos'));
    }

    // Vista de detalle de un trato específico para el VENDEDOR
    public function sellerShow(Trato $trato)
    {
        // Seguridad: solo el vendedor del trato puede acceder
        abort_if($trato->seller_id !== auth()->id(), 403);

        // Cargamos producto y comprador para la vista
        $trato->load(['product', 'buyer']);

        return view('seller.tratos.show', compact('trato'));
    }

    // Vista "Mis Tratos Directos" del VENDEDOR: tratos donde el auth es el vendedor
    public function sellerIndex()
    {
        $tratos = Trato::where('seller_id', auth()->id())
            ->with(['product', 'buyer']) // cargamos producto y comprador
            ->latest()
            ->paginate(10);

        // Conteo por estado para los filter chips de la vista
        $counts = Trato::where('seller_id', auth()->id())
            ->selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        return view('seller.tratos.index', compact('tratos', 'counts'));
    }
}
