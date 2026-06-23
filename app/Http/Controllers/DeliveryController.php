<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Trato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeliveryController extends Controller
{
    // ─── Vendedor ────────────────────────────────────────────────────────────────

    public function sellerIndex()
    {
        // Incluye 'recibido' para que el vendedor no pierda visibilidad
        // del delivery cuando el trato ya fue completado.
        $tratos = Trato::where('seller_id', Auth::id())
            ->whereIn('status', ['aprobado', 'recibido'])
            ->with(['product', 'buyer', 'delivery'])
            ->latest()
            ->get();

        return view('seller.delivery.index', compact('tratos'));
    }

    public function sellerCreate(Trato $trato)
    {
        abort_unless($trato->seller_id === Auth::id(), 403);

        // abort_if con 302 no redirige, lanza excepción. Usamos redirect explícito.
        if ($trato->delivery !== null) {
            return redirect()->route('seller.delivery.show', $trato);
        }

        return view('seller.delivery.create', compact('trato'));
    }

    public function sellerStore(Request $request, Trato $trato)
    {
        abort_unless($trato->seller_id === Auth::id(), 403);

        // Si ya existe una solicitud, redirigir al show
        if ($trato->delivery) {
            return redirect()->route('seller.delivery.show', $trato);
        }

        $request->validate([
            'pickup_address'   => 'required|string|max:255',
            'delivery_address' => 'required|string|max:255',
            'contact_name'     => 'required|string|max:100',
            'contact_phone'    => 'required|string|max:20',
            'shipping_type'    => 'required|in:regular,express',
            'notes'            => 'nullable|string|max:500',
        ]);

        Delivery::create([
            'trato_id'         => $trato->id,
            'pickup_address'   => $request->pickup_address,
            'delivery_address' => $request->delivery_address,
            'contact_name'     => $request->contact_name,
            'contact_phone'    => $request->contact_phone,
            'shipping_type'    => $request->shipping_type,
            'notes'            => $request->notes,
            'status'           => 'pendiente',
        ]);

        return redirect()->route('seller.delivery.show', $trato)
            ->with('delivery_created', true);
    }

    public function sellerShow(Trato $trato)
    {
        abort_unless($trato->seller_id === Auth::id(), 403);

        $trato->load(['product', 'buyer', 'delivery']);
        $delivery = $trato->delivery;

        if (!$delivery) {
            return redirect()->route('seller.delivery.create', $trato);
        }

        return view('seller.delivery.show', compact('trato', 'delivery'));
    }

    public function sellerMarkEnCamino(Trato $trato)
    {
        abort_unless($trato->seller_id === Auth::id(), 403);

        $delivery = $trato->delivery;
        abort_if(!$delivery || $delivery->status !== 'aprobado', 422);

        $delivery->update(['status' => 'en_camino']);

        return redirect()->route('seller.delivery.show', $trato)
            ->with('success', 'Pedido marcado como en camino.');
    }

    // ─── Comprador ───────────────────────────────────────────────────────────────

    public function buyerIndex()
    {
        $deliveries = Delivery::whereHas('trato', fn ($q) => $q->where('buyer_id', Auth::id()))
            ->with(['trato.product', 'trato.seller'])
            ->latest()
            ->get();

        return view('delivery.index', compact('deliveries'));
    }

    public function buyerConfirm(Trato $trato)
    {
        abort_unless($trato->buyer_id === Auth::id(), 403);

        $delivery = $trato->delivery;
        abort_if(!$delivery || $delivery->status !== 'en_camino', 422);

        $delivery->update(['status' => 'entregado']);

        return redirect()->route('delivery.index')
            ->with('success', '¡Pedido recibido! Gracias por confirmar.');
    }
}
