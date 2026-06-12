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
}
